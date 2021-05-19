<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LampiranBootcamp extends Model
{
    protected $table = 'lampiran_bootcamp';

    protected $fillable = ['bootcamp_id', 'nama', 'file', 'deskripsi'];


    public function bootcamp(){
        return $this->belongsTo('App\Models\Bootcamp');
    }
}
