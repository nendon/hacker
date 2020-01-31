<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller {
	public function home() {
			return view('contrib.home.home');
		

	}
	public function index() {
		if (empty(Auth::guard("contributors")->user())) {
		  return redirect('contributor/login')->with('error','Kamu Harus Login terlebih dahulu');
		}else{
			return view('contrib.dashboard');
		}
	}

	public function getSchema(){
		$file= public_path(). "/panduan/skema_kerjasama.pdf";
		return response()->file($file);
	}

}