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
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesson = DB::table('lessons')->get();
        return view('admin.video.tambah',[
            'lesson' => $lesson,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = array(
        'lesson_id'   => 'required',
        'title'       => 'required',
        'description' => 'required',
        'image'       => 'required',
        'video'       => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $videos = new Video;
          $videos->lessons_id = Input::get('lesson_id');
          $videos->title      = Input::get('title');
          $videos->durasi      = Input::get('durasi');
          $videos->type_video      = Input::get('type');
          $videos->enable 	  = 1;
          $videos->image      = Input::get('image');
          $videos->video      = Input::get('video');
          $videos->description= Input::get('description');
          $videos->created_at = new DateTime();
          $videos->updated_at = new DateTime();
          $videos->save();

          return Redirect('system/video')->with('success','Successfully Created new Data');
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
