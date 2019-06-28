<?php

namespace App\Traits;

use App\Models\Tables\Config;
use App\Models\Tables\ConfigValor;
use App\Models\Views\VConfigValor;

trait TConfig {

    public static function config($nome_interno, $com_valores=true) {
        $Config = VConfigValor::where('nome_interno',$nome_interno)->first();
        if($Config){
            if($com_valores){
                $Valores = ConfigValor::where('config_id',$Config->id)->get();
                return array_merge($Config->toArray(),['valores'=>$Valores->toArray()]);
            }
            else {
                return $Config->toArray();
            }

        }
        return $Config;
    }

    public static function configValor($nome_interno) {
        $config = self::config($nome_interno) ?? [];
        if(key_exists('valores',$config)){
            $valores = array_map(function($valor){ return $valor['valor']; }, $config['valores']);
            return $valores;
        }

        return null;
    }

}
