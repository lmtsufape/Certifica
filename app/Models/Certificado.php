<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'certificados';
    protected $fillable = ['atividade_id', 'certificado_modelo_id',
     'assinatura_esquerda', 'img_fundo', 'texto', 'logo'];
}
