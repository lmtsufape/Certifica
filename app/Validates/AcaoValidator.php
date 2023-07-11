<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\Acao;
use Illuminate\Validation\ValidationException;

class AcaoValidator {

    public static function validate($data) {
        $validator = Validator::make($data, Acao::$rules, Acao::$messages);

        if (!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação dos dados da Ação.");
        }

        return $validator;
    }


    public static function validate_acao($acao){
        $atividades = $acao->atividades();
        
        // se não existem atividades cadastradas na ação
        if(!$atividades->first()){
            return 'É preciso existir pelo menos uma atividade cadastrada para submeter a ação';
        }

        //se existe atividades sem participantes
        $count = false;

        foreach($atividades->get() as $atividade){

            if($atividade->participantes->count() < 1){
                $count = true;
                return 'É preciso existir pelo menos um participante em cada atividade cadastrada para submeter a ação';
            }
        }
    }

}