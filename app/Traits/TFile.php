<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait TFile {

    public static function criaCaminho(...$partes){
        $partes = array_filter($partes); //remove elementos null
        $caminho_completo = implode(DIRECTORY_SEPARATOR, $partes);
        return $caminho_completo;
    }

    public static function criaCaminhoApp(...$partes){
        array_unshift($partes, storage_path('app'));
        
        $partes = array_filter($partes); //remove elementos null
        $caminho_completo = implode(DIRECTORY_SEPARATOR, $partes);
        return $caminho_completo;
    }

    public static function criaDiretorio($caminho){
        if( ! file_exists($caminho)){
            mkdir($caminho, 0777, true);
        }
        return $caminho;
    }

    public static function criaNomeArquivoDatetime($file_name, $extensao){
        
        $file_novonome = explode('.',$file_name) ;
        array_pop($file_novonome);
        $file_novonome = implode('.',$file_novonome) ;
        $file_novonome = self::desacentuar($file_novonome);
        $file_novonome .= "__" . (new \Datetime())->format('YmdHisu') . "." . $extensao ;

        return $file_novonome;

    }

    public static function desacentuar($string){
        return preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    }


}
