<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['member_id', 'contributor_id', 'lesson_id', 'bootcamp_id'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function contributor()
    {
        return $this->belongsTo('App\Models\Contributor');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

    public function bootcamp()
    {
        return $this->belongsTo('App\Models\Bootcamp');
    }
}
