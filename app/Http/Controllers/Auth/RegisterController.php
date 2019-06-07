<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Services\UserService;
use App\Models\Tables\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function showRegistrationForm()
    {
        $retorno = self::$retorno_padrao;
        $retorno['senha_min'] = UserService::SENHA_MIN;
        return view('auth.register', $retorno);
    }

    public function register(Request $request)
    {
        $retorno = self::$retorno_padrao;
        $dados = $request->all();

        try {
            $Erros =  UserService::validator($dados)->errors();
            if($Erros->count()){
                $erros = $Erros->toArray();
                self::lancarException(array_shift($erros)[0]);
            }

            event(new Registered($user = $this->create($request->all())));
            $this->guard()->login($user);

            $retorno = self::criarArrayPadraoMensagens('Tudo certo, vamos entrar!');
            $retorno['dados'] = [
                'user'=>$user,
                'redirecionar_url'=> $this->redirectPath()
            ];
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
            $retorno['dados'] = ['nome'=>$dados['nome'],'email'=>$dados['email']];
        }

        return response()->json(['__response'=>$retorno]);

    }

    protected function validator(array $data)
    {
        return UserService::validator($data);
    }

    protected function create(array $data)
    {
        return User::salvarPessoaComUsuario($data);
    }

}
