<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostoServico extends MainModel
{
    use HasFactory;

    const PRIMARY_KEY = 'id';

    protected $table = 'postoServico';

    protected $fillable = ['nome','flAtivo'];

    public function postoGraduacao()
	{
		return $this->belongsToMany(
            PostoGraduacao::class,  
            PostoGraduacaoPostoServico::TABLE,
            PostoGraduacaoPostoServico::POSTO_SERVICO_ID, // in on PostoGraduacaoPostoServico
            PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID, // in PostoGraduacaoPostoServico
            PostoGraduacao::PRIMARY_KEY, // in PostoGraducaoPostoServico
            self::PRIMARY_KEY // in Escala,
        );
	}
}
