<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    protected $table = 'project_section';

    public function section(){
        return $this->belongsTo('App\Models\Section');
    }
}
