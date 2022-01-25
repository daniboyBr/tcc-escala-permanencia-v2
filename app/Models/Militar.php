<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Militar extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use Notifiable;

	protected $table = 'militar';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'nomeGuerra',
		'imagem',
		'ramal',
		'telefoneResidencial',
		'telefoneCelular',
		'email',
		'flAtivo',
		'inseridoPor',
		'atualizadoPor',
		'organizacaoMilitar_id',
		'secao_id',
		'postoGraduacao_id'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function organizacao()
	{
		return $this->hasOne(OrganizacaoMilitar::class, 'id', 'organizacaoMilitar_id');
	}

	public function secao()
	{
		return $this->hasOne(Secao::class, 'id', 'secao_id');
	}

	public function graduacao()
	{
		return $this->hasOne(PostoGraduacao::class, 'id', 'postoGraduacao_id');
	}
}
