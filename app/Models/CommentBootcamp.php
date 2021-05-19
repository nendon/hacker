<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentBootcamp extends Model
{
    protected $table = "comments_bootcamp";
    
    protected $fillable = ['bootcamp_id', 'member_id', 'contributor_id', 'body', 'parent_id', 'status', 'images'];
}
