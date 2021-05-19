<?php

namespace App\Http\Controllers;

use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;
use App\Models\BootcampSubCategory;

class BootcampSubKategoriController extends Controller{
/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	public function index() {

		$bootcampsubkategori = BootcampSubCategory::with('category')-get();
		return view('admin.bootcampkategori.index', [
			'subkategori' => $bootcampsubkategori,
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		$bcid = DB::table('bootcamp_category')->get();
		return view('admin.bootcampkategori.tambahsub',[
            'bcid' => $bcid,
        ]);

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
			$bootcamp_id = Input::get('bcid');
			$nama_kat = Input::get('nama_kat');
			// $icon = Input::get('icon');
			$desc = Input::get('desc');
			$now = new DateTime();
        	$pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', Input::get('deskripsi'));
			
			$insert = DB::table('bootcamp_sub_category')->insert([
				'bootcamp_category_id' => $bootcamp_id,
				'title' => $nama_kat,
				// 'cover' => $icon,
				'deskripsi' => $desc,
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
				return redirect()->to('system/bootcampcat')->with('success-create', 'Sukses Tambah Sub Bootcamp Kategori');

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
		$sub = BootcampSubCategory::find($id);
		$bcid = DB::table('bootcamp_category')->get();
		return view('admin.bootcampkategori.editsub', [
			'bsc' => $sub,
			 'bcid' => $bcid,
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
            'title'         => 'required|unique:bootcamp_sub_category,title,'.$id,
            'deskripsi'   => 'required',
            'bcid' 	=> 'required',
            // 'cover'         => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $title=Input::get('title');
        $pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', Input::get('deskripsi'));
            // store
            $check= BootcampSubCategory::where('id',$id)->first();
            $store = BootcampSubCategory::find($id);
            // $store->enable      = Input::get('enable');
       		$store->bootcamp_category_id = Input::get('bcid');
            $store->title       = Input::get('title');
            // $store->cover       = Input::get('cover');
            $store->deskripsi = Input::get('deskripsi');
            //$store->meta_desc   = str_limit($pre, 150);
            $store->updated_at  = new DateTime();
			$store->save();
			// redirect
            return redirect('system/bootcampcat ')->with('success','Data successfully updated');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$del = BootcampSubCategory::find($id);
        $del->delete();
        return redirect('system/bootcampcat')->with('success','Data Has Been Deleted');
	}
}
