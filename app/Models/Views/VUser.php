<?php
namespace App\Models\Views;

use App\Models\Tables\User;

class VUser extends User
{

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetarSenha($token));
    }

}
