<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = "exercise";
    protected $fillable = ['title', 'section_id', 'title', 'deskripsi', 'instruksi', 'min_nilai', 'contributor_id'];
    public function section(){
        return $this->belongsTo('App\Models\Section');
    }
}
