<?php

namespace App\Exceptions;

use Exception;

use App\Traits\TLog;
use App\Traits\TException;

class AllException extends Exception
{

    use TLog, TException;

    function __construct(string $message=null, int $code=null, Throwable $previous = null ){
        parent::__construct($message, $code, $previous);

        if(env('LOG_GRAVAR_EXCECAO_DATABASE',true)){
            $exception_message = self::criarExceptionMessageCompleta($this) ;
            self::alertLog($exception_message,['exception']);
        }
    }

}
