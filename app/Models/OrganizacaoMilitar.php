<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizacaoMilitar extends Model
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
