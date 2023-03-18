<?php

namespace App\Validates;
use Illuminate\Support\Facades\Validator;
use App\Models\Natureza;
use Illuminate\Validation\ValidationException;

class NaturezaValidator {

    public static function validate($data) {
        $validator = Validator::make($data, Natureza::$rules, Natureza::$mensages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação dos dados");
        }

        return $validator;
    }

}