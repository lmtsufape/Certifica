<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\CertificadoModelo;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;


class CertificadoModeloValidator {

    public static function validate($data, $rules = null) {
        if($rules == null){
            $rules = CertificadoModelo::$rules;
        }
        $validator = Validator::make($data, $rules, CertificadoModelo::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator,"Erro na validação dos dados do Modelo de Certificado");
        }

        return $validator;
    }

    public static function validate_acao($acao){
        $acoes = [];

        foreach($acao->atividades as $atividade){

            $certificado_modelo = CertificadoModelo::where("unidade_administrativa_id", Auth::user()->unidade_administrativa_id )
                                                    ->where("tipo_certificado", $atividade->descricao)->first();

            if($certificado_modelo == null){
                array_push($acoes, $atividade->descricao);
            }
        }

        if($acoes){
            return 'É necessário criar os modelos de certificados para as seguintes funções: '.implode(" / ",$acoes);
        }
    }
}