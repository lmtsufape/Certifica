<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    protected $table = 'certificados';
    protected $fillable = ['atividade_id', 'certificado_modelo_id',
     'assinatura_esquerda', 'img_fundo', 'texto', 'logo'];
}
