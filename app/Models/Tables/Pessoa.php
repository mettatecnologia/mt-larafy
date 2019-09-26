<?php
namespace App\Models\Tables;

use App\Models\AllModel;

use App\Models\Tables\User;

class Pessoa extends AllModel
{

    const PAPEL_SUPER = 'SUP';
    const PAPEL_ADMIN = 'ADM';
    const PAPEL_USUARIO = 'USR';

    protected $fillable = [
        'id','nome','email','ativo','dtanascimento','logradouro_tipo','logradouro','logradouro_numero','bairro','telefone','papel'
    ];

    protected $casts = [
        'ativo' => 'integer',
    ];

    public function user(){ return $this->hasMany(User::class); }
}
