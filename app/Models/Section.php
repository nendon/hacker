<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';

    public function video_section()
    {
        return $this->hasMany('App\Models\VideoSection')->where('title', '!=', 'draft');
    }

    public function project_section()
    {
        return $this->hasMany('App\Models\ProjectSection');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
