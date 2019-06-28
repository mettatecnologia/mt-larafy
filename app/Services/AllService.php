<?php

namespace App\Services;

use \App\Traits\TGeneric;
use \App\Traits\TFile;
use \App\Traits\TConfig;
use \App\Traits\TAuth;
use \App\Traits\TException;

class AllService {

    use TGeneric, TFile, TConfig, TAuth, TException;

    public function __construct() {
        ;
    }

}
