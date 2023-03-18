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

}