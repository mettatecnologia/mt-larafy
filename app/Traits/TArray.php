<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait TArray {

    private static $retorno_padrao = ['erro'=>false,'mensagens'=>[], 'mensagens_tipo'=>'info', 'exception'=>[],'request'=>['parameters'=>[]], 'route'=>['parameters'=>[]], 'sessao'=>[], 'dados'=>[]];

    protected static function retornoPadrao(Request $Request=null){

        $retorno_padrao = self::$retorno_padrao;
        $retorno_padrao['sessao']['pessoa_papel'] = session()->get('pessoa.papel');

        if($Request){
            $Route = $Request->route();
            $retorno_padrao['request']['parameters'] = $Request->parameters;
            $retorno_padrao['route']['parameters'] = $Route->parameters;
        }

        return $retorno_padrao;
    }

    protected static function criarArrayPadraoMensagens($mensagens='Operação realizada com sucesso.', $mensagens_tipo='success', $tem_erro=false){
        $retorno = self::$retorno_padrao;

        $retorno['mensagens']= (array) $mensagens;
        $retorno['mensagens_tipo']=$mensagens_tipo;
        $retorno['erro']=$tem_erro;

        return $retorno;
    }

    protected static function ordenaArrayPelaColuna(array $array, $coluna='id', $ordem = SORT_ASC){
        if($ordem == SORT_ASC){
            uasort($array, function ($item1, $item2) use ($coluna, $ordem) { return $item1[$coluna] <=> $item2[$coluna];});
        }
        else {
            uasort($array, function ($item1, $item2) use ($coluna, $ordem) { return $item2[$coluna] <=> $item1[$coluna];});
        }

        return $array;
    }

}
