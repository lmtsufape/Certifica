<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\Atividade;
use Illuminate\Validation\ValidationException;

class AtividadeValidator {

    public static function validate($data) {
        $validator = Validator::make($data, Atividade::$rules, Atividade::$mensages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator,"Erro na validação dos dados da atividade");
        }

        return $validator;
    }
}