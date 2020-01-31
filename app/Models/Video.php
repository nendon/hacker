<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos";

    public function views()
    {
        return $this->hasMany('\App\Models\Viewer');
    }
}
