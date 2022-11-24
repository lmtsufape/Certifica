<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoModelo extends Model
{
    use HasFactory;
    protected $table = 'certificado_modelos';
    protected $fillable = ['unidade_adiministrativa_id', 'texto_posicao',
     'data_posicao', 'assinatura_direita', 'assinatura_esquerda'];
}
