<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Models\Tables\Pessoa;
use App\Models\Tables\User;
use App\Services\PessoaService;

class CrudPessoasController extends CrudController
{
    protected $Model = Pessoa::class;
    protected $view = 'pessoas';

    public function index(...$para_view)
    {
        $pessoas = PessoaService::buscarParaDatatableCrud();

        $retorno['pessoas'] = $pessoas;
        $retorno['papeis'] = self::pessoaPapeis();

        return parent::index($retorno);
    }

    public function store(Request $request)
    {
        $dados = $request->except(['__response']);
        $Result = $this->storeDados($dados);

        $dados = $Result->getData();
        $dados->__response->dados = PessoaService::buscarParaDatatableCrud($dados->__response->dados->id)[0];
        $Result->setData($dados);

        return $Result;
    }

    public function alterarAcesso(Request $request){
        $retorno = self::retornoPadrao();
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
