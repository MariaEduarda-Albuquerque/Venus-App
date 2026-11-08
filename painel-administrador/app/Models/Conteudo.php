<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    protected $table = 'tbconteudo';

    protected $primaryKey = 'codConteudo';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = 'dataAtualizacao';

    // enum('rascunho','em_revisao','publicado','recusado')
    const STATUS_RASCUNHO  = 'rascunho';
    const STATUS_ANALISE   = 'em_revisao';
    const STATUS_PUBLICADO = 'publicado';
    const STATUS_RECUSADO  = 'recusado';

    protected $fillable = [
        'tituloConteudo',
        'objetivoConteudo',
        'corpoConteudo',
        'fontesConteudo',
        'capaConteudo',
        'tempoLeituraMinutos',
        'codTipoCategoria',
        'codTipoConteudo',
        'codProfissionalSaude',
        'codAdminCriador',
        'statusConteudo',
        'dataEnvio',
        'motivoRecusaConteudo',
        'dataPublicacao',
        'dataRevisaoConteudo',
        'publicoAlvoConteudo',
        'periodoInicioConteudo',
        'periodoFimConteudo',
        'tagsConteudo',
        'mensagemPrincipalConteudo',
        'chamadaAcaoConteudo',
        'fundoConteudo',
    ];

    protected function casts(): array
    {
        return [
            'dataCriacao' => 'datetime',
            'dataAtualizacao' => 'datetime',
            'dataEnvio' => 'datetime',
            'dataPublicacao' => 'datetime',
            'dataRevisaoConteudo' => 'datetime',
            'periodoInicioConteudo' => 'date',
            'periodoFimConteudo' => 'date',
            'dataPlanejadaConteudo' => 'date',
            'arquivadoEm' => 'datetime',
        ];
    }

    /* ---------- Relações ---------- */

    public function tipoConteudo()
    {
        return $this->belongsTo(
            TipoConteudo::class,
            'codTipoConteudo',
            'codTipoConteudo'
        );
    }

    public function tipoCategoria()
    {
        return $this->belongsTo(
            TipoCategoria::class,
            'codTipoCategoria',
            'codTipoCategoria'
        );
    }

    // ATENÇÃO: a tabela `users` é a padrão do Laravel. O profissional está em
    // `tbprofissionalsaude`. Se você tiver um model para ela (ex.: Profissional),
    // troque User::class por ele. A tela de revisão NÃO depende desta relação.
    public function profissional()
    {
        return $this->belongsTo(
            User::class,
            'codProfissionalSaude',
            'codProfissionalSaude'
        );
    }

    /* ---------- Escopos ---------- */

    // Só o que foi enviado para revisão ou já decidido (exclui rascunhos)
    public function scopeParaRevisao($query)
    {
        return $query->whereIn('tbconteudo.statusConteudo', [
            self::STATUS_ANALISE,
            self::STATUS_PUBLICADO,
            self::STATUS_RECUSADO,
        ]);
    }

    // Traz autor (profissional ou admin), tipo e categoria em uma consulta só.
    // Cria as colunas: autor_nome, autor_email, autor_cargo, tipo_nome, categoria_nome
    public function scopeComAutor($query)
    {
        return $query
            ->leftJoin('tbprofissionalsaude as p', 'p.codProfissionalSaude', '=', 'tbconteudo.codProfissionalSaude')
            ->leftJoin('tbadmin as a', 'a.codAdmin', '=', 'tbconteudo.codAdminCriador')
            ->leftJoin('tbtipoconteudo as tc', 'tc.codTipoConteudo', '=', 'tbconteudo.codTipoConteudo')
            ->leftJoin('codtipocategoria as cat', 'cat.codTipoCategoria', '=', 'tbconteudo.codTipoCategoria')
            ->select('tbconteudo.*')
            ->selectRaw("COALESCE(p.nomeProfissionalSaude, a.nomeAdmin, 'Equipe Vênus') as autor_nome")
            ->selectRaw("COALESCE(p.emailProfissionalSaude, a.emailAdmin, '—') as autor_email")
            ->selectRaw("COALESCE(p.especialidadeProfissionalSaude, p.categoriaProfissional, 'Administração') as autor_cargo")
            ->selectRaw('tc.descricaoTipoConteudo as tipo_nome')
            ->selectRaw('cat.nomeTipoCategoria as categoria_nome');
    }

    /* ---------- Acessores ---------- */

    // CO000006
    public function getCodigoAttribute(): string
    {
        return 'CO' . str_pad((string) $this->getKey(), 6, '0', STR_PAD_LEFT);
    }

    // Chave usada pelo front: analise | publicado | recusado
    public function getStatusUiAttribute(): string
    {
        return match ($this->statusConteudo) {
            self::STATUS_PUBLICADO => 'publicado',
            self::STATUS_RECUSADO  => 'recusado',
            default                => 'analise',
        };
    }

    /* ---------- Regras ---------- */

    public function publicado(): bool
    {
        return $this->statusConteudo === self::STATUS_PUBLICADO;
    }

    public function emAnalise(): bool
    {
        return $this->statusConteudo === self::STATUS_ANALISE;
    }

    public function editavel(): bool
    {
        return in_array(
            $this->statusConteudo,
            [self::STATUS_RASCUNHO, self::STATUS_RECUSADO],
            true
        );
    }

    public static function calcularTempoLeitura(?string $texto): int
    {
        preg_match_all('/[\p{L}\p{N}]+/u', strip_tags($texto ?? ''), $matches);

        $palavras = count($matches[0]);

        return max(1, (int) ceil($palavras / 200));
    }
}