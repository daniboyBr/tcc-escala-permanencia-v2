<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secao extends Model
{
	use HasFactory;

	protected $table = 'secao';

	protected $fillable = ['nome', 'flAtivo', 'organizacaoMilitar_id'];

	public function organizacao()
	{
		return $this->belongsTo(OrganizacaoMilitar::class, 'organizacaoMilitar_id', 'id');
	}

	// protected static function newFactory()
	// {
	// 	return SecaoFactory::new();
	// }
}
