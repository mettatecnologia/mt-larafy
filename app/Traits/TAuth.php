<?php

namespace App\Traits;

use Auth;

trait TAuth {

    protected static function user(){
        return Auth::user();
    }

    protected static function userId(){
        return self::user()->id;
    }

}
