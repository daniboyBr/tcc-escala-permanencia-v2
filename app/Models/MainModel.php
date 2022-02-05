<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;

class MainModel extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

	public static function boot()
	{
		parent::boot();

		self::creating(function ($model) {
			$model->id_inseridoPor = Auth::user()->id;
		});

		self::updating(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id;
		});

		self::deleting(function ($model) {
			$model->id_atualizadoPor = Auth::user()->id;
		});
	}
}
