<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    protected $table = "bootcamp";
    
    public function course(){
       return $this->hasMany('App\Models\Course');
    }

    public function lampiran(){
        return $this->hasMany('App\Models\BootcampLampiran');
    }

    public function bootcamp_member(){
        return $this->hasMany('App\Models\BootcampMember');
    }

    public function contributor(){
        return $this->belongsTo('App\Models\Contributor');
    }

    public function bootcamp_category(){
        return $this->belongsTo('App\Models\BootcampCategory');
    }

    public function bootcamp_sub_category(){
        return $this->belongsTo('App\Models\BootcampSubCategory');
    }
}
