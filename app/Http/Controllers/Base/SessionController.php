<?php

namespace App\Http\Controllers\Base;

class SessionController extends Controller
{

    public static function getSession(){
        $keys = request('key');
        $default = request('default');

        $result = session()->get($keys, $default);

        return response()->json(['__response'=>$result]);
    }


}
