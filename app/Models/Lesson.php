<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    
    public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function videos()
	{
		return $this->hasMany('\App\Models\Video', 'lessons_id');
	}

	public function category(){
		return $this->belongTo('App\Models\Category');
	}

	public function contributor(){
        return $this->belongsTo('App\Models\Contributor');
    }
}


