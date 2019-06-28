<?php

namespace App\Traits;

use Auth;

use App\Services\PessoaService;
use App\Models\Tables\Pessoa;

trait TAuth {

    protected static function user(){
        return Auth::user();
    }

    protected static function userId(){
        return self::user()->id;
    }

    protected static function pessoaId(){
        return self::user()->pessoa_id;
    }

    protected static function pessoaPapel(){
        return Pessoa::find(self::pessoaId())->papel;
    }

    protected static function pessoaPapeis(){
        return (new PessoaService)->getPapeis();
    }
}
