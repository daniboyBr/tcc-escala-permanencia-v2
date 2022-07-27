<?php

namespace App\Models;

use App\Models\MainModel;
use App\Models\PostoGraduacao;
use App\Models\PostoGraduacaoPostoServico;

class Escala extends MainModel 
{
    const PG_POSTO_SERVICO_ID = 'pgPostoServico_id';

    protected $table = 'escala';

    protected $dates = ['data'];

    protected $fillable = [
        'postoServico_id',
        'militar_id',
        'militarTroca_id',
        'data',
        'livroPermanencia',
        'emailEnviado',
        'telegramEnviado',
        'FlgCiente',
        'dtFlgCiente',
        'dtFlgCienteTroca',
        'tokenCiente',
        'tokenCienteTroca',
        'observacao',
        'observacaoTroca',
        'uuidEscala'
    ];

    public function militar()
    {
        return $this->belongsTo(Militar::class, 'militar_id', 'id');
    }

    public function militarTroca()
    {
        return $this->belongsTo(Militar::class, 'militarTroca_id', 'id');
    }

    public function postoServico()
    {
        return $this->hasOneThrough(
            PostoServico::class,  
            PostoGraduacaoPostoServico::class,
            PostoGraduacaoPostoServico::PRIMARI_KEY, // in PostoGraduacaoPostoServico
            PostoServico::PRIMARY_KEY, // in on PostoGraducao
            self::PG_POSTO_SERVICO_ID, // in Escala,
            PostoGraduacaoPostoServico::POSTO_SERVICO_ID // in PostoGraducaoPostoServico
        );
    }

    public function postoGraducao()
    {
        return $this->hasOneThrough(
            PostoGraduacao::class,  
            PostoGraduacaoPostoServico::class,
            PostoGraduacaoPostoServico::PRIMARI_KEY, // in PostoGraduacaoPostoServico
            PostoGraduacao::PRIMARY_KEY, // in on PostoGraducao
            self::PG_POSTO_SERVICO_ID, // in Escala,
            PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID // in PostoGraducaoPostoServico
        );
    }
}