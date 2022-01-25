<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostoGraduacao extends Model
{
	use HasFactory;

	protected $table = 'postoGraduacao';

	protected $fillable = ['nome', 'nivel', 'flAtivo'];

	// protected static function newFactory()
	// {
	//     return PostoGraduacaoFactory::new();
	// }
}
