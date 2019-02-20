<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampSubCategory extends Model
{
	// public $incrementing=false;
    protected $table = 'bootcamp_sub_category';

    public function bootcamp_category(){
        return $this->belongsTo('App\Models\BootcampCategory');
    }
}
