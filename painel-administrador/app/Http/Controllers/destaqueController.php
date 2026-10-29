<?php

namespace App\Http\Controllers;

use App\Models\Destaque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class DestaqueController extends Controller
{
    public function index()
    {
        //
        $admin = Auth::guard('admin')->id();
        $destaque = Destaque::where('admin_id', $admin)->get();

                return view('conteudos.destaques', compact('destaque'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Texto do formulário => valor do enum no banco
        $publicos = [
            'Adolescentes e jovens' => 'adolescentes_e_jovens',
            'Mulheres adultas'      => 'mulheres_adultas',
            'Gestantes'             => 'gestantes',
            'Todas as usuárias'     => 'todas_as_usuarias',
        ];

        $faixas = [
            '14 a 25 anos'    => '14_25',
            '26 a 40 anos'    => '26_40',
            '41 a 60 anos'    => '41_60',
            'Todas as idades' => 'todas_as_idades',
        ];

        $categorias = [
            'ISTs (Infecções Sexualmente Transmissíveis)' => 'ists',
            'Saúde mental'                                => 'saude_mental',
            'Saúde reprodutiva'                           => 'saude_reprodutiva',
            'Prevenção e exames'                          => 'prevencao_e_exames',
        ];

        $request->validate([
            'titulo'         => 'required|max:80',
            'objetivo'       => 'required|max:250',
            'publico_alvo'   => ['required', Rule::in(array_keys($publicos))],
            'faixa_etaria'   => ['required', Rule::in(array_keys($faixas))],
            'categoria'      => ['required', Rule::in(array_keys($categorias))],
            'duracao'        => 'required|in:7,15,30,90',
            'mensagem'       => 'required|max:80',
            'texto'          => 'required|max:250',
            'cta'            => 'required|max:30',
            'fontes'         => 'required',
            'peca_principal' => 'required|image',
            'materiais'      => 'nullable|array',
            'materiais.*'    => 'file|max:10240',
        ]);

        $foto = $request->file('peca_principal')->store('destaques', 'public');

        $materiais = [];
        foreach ($request->file('materiais', []) as $arquivo) {
            $materiais[] = $arquivo->store('destaques/materiais', 'public');
        }

        $tags = [];
        if ($request->filled('tags')) {
            $decodificado = json_decode($request->tags, true);
            $tags = is_array($decodificado)
                ? $decodificado
                : array_values(array_filter(array_map('trim', explode(',', $request->tags))));
        }

        $inicio  = now();
        $termino = now()->addDays((int) $request->duracao);

        Destaque::create([
            'admin_id'                        => Auth::guard('admin')->user()->codAdmin,
            'tituloDestaque'                  => $request->titulo,
            'objetivoDestaque'                => $request->objetivo,
            'publicoalvoDestaque'             => $publicos[$request->publico_alvo],
            'faixaetariaDestaque'             => $faixas[$request->faixa_etaria],
            'categoriaDestaque'               => $categorias[$request->categoria],
            'duracaoDestaque'                 => $request->duracao,
            'tagsDestaque'                    => $tags,
            'mensagemprincipalDestaque'       => $request->mensagem,
            'apresentacaoDestaque'            => $request->texto,
            'ctaDestaque'                     => $request->cta,
            'fontesreferenciaDestaque'        => $request->fontes,
            'fotoprincipalDestaque'           => $foto,
            'materiaiscomplementaresDestaque' => $materiais,
            'statusDestaque'                  => 'ativa',
            'datainicioDestaque'              => $inicio->toDateString(),
            'dataterminoDestaque'             => $termino->toDateString(),
        ]);

        return redirect()
            ->route('destaques')
            ->with('sucesso', 'Destaque publicado com sucesso.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}