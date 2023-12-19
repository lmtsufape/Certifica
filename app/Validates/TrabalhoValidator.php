<?php

namespace App\Validates;

use App\Models\Trabalho;
use Illuminate\Support\Facades\Validator;
use App\Models\Atividade;
use Illuminate\Validation\ValidationException;

class TrabalhoValidator {

    public static function validate($data) {
        $validator = Validator::make($data, Trabalho::$rules, Trabalho::$mensages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator,"Erro na validação dos dados da atividade");
        }

        return $validator;
    }
}
