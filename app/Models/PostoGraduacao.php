<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostoGraduacao extends MainModel
{
	use HasFactory;

	const PRIMARY_KEY = 'id';

	protected $table = 'postoGraduacao';

	protected $fillable = ['nome', 'nivel', 'flAtivo'];

	// protected static function newFactory()
	// {
	//     return PostoGraduacaoFactory::new();
	// }

	public function postoServico()
	{
		return $this->belongsToMany(
            PostoServico::class,  
            PostoGraduacaoPostoServico::TABLE,
            PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID, // in PostoGraduacaoPostoServico
            PostoGraduacaoPostoServico::POSTO_SERVICO_ID, // in on PostoGraducao
            PostoServico::PRIMARY_KEY, // in Escala,
            self::PRIMARY_KEY // in PostoGraducaoPostoServico
        );
	}
}
