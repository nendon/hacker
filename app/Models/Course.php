<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    protected $fillable = ['bootcamp_id', 'title', 'cover_course', 'deskripsi', 'estimasi'];


    public function bootcamp(){
        return $this->belongsTo('App\Models\Bootcamp');
    }

    public function section(){
        return $this->hasMany('App\Models\Section');
    }
}
