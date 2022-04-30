<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Impedimento extends MainModel
{
    use HasFactory;

    protected $table = 'impedimento';

    protected $fillable = ['militar_id','arquivo','dataInicio','dataFinal'];

    protected $dates = ['dataInicio', 'dataFinal'];

    public function militar(){
        return $this->hasOne(Militar::class, 'militar_id','id');
    }

}
