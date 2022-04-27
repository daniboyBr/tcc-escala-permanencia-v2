<?php

namespace App\Models;

use App\Models\MainModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostoServico extends MainModel
{
    use HasFactory;

    protected $table = 'postoServico';

    protected $fillable = ['nome','flAtivo'];
}
