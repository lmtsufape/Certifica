<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssinaturaCoordenacao extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'assinatura_coordenacaos';

    protected $fillable = ['cargo', 'nome', 'unidade_administrativa_id'];

}
