<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Base\CrudController;

use App\Models\Tables\Config;

class CrudConfiguracoesController extends CrudController
{

    protected $Model = Config::class;
    protected $view = 'configuracoes';

    public function index(...$para_view)
    {
        $Configs = Config::get();
        $configs = [];
        foreach ($Configs as $key => $Config) {
            $Valores = $Config->valores()->get();

            $config = $Config->toArray();
            if($Valores->count()){
                foreach ($Valores as $key => $Valor) {
                    $config['valores'][] = $Valor->valor;
                }
            }
            else {
                $config['valores'][] = null;
            }
            $configs[] = $config;
        }

        $retorno['configs'] = $configs;
        return parent::index($retorno);
    }

    public function store(Request $request)
    {
        $retorno = self::$retorno_padrao;
        $config = $request->except(['__response']);
        $valores = $config['valores'];
        unset($config['valores']);
        $result = $this->storeDados($config, $valores);
        return $result;
    }

    public function update(Request $request, $id)
    {
        $retorno = self::$retorno_padrao;
        $config = $request->except(['__response']);
        $valores = $config['valores'];
        unset($config['valores']);
        $result = $this->updateDados($config, $valores);
        return $result;


    }


}
