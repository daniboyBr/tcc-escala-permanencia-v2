<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secao extends MainModel
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
