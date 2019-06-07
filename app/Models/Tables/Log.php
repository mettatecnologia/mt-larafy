<?php
namespace App\Models\Tables;

use Illuminate\Support\Facades\DB;

use App\Models\AllModel;

class Log extends AllModel
{
    public $timestamps = false;

    protected $fillable = [
        'id','user_id','datahora','nivel','mensagem','extra'
    ];
}
