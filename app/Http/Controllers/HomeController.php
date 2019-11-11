<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Base\Controller;

use App\Models\Tables\Pessoa;
use App\Exceptions\AllException;

class HomeController extends Controller
{

    public function index()
    {
        try {
            $retorno = self::retornoPadrao();
            $retorno['blocos_menu'] = $this->blocosMenu();
            return view('home', $retorno);
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
        }
    }

    public function blocosMenu(){
        $pessoas_qtd = Pessoa::where('id','<>',self::pessoaId())->count();

        $blocos_config = [
            ['action'=>'pessoas','icone'=>'fas fa-users','qtd'=>$pessoas_qtd,'titulo'=>'Pessoas'],
        ];

        $blocos_operacoes = [

        ];

        return [
            'Sistema'=>$blocos_config,
        ];

    }
}
