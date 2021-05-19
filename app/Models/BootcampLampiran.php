<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampLampiran extends Model
{
    protected $table = 'lampiran_bootcamp';

    public function bootcamp(){
        return $this->belongsTo('App\Models\Bootcamp');
    }
}
