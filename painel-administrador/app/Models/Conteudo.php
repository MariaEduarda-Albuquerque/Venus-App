<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    protected $table = 'tbconteudo';

    protected $primaryKey = 'codConteudo';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = 'dataAtualizacao';

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

    public function profissional()
    {
        return $this->belongsTo(
            User::class,
            'codProfissionalSaude',
            'codProfissionalSaude'
        );
    }

    public function publicado(): bool
    {
        return $this->statusConteudo === 'publicado';
    }

    public function editavel(): bool
    {
        return in_array(
            $this->statusConteudo,
            ['rascunho', 'recusado'],
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