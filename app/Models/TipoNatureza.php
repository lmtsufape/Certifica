<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNatureza extends Model
{
    use HasFactory;
    protected $table = 'tipo_naturezas';

    protected $fillable = ['descricao'];
}
