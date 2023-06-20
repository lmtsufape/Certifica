<?php

namespace App\Models\Utils;


class Mask
{
    public static function mask($dado, $mascara)
    {
        $result = "";
        $digito = 0;

        if(strlen($dado) == strlen($mascara)){            
            return $dado;
        }


        for ($i = 0; $i < strlen($mascara); $i++){      
            if($mascara[$i] == "#"){
                if(isset($dado[$digito])){
                    $result .= $dado[$digito++];
                } 
            } else{
                $result .= $mascara[$i];
            }
            

        }
        
        
        return $result;
    }


}
