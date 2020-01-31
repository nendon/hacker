<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notification\Notifiable;

class contributor extends User
{
    use Notifiable;
    /**
     * The atributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable =[
        'name', 'email','password','active','activation_token',
    ];

    /**
     * The atributes that should be hiddens for arrays.
     * 
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];
}

class contributor extends Contributor
{
    protected $table = "contributor";
}
