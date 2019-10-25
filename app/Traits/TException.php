<?php

namespace App\Traits;

use App\Exceptions\AllException;

use App\Traits\TArray;

trait TException {

    use TArray;

    protected static function lancarException($mensagem, $codigo=500) {
        throw new AllException($mensagem, $codigo);
    }

    protected static function getDefaultCatchReturn(\Exception $exc, $mensagens=null) {
        $exception_message = self::criarExceptionMessageCompleta($exc);
        $msg = $mensagens ? $mensagens : $exc->getMessage();
        $retorno = self::criarArrayPadraoMensagens($msg, 'error', true);
        $retorno['exception'] = $exception_message;
        return $retorno;
    }

    public static function criarExceptionMessageCompleta(\Exception $exc){
        return "{$exc->getMessage()} | Cod: {$exc->getCode()} | File: {$exc->getFile()} | Line: {$exc->getLine()}" ;
    }


}
