<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Traits\TGeneric;
use App\Traits\TAuth;
use App\Traits\TConfig;
use App\Traits\TLog;
use App\Traits\TException;

use App\Models\Views\VUfCidade;
use App\Models\Views\VUser;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, TGeneric, TAuth, TConfig, TLog, TException;

    public function buscarCidadesPorEstado($uf)
    {
        $retorno = self::$retorno_padrao;

        try {
            $retorno['dados'] = VUfCidade::where('uf',$uf)->get();
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
            $retorno['dados'] = [];
        }

        return response()->json(['__response'=>$retorno]);
    }

    public function verificarEmail($email)
    {
        $retorno = self::$retorno_padrao;

        try {
            $busca = VUser::where('email',$email)->first();
            $dados = [
                'existe' => $busca !== null
            ];
            $retorno['dados'] = $dados;
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
            $retorno['dados'] = [];
        }

        return response()->json(['__response'=>$retorno]);
    }



}
