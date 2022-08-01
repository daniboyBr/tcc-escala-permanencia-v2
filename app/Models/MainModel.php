<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;

class MainModel extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;


	public function whoCreated()
	{
		return $this->belongsTo(Militar::class, 'id_inseridoPor', 'id');
	}

	public function whoUpdated()
	{
		return $this->belongsTo(Militar::class, 'id_atualizadoPor', 'id');
	}

	public static function boot()
	{
		parent::boot();

		self::creating(function ($model) {
			$id = null;


			if($logued = Auth::user()){
				$id = $logued->id;
			}elseif($system = Militar::find(2)){
				$id = $system->id;
			}

			$model->id_inseridoPor = $id;
		});

		self::updating(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id ?? Militar::find(2)->id;
		});

		self::deleting(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id ?? Militar::find(2)->id;
		});
	}
}
