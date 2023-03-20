<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assinatura extends Model
{
    use HasFactory;
    protected $table = 'assinaturas';

    protected $fillable = ['user_id', 'img_assinatura'];

    public static $rules = [
        'user_id'           => 'required | exists:App\Models\User,id',
        'img_assinatura'    => 'required | image'
    ];

    public static $messages = [
        'user_id.*'         => 'A assinatura deve ser vinculada a um usuário do sistema',
        'img_assinatura.*'  => 'A imagem da assinatura é obrigatória'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
