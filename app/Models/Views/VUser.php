<?php
namespace App\Models\Views;

// use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;

// use App\Traits\TGeneric;

use App\Models\Tables\User;

class VUser extends User
{
    // use Notifiable, TGeneric;
    
    // public $timestamps = false;

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'ativo' => 'boolean'
    // ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetarSenha($token));
    }

}
