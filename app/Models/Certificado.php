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


    public function atividade(){
        return $this->belongsTo(Atividade::class);
    }

    public function participante($atividade_id, $cpf){
        $participantes = Atividade::find($atividade_id)->participantes;
        $participante = $participantes->where('user.cpf', $cpf)->first();
        
        return $participante;
    }

    public static function search_acao($certificados, $nome_acao){
        $acoes = Acao::where('titulo', 'ilike', '%'.$nome_acao.'%')->get();
        return $certificados->whereIn('atividade.acao', $acoes);
    }

    public static function search_natureza($certificados, $natureza){
        $naturezas = Natureza::where('id', $natureza)->get();
        return $certificados->whereIn('atividade.acao.tipo_natureza.natureza', $naturezas);
    }

    public static function search_tipo_natureza($certificados, $tipo_natureza){
        $tipos = TipoNatureza::find($tipo_natureza);
        return $certificados->where('atividade.acao.tipo_natureza', $tipos);
    }

    public static function search_atividade($certificados, $nome_atividade){
        $atividades = Atividade::where('descricao', 'ilike', '%'.$nome_atividade.'%')->get();
        return $certificados->whereIn('atividade', $atividades);
    }
}
