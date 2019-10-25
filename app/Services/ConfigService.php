<?php

namespace App\Services;

use App\Services\AllService;

use App\Models\Tables\Config;

class ConfigService extends AllService  {

    private static $papeis=[];

    public function __construct(){
        $this->setPapeis();
    }

    public static function buscarParaDatatableCrud($config_id=null){

        $Configs = $config_id ? Config::where('id',$config_id)->get() : Config::get();

        $configs = [];
        foreach ($Configs as $key => $Config) {
            $Valores = $Config->valores()->get();

            $config = $Config->toArray();
            if($Valores->count()){
                foreach ($Valores as $key => $Valor) {
                    $config['valores'][] = $Valor->valor;
                }
            }
            else {
                $config['valores'][] = null;
            }
            $configs[] = $config;
        }

        return $configs;
    }


}
