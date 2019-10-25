<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Exceptions\AllException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $retorno = self::retornoPadrao();

        try {
            $this->validateEmail($request);
            $response = $this->broker()->sendResetLink( $this->credentials($request) );

            if($response == Password::RESET_LINK_SENT){
                $retorno = self::criarArrayPadraoMensagens('Email enviado com sucesso.');
            }
            else {
                self::lancarException('Credenciais inválidas', 401);
            }
        } catch (AllException $exc) {
            $retorno = self::getDefaultCatchReturn($exc);
        }

        return response()->json(['__response'=>$retorno]);

    }
}
