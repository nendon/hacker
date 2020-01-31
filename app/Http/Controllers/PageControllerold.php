<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;

use Validator;
use Redirect;
use DateTime;
use Helper;
use Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=DB::table('pages')->get();
         return view('admin.pages.create',[
         'page'=>$page
      ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         # code...
      // validate the info, create rules for the inputs
      $rules = array(

      );
      // run the validation rules on the inputs from the form
      $validator = Validator::make(Input::all(), $rules);
      // if the validator fails, redirect back to the form
      if ($validator->fails()) {
        return redirect()->back()
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(); // send back the input (not the password) so that we can repopulate the form
      } else {

        $title         =Input::get('title');
        $url       =Input::get('slug');
        $content       =Input::get('content');
        // var_dump(Input::get('meta_tag'));
        // exit();
        $meta_tag     = Input::get('meta_tags');
        $meta_desc     =Input::get('meta_desc');

        $now          = new DateTime();
        if(!empty($request['status'])){
          $enable=1;
        }else{
          $enable=0;
        }
        $status = $enable;


        $insert = DB::table('pages')->insert([
          'title'=>$title,
          'url'=>$url,
          'content'=>$content,
          'tags'    => $meta_tag,
          'meta_desc'    => $meta_desc,
          'enable'      =>$status,
          'created_at'     => $now,
        ]);
        if($insert){
          return redirect()->to('system/page')->with('success-create','Thank you for page add!');

        }else{
          return Redirect()->back()->with('error','Sorry something is error !');
        }
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
