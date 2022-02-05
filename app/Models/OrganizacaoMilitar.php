<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizacaoMilitar extends MainModel
{
	use HasFactory;

	protected $table = 'organizacaoMilitar';

	protected $fillable = ['nome', 'sigla', 'flgAtivo'];

	public function secao()
	{
		return $this->hasMany(Secao::class, 'organizacaoMilitar_id', 'id');
	}

	// protected static function newFactory()
	// {
	// 	return OrganizacaoMilitarFactory::new();
	// }
}
