<?php
namespace App\Models\Tables;

use Illuminate\Support\Facades\DB;

use App\Models\AllModel;

use App\Models\Tables\Config;

class ConfigValor extends AllModel
{
    public $table = 'config_valores';
    public $timestamps = false;

    protected $fillable = [
        'id','config_id','valor'
    ];

    public function config_() { return $this->belongsTo(Config::class); }

}
