<?php
namespace App\Models\Tables;

use App\Models\AllModel;
use App\Models\Scopes\PessoaScope;
use App\Models\Tables\User;
use Illuminate\Support\Facades\DB;

class Pessoa extends AllModel
{

    const PAPEL_SISTEMA = 'SYS';
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

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PessoaScope);
    }

    public static function getSysApp(){
        return (array) DB::select('select * from pessoas a where UPPER(a.nome)="APP" and a.papel="SYS"')[0];
    }

    public static function getPessoa($id){
        return (array) DB::select("select * from pessoas a where id=$id")[0];
    }
}
