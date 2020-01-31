<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use Validator;
use DB;
class RateController extends Controller
{
    public function store(Request $request)
    {	
    	 $rules = array(
          'services_status'   => 'required',
          'services_packages' => 'required'
        );
    $validator = Validator::make(Input::all(), $rules);

    	$rating = input::get('inputrate');
    	$komen	= input::get('comment');
    	$now    = new DateTime();
    	$insert = DB::table('rate')->insert([
              'id_member'   => Auth::guard("members")->user()->id,
              'rating'	 	=> $rating,
              'comment'     => $komen,    
              'status'   	=> 'BERHASIL',
              'created_at'  => $now,
              'updated_at'  => $now
        ]);
        
    }
 
}