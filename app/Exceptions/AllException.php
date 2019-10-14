<?php

namespace App\Exceptions;

use Exception;

use App\Traits\TException;
use App\Traits\TLog;

class AllException extends Exception
{

    use TException,TLog;

    function __construct(string $message=null, int $code=null, Throwable $previous = null ){
        parent::__construct($message, $code, $previous);

        if(env('LOG_GRAVAR_EXCECAO_DATABASE',true)){
            $exception_message = self::criarExceptionMessageCompleta($this) ;
            self::alertLog($exception_message,['exception']);
        }
    }

}
