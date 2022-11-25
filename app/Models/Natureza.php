<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natureza extends Model
{
    use HasFactory;

    protected $table = 'naturezas';

    protected $fillable = ['descricao', 'tipo_natureza_id', 'unidade_administrativa_id'];
}
