<?php

namespace App\Http\Middleware\Pessoa;

use Closure;
use App\Models\Tables\Pessoa;

class PapelAdmin
{
    use \App\Traits\TPessoa;

    public function handle($request, Closure $next)
    {
        $papel = self::pessoaPapel();

        if($papel==Pessoa::PAPEL_ADMINISTRADOR){
            return $next($request);
        }
    }
}
