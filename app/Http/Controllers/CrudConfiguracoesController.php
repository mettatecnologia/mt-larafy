<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\CrudController;

use App\Models\Tables\Config;

class CrudConfiguracoesController extends CrudController
{

    protected $Model = Config::class;
    protected $view = 'configuracoes';

    public function index(...$para_view)
    {
        $retorno['configs'] = Config::get()->toArray();
        return parent::index($retorno);
    }



}
