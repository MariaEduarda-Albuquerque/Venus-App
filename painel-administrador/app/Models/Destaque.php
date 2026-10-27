<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destaque extends Model
{
    protected $table = 'tbdestaque';

    protected $primaryKey = 'codDestaque';

    // Valor do banco => texto bonito
    const PUBLICOS = [
        'adolescentes_e_jovens' => 'Adolescentes e jovens',
        'mulheres_adultas'      => 'Mulheres adultas',
        'gestantes'             => 'Gestantes',
        'todas_as_usuarias'     => 'Todas as usuárias',
    ];

    const FAIXAS = [
        '14_25'           => '14 a 25 anos',
        '26_40'           => '26 a 40 anos',
        '41_60'           => '41 a 60 anos',
        'todas_as_idades' => 'Todas as idades',
    ];

    const CATEGORIAS = [
        'ists'               => 'ISTs (Infecções Sexualmente Transmissíveis)',
        'saude_mental'       => 'Saúde mental',
        'saude_reprodutiva'  => 'Saúde reprodutiva',
        'prevencao_e_exames' => 'Prevenção e exames',
    ];

    protected $fillable = [
        'admin_id',
        'tituloDestaque',
        'objetivoDestaque',
        'publicoalvoDestaque',
        'faixaetariaDestaque',
        'categoriaDestaque',
        'duracaoDestaque',
        'tagsDestaque',
        'mensagemprincipalDestaque',
        'apresentacaoDestaque',
        'ctaDestaque',
        'fontesreferenciaDestaque',
        'fotoprincipalDestaque',
        'materiaiscomplementaresDestaque',
        'statusDestaque',
        'datainicioDestaque',
        'dataterminoDestaque',
    ];

    protected $casts = [
        'tagsDestaque'                    => 'array',
        'materiaiscomplementaresDestaque' => 'array',
        'datainicioDestaque'              => 'date',
        'dataterminoDestaque'             => 'date',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // $d->categoria_texto  ->  "ISTs (Infecções Sexualmente Transmissíveis)"
    public function getCategoriaTextoAttribute(): string
    {
        return self::CATEGORIAS[$this->categoriaDestaque] ?? $this->categoriaDestaque;
    }

    // $d->publico_texto  ->  "Adolescentes e jovens (14 a 25 anos)"
    public function getPublicoTextoAttribute(): string
    {
        $publico = self::PUBLICOS[$this->publicoalvoDestaque] ?? $this->publicoalvoDestaque;
        $faixa   = self::FAIXAS[$this->faixaetariaDestaque] ?? $this->faixaetariaDestaque;

        return "$publico ($faixa)";
    }

    // $d->periodo_texto  ->  "27/10/2026 a 26/11/2026"
    public function getPeriodoTextoAttribute(): string
    {
        return $this->datainicioDestaque->format('d/m/Y') . ' a ' . $this->dataterminoDestaque->format('d/m/Y');
    }

    // $d->status_texto  ->  "Ativa" ou "Terminada"
    public function getStatusTextoAttribute(): string
    {
        return ucfirst($this->statusDestaque);
    }
}