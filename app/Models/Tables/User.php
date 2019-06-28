<?php

namespace App\Models\Tables;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use App\Models\Tables\Pessoa;

use App\Traits\TGeneric;

class User extends Authenticatable
{
    use Notifiable, TGeneric;

    public $timestamps = false;

    protected $fillable = [
        'pessoa_id','password','ativo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'pessoa_id' => 'integer',
        'ativo' => 'boolean'
    ];

    public function pessoa() { return $this->belongsTo(Pessoa::class); }

    public static function registrarPessoaComUsuario($data){
        DB::beginTransaction();

        $data['ativo'] = '1';

        if( ! key_exists('pessoa_id',$data)){
            $Pessoa = Pessoa::create($data);
            $data['pessoa_id'] = $Pessoa->id;
        }

        $User = self::salvarUsuario($data);

        DB::commit();

        return $User;
    }

    public static function salvarPessoaComUsuario($pessoa, $usuario){
        DB::beginTransaction();

        if(key_exists('id',$pessoa) && $pessoa['id']){
            Pessoa::find($pessoa['id'])->fill($pessoa)->update();
            $usuario['pessoa_id'] = $pessoa['id'];
        }
        else {
            $Pessoa = Pessoa::create($pessoa);
            $usuario['pessoa_id'] = $Pessoa->id;
        }

        $User = self::salvarUsuario($usuario);

        DB::commit();

        return $User;
    }

    public static function salvarUsuario($data){
        DB::beginTransaction();

        $User = Pessoa::find($data['pessoa_id'])->user()->first();


        if($User){
            if(key_exists('password', $data) && $data['password']){ $User->password = Hash::make($data['password']); }
            if(key_exists('ativo', $data)){ $User->ativo = $data['ativo'] ?? false; }
        }
        else {
            $User = new User;
            $User->pessoa_id = $data['pessoa_id'];
            $User->password = Hash::make($data['password']);
            $User->ativo = $data['ativo'] ?? false;
        }

        $User->save();

        DB::commit();

        return $User;
    }

}
