<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ContributorResetPassword;
use Auth;
class Contributor extends User
{
    //tablename
    protected $table = "contributors";

    protected $fillable = [
        'username', 'email', 'password', 'active', 'activation_token'
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new ContributorResetPassword($token));
    }

    public function notifications()
    {
        return Auth::guard('contributors')->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function bootcamp(){
        return $this->hasmany('App\Models\Bootcamp');
    }
   
    public function lessons(){
        return $this->hasmany('App\Models\Lesson');
    }
}
