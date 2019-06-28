<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Traits\TGeneric;
use App\Traits\TConfig;
use App\Traits\TException;
use App\Traits\TLog;


/**
 * script para recuperar as colunas de alguma tabela
SELECT
	GROUP_CONCAT(a.column_name) colunas,
    GROUP_CONCAT(concat('\'',a.column_name,'\'')) para_array
from information_schema.columns a
where a.table_schema='banco'
and a.table_name='tabela'
 */

class AllModel extends Model {

    use TGeneric, TConfig, TException, TLog;

    const CREATED_AT = 'dtainclusao';
    const UPDATED_AT = 'dtaalteracao';

    public $timestamps = false;

    protected $casts = [
        'ativo' => 'boolean'
    ];

    public static function getTableName()
    {
        return (new self())->getTable();
    }


    public static function getTabelaInfo($tabela_nome=null){
        return self::queryTabelaInfo($tabela_nome)->first();
    }

    public static function getColunaInfo($tabela_nome=null, $coluna_nome=null){
        return self::queryColunaInfo($tabela_nome, $coluna_nome)->first();
    }

    public static function extrairValoresEnum($enum_valores){
        preg_match_all('/\'([^"]+)\'/', $enum_valores, $matches);
        return explode(',',str_replace('\'','',$matches[0][0]));
    }

    public static function getColunaTipo($tabela_nome=null, $coluna_nome=null){
        return self::queryColunaInfo($tabela_nome, $coluna_nome)->first();
    }

    private static function queryTabelaInfo($tabela_nome=null){
        return DB::table('information_schema.columns')->where('table_schema', env('DB_DATABASE'))->where('table_name',$tabela_nome??self::getTableName());
    }

    private static function queryColunaInfo($tabela_nome=null, $coluna_nome=null){
        return self::queryTabelaInfo($tabela_nome)->where('column_name',$coluna_nome);
    }

}
