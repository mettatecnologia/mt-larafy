<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Traits\TArray;
use App\Traits\TConfig;
use App\Traits\TException;
use App\Traits\TGeneric;
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

    use TArray, TConfig, TException, TGeneric, TLog;

    const CREATED_AT = 'dtainclusao';
    const UPDATED_AT = 'dtaalteracao';

    public $timestamps = false;

    protected $hidden = ['pivot'];

    protected $casts = [
        'id' => 'integer',
        'ativo' => 'integer',
    ];

    public static function scopeAtivos($query,$coluna_nome='ativo'){ return $query->where($coluna_nome, 1); }

    /**
     * OS METODOS SEGUINTES PRECISAM SER SOBRESCRITOS NO RESPECTIVO MODEL EM QUE SERAO NECESSARIOS
     */

    public static function extrairValoresEnum($coluna_nome){
        $tipo = self::getColunaTipo($coluna_nome);

        if($tipo != 'enum'){
            self::lancarException("A coluna '$coluna_nome' não e do tipo ENUM");
        }

        $enum_valores = self::getColunaInfo($coluna_nome)['COLUMN_TYPE'];

        preg_match_all('/\'([^"]+)\'/', $enum_valores, $matches);
        return explode(',',str_replace('\'','',$matches[0][0]));

    }

    public static function getColunaTipo($coluna_nome=null, $tabela_nome=null){
        return self::getColunaInfo($coluna_nome, $tabela_nome)['DATA_TYPE'];
    }

    public static function getColunaInfo($coluna_nome=null, $tabela_nome=null){
        return (array) self::queryColunaInfo($coluna_nome, $tabela_nome)->first();
    }

    public static function queryColunaInfo($coluna_nome=null, $tabela_nome=null){
        return self::queryTabelaInfo($tabela_nome)->where('column_name',$coluna_nome);
    }

    public static function getTabelaInfo($tabela_nome=null){
        return (array) self::queryTabelaInfo($tabela_nome)->first();
    }

    public static function queryTabelaInfo($tabela_nome=null){
        $tabela_nome = $tabela_nome ?? $tabela_nome??self::getTableName();
        return DB::table('information_schema.columns')->where('table_schema', env('DB_DATABASE'))->where('table_name',$tabela_nome);
    }

    public static function getTableName(){return (new self())->getTable(); }

}
