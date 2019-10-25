<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Base\CrudController;

use App\Models\Tables\Config;
use App\Services\ConfigService;

class CrudConfiguracoesController extends CrudController
{

    protected $Model = Config::class;
    protected $view = 'configuracoes';

    public function index(...$para_view)
    {
        $Configs = Config::get();
        $configs = ConfigService::buscarParaDatatableCrud();
        $retorno['configs'] = $configs;
        return parent::index($retorno);
    }

    public function store(Request $request)
    {
        $retorno = self::retornoPadrao();
        $config = $request->except(['__response']);
        $valores = $config['valores'];
        unset($config['valores']);
        $result = $this->storeDados($config, $valores);

        $dados = $result->getData();
        $dados->__response->dados = ConfigService::buscarParaDatatableCrud($dados->__response->dados->id)[0];
        $result->setData($dados);

        return $result;
    }

    public function update(Request $request, $id)
    {
        $retorno = self::retornoPadrao();
        $config = $request->except(['__response']);
        $valores = $config['valores'];
        unset($config['valores']);
        $result = $this->updateDados($config, $valores);

        $dados = $result->getData();
        $dados->__response->dados = ConfigService::buscarParaDatatableCrud($dados->__response->dados->id)[0];
        $result->setData($dados);

        return $result;


    }


}
