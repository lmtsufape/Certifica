<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAtividade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unidade_administrativa_id'
    ];

    public function unidadeAdministrativa() {
        return $this->belongsTo(UnidadeAdministrativa::class);
    }

}
