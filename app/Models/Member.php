<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MemberResetPasswordNotification;

class Member extends User {
    protected $table = "members";
    protected $dates = ['tanggal_lahir'];
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPasswordNotification($token));
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }

    public function bootcamp(){
        return $this->hasMany('App\Models\Bootcamp');
    }
}
