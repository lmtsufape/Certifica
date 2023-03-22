<?php

namespace App\Validates;

use Illuminate\Support\Facades\Validator;
use App\Models\CertificadoModelo;
use Illuminate\Validation\ValidationException;

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
}