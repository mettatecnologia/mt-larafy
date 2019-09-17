<?php

namespace App\Services;

use \App\Traits\TGeneric;
use \App\Traits\TFile;
use \App\Traits\TConfig;
use \App\Traits\TString;
use App\Traits\TLog;
use App\Traits\TAuth;
use App\Traits\TDatetime;
use App\Traits\TException;

class AllService {

    use TGeneric, TFile, TConfig, TString, TLog, TAuth, TDatetime, TException;

    public function __construct() {
        ;
    }

    public static function download_arquivo($arquivo){
        return response()->download($arquivo);
    }

}
