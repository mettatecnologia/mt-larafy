<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Exceptions\AllException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/home';

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:'.env('APP_PASSWORD_MIN',4),
        ];
    }

    public function reset(Request $request)
    {
        $retorno = self::retornoPadrao();

        try {
            $request->validate($this->rules(), $this->validationErrorMessages());
            $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            if($response == Password::PASSWORD_RESET){
                $retorno = self::criarArrayPadraoMensagens('Senha resetada com sucesso');
                $retorno['dados'] = [
                    'redirecionar_url'=> route('home')
                ];
            }
            else {
                self::lancarException('Erro ao resetar a senha.');
            }

        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
        }

        return response()->json(['__response'=>$retorno]);
    }

}
