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


}
