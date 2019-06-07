<?php
namespace App\Models\Tables;

use Illuminate\Support\Facades\DB;

use App\Models\AllModel;

class Config extends AllModel
{
    public $timestamps = false;

    protected $fillable = [
        'id','nome','nome_interno','descricao','valor','ativo'
    ];
}
