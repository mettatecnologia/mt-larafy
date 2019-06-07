<?php

namespace App\Models\Tables;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use App\Models\AllModel;
use App\Models\Tables\Pessoa;

use App\Traits\TGeneric;

use App\Notifications\ResetarSenha;

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
        'ativo' => 'boolean'
    ];

    public function pessoa() { return $this->belongsTo(Pessoa::class); }

    public static function salvarPessoaComUsuario($data){
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

    public static function salvarUsuario($data){
        DB::beginTransaction();
        
        $User = Pessoa::find($data['pessoa_id'])->user()->first();
        
        if($User){
            if(key_exists('password', $data) && $data['password']){ $User->password = Hash::make($data['password']); }
            if(key_exists('papel', $data)){ $User->papel = $data['papel']; }
            if(key_exists('ativo', $data)){ $User->ativo = $data['ativo'] ? '1' : '0'; }
        }
        else {
            $User = new User;
            $User->pessoa_id = $data['pessoa_id'];
            $User->password = Hash::make($data['password']);
            $User->papel = $data['papel'] ?? 'USR';
            $User->ativo = $data['ativo'] ? '1' : '0';
        }
        
        $User->save();

        DB::commit();
        
        return $User;
    }

}
