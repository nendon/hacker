<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = "pertanyaan";
    protected $fillable = ['exercise_id', 'tanya', 'jawaban'];
}
