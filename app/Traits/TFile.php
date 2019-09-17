<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait TFile {

    public static function criaCaminho(...$partes){
        $partes = array_filter($partes); //remove elementos null
        $caminho_completo = self::normalizarCaminho(implode(DIRECTORY_SEPARATOR, $partes));
        return $caminho_completo;
    }

    public static function normalizarCaminho($caminho){
        return implode(DIRECTORY_SEPARATOR, explode('/', preg_replace('/\\\\/', '/', $caminho)));
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

    public static function storage_exists($caminho){
        return Storage::exists($caminho);
    }

    public static function getStorageTempFolder(){
        return self::criaCaminho(storage_path('app'), 'temp');
    }

    public static function apagarDiretorioComArquivos($dir) {

        if( ! file_exists($dir)){
            return;
        }

        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::apagarDiretorioComArquivos("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public static function extrairNomeArquivo($nome, $com_extensao=false){
        $nome = self::normalizarCaminho($nome);
        $nome = explode(DIRECTORY_SEPARATOR,$nome);
        $nome = array_pop($nome);
        if($com_extensao)
        {
            return $nome;
        }
        else
        {
            $nome = explode('.',$nome);
            return array_shift($nome);
        }
    }






}
