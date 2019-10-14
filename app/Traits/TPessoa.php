<?php

namespace App\Traits;

use App\Services\PessoaService;
use App\Models\Tables\Pessoa;

trait TPessoa {

    protected static function pessoaId(){
        // return self::user()->pessoa_id;
        return session()->get('pessoa.id');
    }

    protected static function pessoaPapel(){
        // return Pessoa::find(self::pessoaId())->papel;
        return session()->get('pessoa.papel');
    }

    protected static function pessoaPapeis(){
        return (new PessoaService)->getPapeis();
    }

}
