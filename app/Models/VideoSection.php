<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoSection extends Model
{
    
    protected $table = 'video_section';

    public function section(){
        return $this->hasMany('App\Models\Section');
    }
}
