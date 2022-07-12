<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoImpedimento extends MainModel
{
    use HasFactory;

    const TABLE = 'tipoImpedimento';

	protected $table = self::TABLE;

    protected $fillable = ['nome', 'flAtivo'];

}
