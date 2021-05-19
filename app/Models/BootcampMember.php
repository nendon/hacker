<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampMember extends Model
{
    protected $table = 'bootcamp_member';

    public function member(){
        return $this->hasMany('App\Models\Member');
    }

    public function bootcamp(){
        return $this->hasMany('App\Models\Bootcamp');
    }
}
