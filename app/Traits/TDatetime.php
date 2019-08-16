<?php

namespace App\Traits;

use Carbon\Carbon;

trait TDatetime {

    protected static function datetime($datetime=null, $format=null){
        $Datetime = new Carbon($datetime);
        if($format){
            return $Datetime->format($format);
        }

        return $Datetime;
    }

    protected static function datetimeFromFormat($format, $datetime, $formato_saida=null){
        $Datetime = Carbon::createFromFormat($format, $datetime);
        if($Datetime && $formato_saida){
            return $Datetime->format($formato_saida);
        }

        return $Datetime;
    }

    protected static function datetimeNow($format=null){
        return self::datetime(null, $format);
    }




}
