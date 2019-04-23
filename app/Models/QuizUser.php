<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    protected $table = "quiz_user";
    protected $fillable = ['exercise_id', 'member_id', 'status', 'nilai'];
}
