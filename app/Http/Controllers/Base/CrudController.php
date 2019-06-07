<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

class CrudController extends Controller
{
    protected $Model;
    protected $view;

    public function __construct(){

    }

    public function index(...$para_view)
    {
        $retorno = array_shift($para_view);
        return view($this->view, $retorno);
    }

    public function store(Request $request)
    {
        $retorno = self::$retorno_padrao;
        $dados = $request->except(['__response']);
        try {
            if(key_exists('ativo', $dados)){
                $dados['ativo'] = strval((int) $dados['ativo']);
            }
            $result = $this->Model::create($dados);
            $retorno = self::criarArrayPadraoMensagens();
            $retorno['dados'] = $this->Model::where('id',$result->id)->first()->toArray();
        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
            $retorno['dados'] = $dados;
        }

        return response()->json(['__response'=>$retorno]);

    }

    public function update(Request $request, $id)
    {
        $retorno = self::$retorno_padrao;
        $dados = $request->except(['__response']);

        try {
            if(key_exists('ativo', $dados)){
                $dados['ativo'] = strval((int) $dados['ativo']);
            }
            $result = $this->Model::find($dados['id'])->fill($dados)->update();
            $retorno = self::criarArrayPadraoMensagens();
            $retorno['dados'] = $this->Model::where('id',$dados['id'])->first();

        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
            $retorno['dados'] = $dados;
        }

        return response()->json(['__response'=>$retorno]);


    }

    public function destroy($id)
    {
        $retorno = self::$retorno_padrao;

        try {
            $this->Model::destroy($id);
            $retorno = self::criarArrayPadraoMensagens();
        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
        }

        $retorno['dados'] = ['id',$id];

        return response()->json(['__response'=>$retorno]);
    }


}
