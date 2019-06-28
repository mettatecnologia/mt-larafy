<?php

namespace App\Services;

use App\Services\AllService;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserService extends AllService  {

    public function __construct(){
        $this->setPapeis();
    }

    public static function validator(array $data, int $ignore_pessoa_id=null, bool $ignore_password=false)
    {
        $regras = [
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('pessoas')->ignore($ignore_pessoa_id)],
            'password' => $ignore_password ? [] : self::getRegrasSenhas()
        ];

        return Validator::make($data, $regras);
    }

    public static function getRegrasSenhas(){
        $senha_min = env('APP_PASSWORD_MIN',4);
        return ['required', 'string', "min:$senha_min", 'confirmed'];
    }

    public static function validaMudancaSenha(Request $request){
        if (!(\Illuminate\Support\Facades\Hash::check($request->get('senha_atual'), \Illuminate\Support\Facades\Auth::user()->password))) {
            // Verifica senha atual
            self::lancarException("A senha atual está incorreta");
        }
        if(strcmp($request->get('senha_atual'), $request->get('senha_nova')) == 0){
            //Senha atual e nova são iguais
            self::lancarException("Sua nova senha e sua sua senha atual são as mesmas, nada foi alterado.");
        }
        if(strcmp($request->get('senha_nova'), $request->get('senha_nova_confirmation')) != 0){
            //Senha atual e de confirmacao são diferentes
            self::lancarException("A nova senha e a nova senha de confirmação não são as mesmas.");
        }

        $validatedData = $request->validate([
            'senha_atual' => 'required',
            'senha_nova' => implode('|',self::getRegrasSenhas()),
        ]);

        return true;
    }

    public static function mudarSenha($nova_senha){
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->password = bcrypt($nova_senha);
        $user->save();
        return true;
    }


}
