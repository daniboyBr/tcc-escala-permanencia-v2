<?php

namespace App\Models;

use App\Models\Escala;
use App\Models\Impedimento;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Militar extends Authenticatable implements Auditable
{	        
	use \OwenIt\Auditing\Auditable;
	use HasApiTokens;
	use HasFactory;
	use Notifiable;

	protected $table = 'militar';

	protected $auditExclude = [
        'password',
		'remember_token',
		'email_verified_at'
    ];

	protected $auditInclude = [
		'name',
		'email',
		'password',
		'nomeGuerra',
		'imagem',
		'ramal',
		'telefoneResidencial',
		'telefoneCelular',
		'flgAtivo',
		'inseridoPor',
		'atualizadoPor',
		'organizacaoMilitar_id',
		'secao_id',
		'postoGraduacao_id'
    ];

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
		'flgAtivo',
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

	public function impedimentos()
	{
		return $this->hasMany(Impedimento::class, 'militar_id', 'id');
	}

	public static function boot()
	{
		parent::boot();

		self::creating(function ($model) {
			$model->id_inseridoPor = Auth::user()->id?? null;
		});

		self::updating(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id ?? Militar::find(2)->id;
		});

		self::deleting(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id ?? Militar::find(2)->id;
		});
	}

	public function escala(){
		$this->belongsTo(Escala::class, 'id', 'militar_id');
	}
}
