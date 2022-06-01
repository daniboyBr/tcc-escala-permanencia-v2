<?php

namespace App\Models;

use App\Models\MainModel;
use App\Models\PostoServico;
use App\Models\PostoGraduacao;

class PostoGraduacaoPostoServico extends MainModel
{
    const TABLE = 'pgPostoServico';
    const PRIMARI_KEY = 'id';
    const POSTO_GRADUACAO_ID = 'postoGraduacao_id';
    const POSTO_SERVICO_ID = 'postoServico_id';

    protected $table = self::TABLE;

    public function postoGraducao()
    {
        return $this->belongsTo(PostoGraduacao::class, self::POSTO_GRADUACAO_ID, PostoGraduacao::PRIMARY_KEY);
    }

    public function postoServico()
    {
        return $this->belongsTo(PostoServico::class, self::POSTO_SERVICO_ID, PostoServico::PRIMARY_KEY);
    }
}