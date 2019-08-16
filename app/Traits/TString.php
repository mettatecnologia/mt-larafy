<?php

namespace App\Traits;

trait TString {

    public static function desacentuar($string){
        return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    }

    protected static function number_format($numero , int $quant_casas_decimais = 0 , string $sep_decimal = "," , string $sep_milhar = "."){
        return number_format($numero, $quant_casas_decimais, $sep_decimal, $sep_milhar);
    }

    protected static function formato_moeda_brasil($numero, int $quant_casas_decimais = 2){
        return self::number_format($numero, $quant_casas_decimais);
    }

    public static function criarNomeUnicoDatetime($nome_base=null, $separador=null){
        return $nome_base.$separador.self::datetimeNow('YmdHisu');
    }


}
