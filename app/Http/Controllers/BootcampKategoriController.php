<?php

namespace App\Http\Controllers;

use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;
use App\Models\BootcampCategory;
use App\Models\BootcampSubCategory;

class BootcampKategoriController extends Controller{
/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	public function index() {
		$bootcampkategori = BootcampCategory::with('bootcamp')->get();
		$sub = BootcampSubCategory::with('bootcamp_category')->get();
		// dd($sub);
		return view('admin.bootcampkategori.index', [
			'bootcampkategori' => $bootcampkategori,
			'sub' => $sub,
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.bootcampkategori.tambah');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		# code...
		// validate the info, create rules for the inputs
		$rules = array(
			// 'image'        => 'required',
			// 'status'     => 'required',
		);
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {

			$nama_kat = Input::get('nama_kat');
			$icon = Input::get('icon');
			$meta_desc = Input::get('meta_desc');
			$now = new DateTime();
        ////$pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', Input::get('description'));
			
			$insert = DB::table('bootcamp_category')->insert([
				'title' => $nama_kat,
				'cover' => $icon,
				'slug'  => str_slug($nama_kat),
				'enable' => 1,
				'meta_desc' => $meta_desc,
				'created_at' => $now,

			]);
			if ($insert) {

//                //fungsi untuk sytem log
				//                $logcontent ="Add new bank  $name - $holder - $number for bank management";
				//                $logtype ="Bank";
				//                $loguser =Auth::user()->id;
				//                $logdateTime=new DateTime();
				//                $log=  Helper::userlog($logtype,$logcontent,$loguser,$logdateTime);
				//                //end userlog
				return redirect()->to('system/bootcampcat')->with('success-create', 'Sukses Tambah Bootcamp Kategori');

			} else {
				return Redirect()->back()->with('error', 'Sorry something is error !');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$bootcampkategori = BootcampCategory::find($id);
		return view('admin.bootcampkategori.edit', [
			'bootcampkategori' => $bootcampkategori,
		]);}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$rules = array(
            'title'         => 'required|unique:bootcamp_category,title,'.$id,
            'meta_desc'   => 'required',
            'cover'         => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $title=Input::get('title');
        	$pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', Input::get('meta_desc'));
            // store
            $check= BootcampCategory::where('id',$id)->first();
            $store = BootcampCategory::find($id);
            $store->enable      = Input::get('enable');
            $store->title       = Input::get('title');
            $store->cover       = Input::get('cover');
            $store->meta_desc = Input::get('meta_desc');
            // $store->meta_desc   = str_limit($pre, 150);
            $store->updated_at  = new DateTime();
			$store->save();
			// redirect
            return redirect('system/bootcampcat')->with('success','Data successfully updated');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$del = BootcampCategory::find($id);
        $del->delete();
        return redirect('system/bootcampcat')->with('success','Data Has Been Deleted');
	}
}
