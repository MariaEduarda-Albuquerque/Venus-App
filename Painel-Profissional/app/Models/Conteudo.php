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
        'objetivoConteudo',
        'publicoAlvoConteudo',
        'periodoInicioConteudo',
        'periodoFimConteudo',
        'tagsConteudo',
        'mensagemPrincipalConteudo',
        'chamadaAcaoConteudo',
        'fontesConteudo',
        'fundoConteudo',
    ];

    // Sem isso, dataPublicacao chega como texto e ->format() quebra (ex.: tela de Relatórios)
    protected $casts = [
        'dataPublicacao' => 'datetime',
        'dataRevisaoConteudo' => 'datetime', // quando o Admin aprovou ou recusou
        'arquivadoEm' => 'datetime',
        'dataPlanejadaConteudo' => 'date',
        'periodoInicioConteudo' => 'date',
        'periodoFimConteudo' => 'date',
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

    public static function resumoPainel($codProfissional, int $meses = 6): array
{
    $itens = static::with('categoria')
        ->where('codProfissionalSaude', $codProfissional)
        ->get();

    // Cards por status
    $status = [];
    foreach (self::STATUS as $chave => $rotulo) {
        $status[$chave] = $itens->where('statusConteudo', $chave)->count();
    }

    // Taxa de aprovação: publicados ÷ enviados para revisão
    $enviados = $status['publicado'] + $status['em_revisao'] + $status['recusado'];
    $taxa = $enviados > 0 ? (int) round($status['publicado'] / $enviados * 100) : null;

    // Publicações por mês (mesma lógica do Relatórios: data de publicação ou, se não houver, de criação)
    $nomesMes = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    $porMes = [];
    for ($i = $meses - 1; $i >= 0; $i--) {
        $mes = now()->startOfMonth()->subMonths($i);
        $total = $itens->filter(function ($c) use ($mes) {
            $data = $c->dataPublicacao ?: $c->dataCriacao;
            return $data && $data->format('Y-m') === $mes->format('Y-m');
        })->count();

        $porMes[] = ['rotulo' => $nomesMes[$mes->month - 1] . '/' . $mes->format('y'), 'total' => $total];
    }

    // Conteúdos por categoria (6 maiores + "Outras")
    $porCategoria = $itens
        ->groupBy(fn ($c) => optional($c->categoria)->nomeTipoCategoria ?: 'Sem categoria')
        ->map(fn ($grupo, $nome) => ['categoria' => $nome, 'total' => $grupo->count()])
        ->sortByDesc('total')
        ->values();

    if ($porCategoria->count() > 6) {
        $resto = $porCategoria->slice(6)->sum('total');
        $porCategoria = $porCategoria->take(6)->push(['categoria' => 'Outras', 'total' => $resto]);
    }

    // Alcance: os 5 publicados com mais visualizações
        $alcance = $itens->where('statusConteudo', 'publicado')
            ->sortByDesc('visualizacoesConteudo')
            ->take(5)
            ->map(fn ($c) => [
                'titulo' => \Illuminate\Support\Str::limit($c->tituloConteudo, 60),
                'visualizacoes' => (int) $c->visualizacoesConteudo,
                'curtidas' => (int) $c->curtidasConteudo,
            ])
            ->values();

        return [
            'status' => $status,
            'total' => array_sum($status),
            'enviados' => $enviados,
            'taxaAprovacao' => $taxa,
            'porMes' => $porMes,
            'porCategoria' => $porCategoria->all(),
            'alcance' => $alcance->all(),
        ];
    }

    public static function calcularTempoLeitura(?string $corpo): ?int
    {
        $palavras = preg_match_all('/\S+/u', strip_tags((string) $corpo));

        return $palavras ? max(1, (int) ceil($palavras / 200)) : null;
    }
}