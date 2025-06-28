<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'titulo',
        'carga_horaria',
        'atividade_id',
        'user_id',
        'coautor_trabalhos_id',
        'autor_trabalhos_id',
        'info_externa_participante_id'

    ];

    public static $rules = [
        'nome' => 'required|min:5',
        'email' => 'required|email',
        'instituicao_id' => 'required',
        'instituicao' => 'required_if:instituicao_id,2',
        'carga_horaria' => 'required|numeric',
        'atividade_id' => 'required',
    ];

    public static $editRules = [
        'carga_horaria' => 'required|numeric',
        'atividade_id' => 'required',
    ];

    public static $messages = [
        'nome.*' => 'O nome do participante é obrigatório e deve ter no mínimo 5 caractéres',
        'email.*' => 'O e-mail é obrigatório e deve ser um endereço de e-mail válido',
        'cpf.regex' => 'O CPF é obrigatório e deve ser um número de CPF válido',
        'carga_horaria.required' => 'A carga horária é obrigatória',
        'carga_horaria.numeric' => 'A carga horária deve ser um numero',
        'instituicao.*' => 'Ao selecionar Outras no campo instituição, é preciso informar a sua instituição'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atividade(){
        return $this->belongsTo(Atividade::class);
    }
    public function autorDoTrabalho() {
        return $this->belongsTo(Trabalho::class, 'autor_trabalhos_id');
    }

    public function coautorDoTrabalho() {
        return $this->belongsTo(Trabalho::class, 'coautor_trabalhos_id');
    }

    public function infoExterna()
    {
        return $this->hasOne(InfoExternaParticipante::class);
    }



    public static function search_acao($participacoes, $nome_acao){
        $acoes = Acao::where('titulo', 'ilike', '%'.$nome_acao.'%')->get();
        $participacoes_aux = [];
        foreach($participacoes as $part){

            if($acoes->contains($part->atividade->acao)){
                array_push($participacoes_aux, $part);
            }

        }

        return $participacoes_aux;
    }




    public static function search_data($participacoes, $data){
        $participacoes_aux = [];
        foreach($participacoes as $part){
            $inicio = $part->atividade->data_inicio;
            $fim = $part->atividade->data_fim;

            if($inicio <= $data && $fim >= $data){
                array_push($participacoes_aux, $part);
            }

        }

        return $participacoes_aux;
    }


    public static function search_natureza($participacoes, $natureza){
        $participacoes_aux = [];

        foreach($participacoes as $part){
            if($part->atividade->acao->tipo_natureza->natureza->id == $natureza){
                array_push($participacoes_aux, $part);
            }

        }

        return $participacoes_aux;
    }

    public function invalidar_reemitir_certificado($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);

        $emitir = null;

        if(Certificado::where('atividade_id', $participante->atividade_id)->where('cpf_participante', $participante->user->cpf)->get()->isEmpty()) {
            $emitir = true;
        } else {
            $emitir = false;
        }

        return $emitir;
    }

}
