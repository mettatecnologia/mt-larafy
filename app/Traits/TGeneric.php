<?php

namespace App\Traits;

trait TGeneric {

    protected static $retorno_padrao = ['erro'=>false,'mensagens'=>[], 'mensagens_tipo'=>'info', 'exception'=>[], 'dados'=>[]];

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
