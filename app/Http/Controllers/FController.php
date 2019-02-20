<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;
class FController extends Controller
{
    //index
    public function index(){
        $categories = Category::all();
        return view('web.app', [
          'categories' => $categories
        ]);
    }
}
