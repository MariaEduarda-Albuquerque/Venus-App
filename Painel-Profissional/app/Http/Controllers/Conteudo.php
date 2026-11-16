<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conteudo extends Model
{
    protected $table = 'tbconteudo';
    protected $primaryKey = 'codConteudo';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = 'dataAtualizacao';

    public const STATUS = [
        'rascunho'   => 'Rascunho',
        'em_revisao' => 'Em revisão',
        'publicado'  => 'Publicado',
        'recusado'   => 'Recusado',
    ];

    // Descrição (em minúsculas) do tipo de conteúdo que é campanha
    public const TIPO_CAMPANHA = 'campanha';

    protected $fillable = [
        'tituloConteudo',
        'corpoConteudo',
        'capaConteudo',
        'tempoLeituraMinutos',
        'codTipoCategoria',
        'codTipoConteudo',
        'codProfissionalSaude',
        'statusConteudo',
        'dataPlanejadaConteudo',
    ];

    // Sem isso, dataPublicacao chega como texto e ->format() quebra (ex.: tela de Relatórios)
    protected $casts = [
        'dataPublicacao' => 'datetime',
        'dataRevisaoConteudo' => 'datetime', // quando o Admin aprovou ou recusou
        'arquivadoEm' => 'datetime',
        'dataPlanejadaConteudo' => 'date',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(TipoCategoria::class, 'codTipoCategoria', 'codTipoCategoria');
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoConteudo::class, 'codTipoConteudo', 'codTipoConteudo');
    }

    public function profissional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'codProfissionalSaude', 'codProfissionalSaude');
    }

    public function getStatusRotuloAttribute(): string
    {
        return self::STATUS[$this->statusConteudo] ?? $this->statusConteudo;
    }

    public function getEhCampanhaAttribute(): bool
    {
        return mb_strtolower((string) optional($this->tipo)->descricaoTipoConteudo) === self::TIPO_CAMPANHA;
    }

    public function getNaturezaRotuloAttribute(): string
    {
        return $this->eh_campanha ? 'Campanha' : 'Conteúdo';
    }

    public static function calcularTempoLeitura(?string $corpo): ?int
    {
        $palavras = preg_match_all('/\S+/u', strip_tags((string) $corpo));

        return $palavras ? max(1, (int) ceil($palavras / 200)) : null;
    }
}