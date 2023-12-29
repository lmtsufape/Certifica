<?php

namespace App\Models;
use App\Models\Acao;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{   
    protected $table = 'colaboradores';
    protected $fillable = [
        'gestor_id', 'acao_id', 'user_id',
        // Adicione outros campos conforme necessário
    ];

    // Relacionamento com a tabela de ações
    public function acao()
    {
        return $this->belongsTo(Acao::class, 'acao_id');
    }

    // Relacionamento com a tabela de usuários
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     use HasFactory;
}
