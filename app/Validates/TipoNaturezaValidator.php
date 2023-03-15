<?php

namespace App\Validates;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoNatureza;
use Illuminate\Validation\ValidationException;

class TipoNaturezaValidator {

    public static function validate($data) {
        $validator = Validator::make($data, TipoNatureza::$rules, TipoNatureza::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Não foi possível cirar um novo tipo de natureza");
        }

        return $validator;
    }

}