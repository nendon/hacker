<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizDetail extends Model
{
    protected $table = "quiz_detail";
    protected $fillable = ['quizuser_id', 'tanya_id', 'jawaban_id'];
}
