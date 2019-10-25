<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;

use App\Exceptions\AllException;

class CrudController extends Controller
{
    protected $Model;
    protected $ModelView;
    protected $view;

    public function __construct(){

    }

    public function index(...$para_view)
    {
        $retorno = self::retornoPadrao();
        $retorno = array_merge($retorno,array_shift($para_view));
        return view($this->view, $retorno);
    }

    public function store(Request $request)
    {
        $dados = $request->except(['__response']);
        return $this->storeDados($dados);
    }

    public function storeDados(...$dados){
        try {
            if( ! $this->ModelView){
                $this->ModelView = $this->Model;
            }

            if(sizeof($dados) < 2){
                $dados = $dados[0];
                $result = $this->Model::create($dados);
            }
            else {
                /** crie o metodo criar() na class Model */
                $result = call_user_func_array([$this->Model, 'criar'], $dados);
            }
            $retorno = self::criarArrayPadraoMensagens();
            $retorno['dados'] = $this->ModelView::where('id',$result->id)->first()->toArray();
        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
            $retorno['dados'] = $dados;
        }
        return response()->json(['__response'=>$retorno]);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->except(['__response']);
        return $this->updateDados($dados);
    }

    public function updateDados(...$dados){
        try {
            if( ! $this->ModelView){
                $this->ModelView = $this->Model;
            }

            if(sizeof($dados) < 2){
                $dados = $dados[0];
                $result = $this->Model::find($dados['id'])->fill($dados)->update();
            }
            else {
                /**
                 * crie o metodo atualizar() na class Model
                 */
                $result = call_user_func_array([$this->Model, 'atualizar'], $dados);
            }
            $dados_id = $dados['id']??$dados[0]['id'];
            $retorno = self::criarArrayPadraoMensagens();
            $retorno['dados'] = $this->ModelView::where('id',$dados_id)->first()->toArray();
        } catch (AllException $exc) {
            $retorno =self::getDefaultCatchReturn($exc);
            $retorno['dados'] = $dados;
        }
        return response()->json(['__response'=>$retorno]);
    }

    public function destroy($id)
    {
        $retorno = self::retornoPadrao();

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
