<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostoGraduacao extends MainModel
{
	use HasFactory;

	protected $table = 'postoGraduacao';

	protected $fillable = ['nome', 'nivel', 'flAtivo'];

	// protected static function newFactory()
	// {
	//     return PostoGraduacaoFactory::new();
	// }
}
