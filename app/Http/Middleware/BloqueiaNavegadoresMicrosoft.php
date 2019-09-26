<?php

namespace App\Http\Middleware;

use Closure;

use Jenssegers\Agent\Agent;

class BloqueiaNavegadoresMicrosoft
{
    public function handle($request, Closure $next)
    {
        $agent = new Agent();
        $invalidos = preg_match('/IE|Edge/', $agent->browser());

        if($invalidos){
            return redirect('/navegador-invalido');
        }

        return $next($request);

    }
}
