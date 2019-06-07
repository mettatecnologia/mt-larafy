<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Models\Tables\Pessoa;

use App\Services\UserService;

class PerfilController extends CrudController
{
    protected $Model = Pessoa::class;
    protected $view = 'perfil';

    public function index(...$para_view)
    {
        $Pessoa = Pessoa::where('id',self::pessoaId())->first();
        $retorno['perfil'] = $Pessoa->toArray();
        return parent::index($retorno);
    }

    public function mudarSenha(Request $request){
        $retorno = self::$retorno_padrao;

        try {
            UserService::validaMudancaSenha($request);
            if( ! UserService::mudarSenha(request('senha_nova'))){
                self::lancarException("Ocorreu algum erro ao mudar a senha.");
            }
            $retorno = self::criarArrayPadraoMensagens('Senha alterada com sucesso');
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
        }

        return response()->json(['__response'=>$retorno]);
    }

    public function verificarEmailPerfil($email)
    {
        $retorno = self::$retorno_padrao;
        try {
            $busca = Pessoa::where('email',$email)->where('id','<>',self::userId())->first();
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
