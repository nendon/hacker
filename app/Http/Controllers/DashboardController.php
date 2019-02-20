<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class DashboardController extends Controller
{
    public function __construct()
   {
       $this->middleware('auth');
   }

   public function index() {
    return view('admin.home');

}
}
