<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    
    protected $fillable = ['lesson_id', 'member_id', 'contributor_id', 'body', 'parent_id', 'status', 'images'];
}
