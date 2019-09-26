<?php

namespace App\Services;

use App\Services\AllService;

use App\Models\AllModel;
use App\Models\Tables\Pessoa;

class PessoaService extends AllService  {

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
        if(self::pessoaPapel()!=Pessoa::PAPEL_SUPER){
            $papeis = array_diff($papeis, [Pessoa::PAPEL_SUPER]);
        }
        $papeis = array_values($papeis);
        return $papeis;
    }

}
