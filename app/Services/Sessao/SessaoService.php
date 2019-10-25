<?php

namespace App\Services\Sessao;

use App\Services\AllService;

use App\Models\Tables\Pessoa;
use App\Models\Tables\User;

class SessaoService extends AllService  {

    public static function iniciarSessaoAposAutenticacao(User $User){
        $Pessoa = Pessoa::find($User->pessoa_id);

        $sessao_global = [];
        $sessao_atual = [];

        switch ($Pessoa->papel) {

            case 'ADM':

                break;

            default:
                # code...
                break;
        }



        $todas = [
            'pessoa' => $Pessoa->toArray(),
            'user' => $User->toArray(),
            'global' => $sessao_global,
            'atual' => $sessao_atual,
        ];

        //iniciar sessão
        session($todas);

        return $todas;
    }








}
