<?php

namespace App\Services;

use App\Traits\TArray;
use App\Traits\TAuth;
use App\Traits\TConfig;
use App\Traits\TDatetime;
use App\Traits\TException;
use App\Traits\TFile;
use App\Traits\TGeneric;
use App\Traits\TLog;
use App\Traits\TPessoa;
use App\Traits\TString;

class AllService {

    use TArray, TAuth, TConfig, TDatetime, TException, TFile, TGeneric, TLog, TPessoa, TString;

    public function __construct() {
        ;
    }

    public static function download_arquivo($arquivo){
        return response()->download($arquivo);
    }

}
