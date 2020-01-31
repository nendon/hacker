<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampCategory extends Model
{
    protected $table = 'bootcamp_category';

    public function bootcamp_sub_category(){
        return $this->hasMany('App\Models\BootcampSubCategory');
    }

    public function bootcamp(){
        return $this->hasMany('App\Models\Bootcamp');
    }

}
