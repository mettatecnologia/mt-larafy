<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Models\Tables\Pessoa;
use App\Models\Tables\User;

class CrudPessoasController extends CrudController
{
    protected $Model = Pessoa::class;
    protected $view = 'pessoas';

    public function index(...$para_view)
    {
        $Pessoas = Pessoa::where('id','<>',self::pessoaId())->get();
        $pessoas = [];
        foreach ($Pessoas as $key => $Pessoa) {
            $pessoas[$key] = $Pessoa->toArray();
            $pessoas[$key]['usuario'] = $Pessoa->user()->first();
            $pessoas[$key]['tem_usuario'] = $Pessoa->user()->count() > 0;

        }
        $retorno['pessoas'] = $pessoas;
        $retorno['papeis'] = self::pessoaPapeis();

        return parent::index($retorno);
    }

    public function alterarAcesso(Request $request){
        $retorno = self::$retorno_padrao;
        $dados = $request->except(['__response']);
        try {
            $User = User::salvarUsuario($dados);
            $retorno = self::criarArrayPadraoMensagens();
            $retorno['dados'] = User::where('id',$User->id)->first()->toArray();
        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
            $retorno['dados'] = $dados;
        }

        return response()->json(['__response'=>$retorno]);
    }

}
