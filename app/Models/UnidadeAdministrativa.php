<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class UnidadeAdministrativa extends Model
{
    use HasFactory;
    protected $table = 'unidade_administrativas';

    protected $fillable = ['descricao'];

    public function CertificadoModelos(){
        return $this->hasMany(CertificadoModelos::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function acaos(){
        return $this->hasMany(Acao::class);
    }
}
