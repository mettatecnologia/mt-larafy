<?php

namespace App\Traits;

use App\Models\Tables\Config;

trait TConfig {

    public static function config($nome_interno) {
        return Config::where('nome_interno',$nome_interno)->first();
    }

    public static function configValor($nome_interno) {
        $config = Config::where('nome_interno',$nome_interno)->first();
        return $config ? $config->valor : null;
    }
    
}
