<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usertry extends Model
{
    protected $table = "usertry";
    protected $fillable = ['bootcamp_id', 'member_id', 'lesson_id', 'status'];

}
