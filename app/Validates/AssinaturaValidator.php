<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\Assinatura;
use Illuminate\Validation\ValidationException;

class AssinaturaValidator {

    public static function validate($data) {
        $validator = Validator::make($data, Assinatura::$rules, Assinatura::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator,"Erro na validação dos dados da Assinatura");
        }

        return $validator;
    }
}