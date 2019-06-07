<?php
namespace App\Models\Tables;

use App\Models\AllModel;

class PasswordReset extends AllModel
{
    
    protected $fillable = [
        'id','email','created_at'
    ];

}
