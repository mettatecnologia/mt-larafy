<?php

namespace App\Services;

use App\Services\AllService;

use App\Models\AllModel;

class PessoaService extends AllService  {

    const PAPEL_SUPER = 'SUP';
    const PAPEL_ADMINISTRADOR = 'ADM';
    const PAPEL_USUARIO = 'USR';

    private static $papeis=[];

    public function __construct(){
        $this->setPapeis();
    }

    public static function setPapeis(){
        $ColunaInfo = AllModel::getColunaInfo('pessoas','papel');
        if($ColunaInfo && $ColunaInfo->DATA_TYPE=='enum'){
            self::$papeis = AllModel::extrairValoresEnum($ColunaInfo->COLUMN_TYPE);
        }
    }

    public static function getPapeis(){
        $papeis = self::$papeis;
        if(self::pessoaPapel()!=self::PAPEL_SUPER){
            $papeis = array_diff($papeis, [self::PAPEL_SUPER]);
        }
        $papeis = array_values($papeis);
        return $papeis;
    }

}
