<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Exceptions\AllException;

use App\Models\Views\VUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function login(Request $request)
    {
        $retorno = self::$retorno_padrao;
        $credentials = request(['email', 'password']);

        try {
            $User = VUser::where('email',request('email'))->first();

            if( $User && ! $User->ativo){
                self::lancarException('Este usuário não está ativo');
            }

            if (!$token = auth()->attempt($credentials)) {
                self::lancarException('Credenciais inválidas', 401);
            }

            $User = $request->user();
            $retorno = self::criarArrayPadraoMensagens('Tudo certo');
            $retorno['dados'] = [
                'token'=>$token,
                'user'=>$User,
                'redirecionar_url'=> route('home')
            ];
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
            $retorno['dados'] = ['email'=>$credentials['email']];
        }

        return response()->json(['__response'=>$retorno]);

    }

}
