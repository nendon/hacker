<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Contributors extends Controller
{
    public function index()
    {
        return view ("contributors-home");
    }
}
