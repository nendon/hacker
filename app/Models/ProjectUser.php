<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = 'project_user';
    
    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }
    
}
