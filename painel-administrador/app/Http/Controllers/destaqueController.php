<?php

namespace App\Http\Controllers;

use App\Models\Destaque;

use Illuminate\Http\Request;

class destaqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'         => 'required|max:80',
            'objetivo'       => 'required|max:250',
            'publico_alvo'   => 'required',
            'faixa_etaria'   => 'required',
            'categoria'      => 'required',
            'duracao'        => 'required',
            'mensagem'       => 'required|max:80',
            'texto'          => 'required|max:250',
            'cta'            => 'required|max:30',
            'fontes'         => 'required',
            'peca_principal' => 'required|image',
        ]);

        // Salva a imagem principal
        $foto = $request->file('peca_principal')->store('destaques', 'public');

        // Datas: começa hoje e termina hoje + duração
        $inicio  = now();
        $termino = now()->addDays((int) $request->duracao);

        Destaque::create([
            'admin_id'                        => auth()->id(),
            'tituloDestaque'                  => $request->titulo,
            'objetivoDestaque'                => $request->objetivo,
            'publicoalvoDestaque'             => $request->publico_alvo,
            'faixaetariaDestaque'             => $request->faixa_etaria,
            'categoriaDestaque'               => $request->categoria,
            'duracaoDestaque'                 => $request->duracao,
            'tagsDestaque'                    => $request->tags,
            'mensagemprincipalDestaque'       => $request->mensagem,
            'apresentacaoDestaque'            => $request->texto,
            'ctaDestaque'                     => $request->cta,
            'fontesreferenciaDestaque'        => $request->fontes,
            'fotoprincipalDestaque'           => $foto,
            'materiaiscomplementaresDestaque' => null,
            'statusDestaque'                  => 'ativa',
            'datainicioDestaque'              => $inicio->toDateString(),
            'dataterminoDestaque'             => $termino->toDateString(),
        ]);

        return redirect('destaques-principais')->with('sucesso', 'Destaque publicado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
