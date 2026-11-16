<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    private function eu()
    {
        return (int) session('id');
    }
    
    private function usuaria($u)
    {
        if ($u->anonimaPadraoUsuario) {
            $nome = 'Usuária anônima #' . $u->codUsuario;
            $foto = null;
            $subtitulo = 'Identidade preservada';
        } else {
            $nome = $u->apelidoUsuario ?: $u->nomeUsuario;
            $foto = $u->fotoPerfilUsuario;
            $subtitulo = 'Usuária';
            if ($u->cidadeUsuario) {
                $subtitulo = $u->cidadeUsuario . ($u->ufUsuario ? '/' . $u->ufUsuario : '');
            }
        }

        return [
            'codigo' => $u->codUsuario,
            'nome' => $nome,
            'inicial' => mb_strtoupper(mb_substr($nome, 0, 1)),
            'foto' => $foto,
            'subtitulo' => $subtitulo,
        ];
    }

    private function hora($data)
    {
        return $data->isToday() ? $data->format('H:i') : $data->format('d/m H:i');
    }

    private function contatoValido($id)
    {
        $usuaria = Usuario::where('codUsuario', $id)
            ->where('statusUsuario', 'ativa')
            ->first();

        if (!$usuaria) {
            return null;
        }

        $jaConversam = Mensagem::where('codUsuario', $id)
            ->where('codProfissionalSaude', $this->eu())
            ->exists();

        if (!$jaConversam) {
            return null;
        }

        return $usuaria;
    }

    public function conversas()
    {
        $eu = $this->eu();

        $mensagens = Mensagem::where('codProfissionalSaude', $eu)
            ->orderBy('codMensagem', 'desc')
            ->get();

        $grupos = [];
        foreach ($mensagens as $m) {
            $id = $m->codUsuario;
            if (!isset($grupos[$id])) {
                $grupos[$id] = ['ultima' => $m, 'naoLidas' => 0];
            }
            if ($m->remetenteMensagem == 'usuario' && !$m->lidaMensagem) {
                $grupos[$id]['naoLidas']++;
            }
        }

        $usuarias = Usuario::whereIn('codUsuario', array_keys($grupos))
            ->where('statusUsuario', 'ativa')
            ->get()
            ->keyBy('codUsuario');

        $lista = [];
        foreach ($grupos as $id => $g) {
            if (!isset($usuarias[$id])) {
                continue;
            }
            $lista[] = $this->usuaria($usuarias[$id]) + [
                'ultima' => $g['ultima']->textoMensagem,
                'minha' => $g['ultima']->remetenteMensagem == 'profissional',
                'hora' => $this->hora($g['ultima']->dataEnvio),
                'naoLidas' => $g['naoLidas'],
            ];
        }

        return response()->json($lista);
    }

    public function mensagens($id)
    {
        $eu = $this->eu();
        $usuaria = $this->contatoValido((int) $id);

        if (!$usuaria) {
            return response()->json(['erro' => 'Conversa não encontrada.'], 404);
        }

        Mensagem::where('codUsuario', $usuaria->codUsuario)
            ->where('codProfissionalSaude', $eu)
            ->where('remetenteMensagem', 'usuario')
            ->where('lidaMensagem', false)
            ->update(['lidaMensagem' => true]);

        $mensagens = Mensagem::where('codUsuario', $usuaria->codUsuario)
            ->where('codProfissionalSaude', $eu)
            ->orderBy('codMensagem')
            ->limit(300)
            ->get();

        $lista = [];
        foreach ($mensagens as $m) {
            $lista[] = [
                'id' => $m->codMensagem,
                'texto' => $m->textoMensagem,
                'minha' => $m->remetenteMensagem == 'profissional',
                'hora' => $this->hora($m->dataEnvio),
            ];
        }

        return response()->json([
            'usuario' => $this->usuaria($usuaria),
            'mensagens' => $lista,
        ]);
    }

    public function enviar(Request $request)
    {
        $dados = $request->validate([
            'destinatario' => 'required|integer',
            'texto' => 'required|string|max:2000',
        ]);

        $usuaria = $this->contatoValido((int) $dados['destinatario']);

        if (!$usuaria) {
            return response()->json(['erro' => 'Conversa não encontrada.'], 404);
        }

        $m = Mensagem::create([
            'codUsuario' => $usuaria->codUsuario,
            'codProfissionalSaude' => $this->eu(),
            'remetenteMensagem' => 'profissional',
            'textoMensagem' => trim($dados['texto']),
        ])->fresh();

        return response()->json([
            'id' => $m->codMensagem,
            'texto' => $m->textoMensagem,
            'minha' => true,
            'hora' => $this->hora($m->dataEnvio),
        ]);
    }
}
