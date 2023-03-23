<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DefaultValidator {

    public static function validate($data, $rules, $messages) {

        $validator = Validator::make($data, $rules, $messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação dos dados");
        }

        return $validator;
    }
}