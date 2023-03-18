<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\Participante;
use Illuminate\Validation\ValidationException;

class ParticipanteValidator {

    public static function validate($data, $rules = null) {
        if($rules == null){
            $rules = Participante::$rules;
        }
        $validator = Validator::make($data, $rules, Participante::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação dos dados do participante");
        }

        return $validator;
    }
}
