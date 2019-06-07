<?php

namespace App\Traits;

use Auth;

use App\Services\UserService;

trait TAuth {

    protected static function user(){
        return Auth::user();
    }

    protected static function userPapel(){
        return self::user()->papel;
    }

    protected static function userPapeis(){
        return (new UserService)->getPapeis();
    }

    protected static function userId(){
        return self::user()->id;
    }

    protected static function pessoaId(){
        return self::user()->pessoa_id;
    }
}
