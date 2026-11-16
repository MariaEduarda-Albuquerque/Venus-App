<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConteudoController extends Controller
{
    public function index(Request $request)
    {
        $profissional = User::find(session('id'));

        $consulta = Conteudo::with(['categoria', 'tipo'])
            ->where('codProfissionalSaude', session('id'));

        $statusAtivo = null;
        if ($request->status && array_key_exists($request->status, Conteudo::STATUS)) {
            $statusAtivo = $request->status;
            $consulta->where('statusConteudo', $statusAtivo);
        }

        $conteudos = $consulta->orderBy('dataCriacao', 'desc')->get();

        $categorias = TipoCategoria::orderBy('codTipoCategoria')->get();
        $tipos = TipoConteudo::orderBy('codTipoConteudo')->get();

        return view('painelProfissional.conteudo', compact('profissional', 'conteudos', 'statusAtivo', 'categorias', 'tipos'));
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);

        $dados['statusConteudo'] = $request->acao == 'revisao' ? 'em_revisao' : 'rascunho';
        $dados['codProfissionalSaude'] = session('id');
        $dados['dataPlanejadaConteudo'] = $request->dataPlanejadaConteudo ?: null; // vem da Agenda (data de relevância)

        if ($request->hasFile('capaConteudo')) {
            $dados['capaConteudo'] = $request->file('capaConteudo')->store('conteudos', 'public');
        }

        Conteudo::create($dados);

        $mensagem = $request->acao == 'revisao'
            ? 'Conteúdo enviado para revisão editorial.'
            : 'Rascunho salvo com sucesso.';

        return redirect()->route('conteudos.index')->with('sucesso', $mensagem);
    }

    public function update(Request $request, $id)
    {
        $conteudo = Conteudo::where('codConteudo', $id)
            ->where('codProfissionalSaude', session('id'))
            ->first();

        if (!$conteudo) {
            return redirect()->route('conteudos.index')->with('erro', 'Conteúdo não encontrado.');
        }

        if ($conteudo->statusConteudo == 'em_revisao') {
            return redirect()->route('conteudos.index')->with('erro', 'Este conteúdo está em revisão e não pode ser editado agora.');
        }

        // Privar: só muda o status, não mexe no resto do conteúdo
        if ($request->acao == 'privar') {
            if ($conteudo->statusConteudo != 'publicado') {
                return redirect()->route('conteudos.index')->with('erro', 'Só é possível privar um conteúdo publicado.');
            }

            $conteudo->statusConteudo = 'rascunho';
            $conteudo->save();

            return redirect()->route('conteudos.index')->with('sucesso', 'Conteúdo privado: ele não está mais público.');
        }

        $dados = $this->validar($request);
        $dados['statusConteudo'] = $request->acao == 'revisao' ? 'em_revisao' : 'rascunho';

        // Imagem de destaque: troca, remove ou mantém a que já existe
        if ($request->hasFile('capaConteudo')) {
            $this->apagarCapa($conteudo->capaConteudo);
            $dados['capaConteudo'] = $request->file('capaConteudo')->store('conteudos', 'public');
        } elseif ($request->input('removerCapa') == '1') {
            $this->apagarCapa($conteudo->capaConteudo);
            $dados['capaConteudo'] = null;
        }

        $conteudo->update($dados);

        $mensagem = $request->acao == 'revisao'
            ? 'Conteúdo enviado para revisão editorial.'
            : 'Rascunho salvo com sucesso.';

        return redirect()->route('conteudos.index')->with('sucesso', $mensagem);
    }

    /**
     * Valida o formulário do assistente (rascunho exige só o básico;
     * enviar para revisão exige tudo que é obrigatório) e devolve os dados prontos para gravar.
     */
    private function validar(Request $request): array
    {
        // O formato saiu da tela: se não vier nada, usa o primeiro cadastrado
        if (!$request->filled('codTipoConteudo')) {
            $request->merge([
                'codTipoConteudo' => TipoConteudo::orderBy('codTipoConteudo')->value('codTipoConteudo'),
            ]);
        }

        $request->validate([
            'acao' => 'required|in:rascunho,revisao,privar',
            'tituloConteudo' => 'required|string|max:150',
            'codTipoCategoria' => 'required|exists:tbtipocategoria,codTipoCategoria',
            'codTipoConteudo' => 'required|exists:tbtipoconteudo,codTipoConteudo',
            'objetivoConteudo' => 'required_if:acao,revisao|nullable|string|max:250',
            'publicoAlvoConteudo' => 'required_if:acao,revisao|nullable|string|max:255',
            'tagsConteudo' => 'nullable|string|max:255',
            'mensagemPrincipalConteudo' => 'required_if:acao,revisao|nullable|string|max:80',
            'corpoConteudo' => 'required_if:acao,revisao|nullable|string|max:400',
            'chamadaAcaoConteudo' => 'nullable|string|max:60',
            'fontesConteudo' => 'nullable|string|max:300',
            'fundoConteudo' => 'nullable|in:vinho,rosa,lilas,pessego,azul,grafite',
            'capaConteudo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'dataPlanejadaConteudo' => 'nullable|date',
        ], [
            'tituloConteudo.required' => 'Informe o título da publicação.',
            'tituloConteudo.max' => 'O título deve ter no máximo 150 caracteres.',

            'codTipoCategoria.required' => 'Selecione uma categoria.',
            'codTipoCategoria.exists' => 'Categoria inválida.',

            'codTipoConteudo.required' => 'Nenhum formato cadastrado. Cadastre um na tabela tbtipoconteudo.',
            'codTipoConteudo.exists' => 'Formato inválido.',

            'objetivoConteudo.required_if' => 'Descreva o objetivo da publicação.',
            'publicoAlvoConteudo.required_if' => 'Escolha pelo menos um público-alvo.',
            'mensagemPrincipalConteudo.required_if' => 'Escreva a mensagem principal.',
            'corpoConteudo.required_if' => 'Escreva o texto de apresentação.',
            'corpoConteudo.max' => 'Reduza o texto para até 400 caracteres.',

            'capaConteudo.image' => 'Use uma imagem JPG, PNG ou WEBP.',
            'capaConteudo.mimes' => 'Use uma imagem JPG, PNG ou WEBP.',
            'capaConteudo.max' => 'A imagem passa de 3 MB. Escolha uma menor.',
        ]);

        $corpo = $request->corpoConteudo ?? '';

        return [
            'tituloConteudo' => $request->tituloConteudo,
            'objetivoConteudo' => $request->objetivoConteudo,
            'publicoAlvoConteudo' => $request->publicoAlvoConteudo,
            'tagsConteudo' => $request->tagsConteudo,
            'mensagemPrincipalConteudo' => $request->mensagemPrincipalConteudo,
            'corpoConteudo' => $corpo,
            'tempoLeituraMinutos' => Conteudo::calcularTempoLeitura($corpo),
            'chamadaAcaoConteudo' => $request->chamadaAcaoConteudo,
            'fontesConteudo' => $request->fontesConteudo,
            'fundoConteudo' => $request->fundoConteudo ?: 'vinho',
            'codTipoCategoria' => $request->codTipoCategoria,
            'codTipoConteudo' => $request->codTipoConteudo,
        ];
    }

    private function apagarCapa(?string $caminho): void
    {
        if ($caminho) {
            Storage::disk('public')->delete($caminho);
        }
    }
}