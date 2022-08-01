<?php

namespace App\Models;

use App\Models\MainModel;
use App\Models\PostoGraduacao;
use App\Models\PostoGraduacaoPostoServico;

class Escala extends MainModel 
{
    const POSTO_SERVICO_ID = 'postoServico_id';

    protected $table = 'escala';

    protected $dates = ['data', 'dtFlgCiente',  'dtFlgCienteTroca'];

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
        return $this->belongsTo(PostoServico::class, 'postoServico_id', 'id');
        // return $this->hasOneThrough(
        //     PostoServico::class,  
        //     PostoGraduacaoPostoServico::class,
        //     PostoGraduacaoPostoServico::PRIMARI_KEY, // in PostoGraduacaoPostoServico
        //     PostoServico::PRIMARY_KEY, // in on PostoGraducao
        //     self::PG_POSTO_SERVICO_ID, // in Escala,
        //     PostoGraduacaoPostoServico::POSTO_SERVICO_ID // in PostoGraducaoPostoServico
        // );
    }

    public function postoGraduacao()
    {
        return $this->hasManyThrough(
            PostoGraduacao::class,  
            PostoGraduacaoPostoServico::class,
            PostoGraduacaoPostoServico::POSTO_SERVICO_ID, // in PostoGraduacaoPostoServico
            PostoGraduacao::PRIMARY_KEY, // in on PostoGraducao
            self::POSTO_SERVICO_ID, // in Escala,
            PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID // in PostoGraducaoPostoServico
        );
    }
}