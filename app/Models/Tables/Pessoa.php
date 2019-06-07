<?php
namespace App\Models\Tables;

use App\Models\AllModel;

use App\Models\Tables\User;

class Pessoa extends AllModel
{

    protected $fillable = [
        'id','nome','email','ativo','dtanascimento','logradouro_tipo','logradouro','logradouro_numero','logradouro_bairro','telefone'
    ];

    protected $casts = [
        'ativo' => 'integer',
    ];

    public function user(){ return $this->hasMany(User::class); }
}
