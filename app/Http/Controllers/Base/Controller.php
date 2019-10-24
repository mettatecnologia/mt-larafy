<?php

namespace App\Http\Controllers\Base;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Traits\TArray;
use App\Traits\TAuth;
use App\Traits\TConfig;
use App\Traits\TDatetime;
use App\Traits\TException;
use App\Traits\TFile;
use App\Traits\TGeneric;
use App\Traits\TLog;
use App\Traits\TPessoa;
use App\Traits\TSessao;

use App\Models\Tables\User;
use App\Models\Tables\Pessoa;
use App\Models\Views\VUfCidade;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,
        TArray, TAuth, TConfig, TDatetime, TException, TFile, TGeneric, TLog, TPessoa, TSessao;

    public function buscarCidadesPorEstado($uf)
    {
        $retorno = self::retornoPadrao();

        try {
            $retorno['dados'] = VUfCidade::where('uf',$uf)->get();
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
            $retorno['dados'] = [];
        }

        return response()->json(['__response'=>$retorno]);
    }

    public function verificarEmail($email, $ignore_pessoa_id=0)
    {
        $retorno = self::retornoPadrao();
        try {
            $busca = Pessoa::where('email',$email)->where('id','<>',$ignore_pessoa_id)->first();
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

    public function validarSenha(Request $request)
    {
        $retorno = self::retornoPadrao();
        $dados = $request->except(['__response']);
        $pessoa_id = $dados['pessoa_id'] ?? self::pessoaId();
        $senha = $dados['senha'];
        try {
            $User = User::where('pessoa_id',$pessoa_id)->first();
            if( ! $User){
                self::lancarException("Usuário não foi encontrado.", 1);
            }

            $senha_certa = (\Illuminate\Support\Facades\Hash::check($senha, $User->password));
            $retorno['dados']['senha_certa'] = $senha_certa;

        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
        }

        return response()->json(['__response'=>$retorno]);
    }

    public static function getSession()
    {
        $keys = request('key');
        $default = request('default');

        $result = session()->get($keys, $default);

        return response()->json(['__response'=>$result]);
    }





}
