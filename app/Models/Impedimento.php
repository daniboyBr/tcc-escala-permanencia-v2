<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\FuncCall;

class Impedimento extends MainModel
{
    use HasFactory;

    protected $table = 'impedimento';

    protected $fillable = ['militar_id','arquivo','dataInicio','dataFinal','tipoImpedimento_id'];

    protected $dates = ['dataInicio', 'dataFinal'];

    public function militar(){
        return $this->hasOne(Militar::class, 'militar_id','id');
    }

    public function tipoImpedimento()
    {
        return $this->belongsTo(TipoImpedimento::class, 'id', 'tipoImpedimento_id');
    }
}
