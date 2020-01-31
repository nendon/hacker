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


class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DB::table('files')
        ->leftJoin('lessons', 'files.lesson_id', '=', 'lessons.id')
        ->select('files.*','lessons.title as lesson_title')
        ->get();
        return view('admin.files.index',[
            'files' => $files,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = DB::table('lessons')->get();
        return view('admin.files.create',[
            'lessons' => $lessons,
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
          'source'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $lesson_id    = Input::get('lesson_id');
            $title        = Input::get('title');
            $source       = Input::get('source');

            // if (!empty(Input::get('enable'))) {
            //   $enable = 1;
            // }else {
            //   $enable = 0;
            // }


            $store = DB::table('files')->insert([
              'enable'      => 1,
              'lesson_id'   => $lesson_id,
              'title'       => $title,
              'source'      => $source,
              'created_at'  => $now,
              'updated_at'  => $now
            ]);

            if($store){
                 return redirect('system/files')->with('success','New Data Succesfully created');

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
        $files      = DB::table('files')->where('id','=',$id)->first();
        $lessons    = DB::table('lessons')->get();
        return view('admin.files.edit',[
            'files'     => $files,
            'lessons'   => $lessons
        ]);
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
        $rules = array(
          'lesson_id'   => 'required',
          'title'       => 'required',
          'source'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $lesson_id    = Input::get('lesson_id');
            $title        = Input::get('title');
            $source       = Input::get('source');

            // if (!empty(Input::get('enable'))) {
            //   $enable = 1;
            // }else {
            //   $enable = 0;
            // }


            // store
            $store = DB::table('files')
            ->where('id','=',$id)
            ->update([
              'enable'      => 1,
              'lesson_id'   => $lesson_id,
              'title'       => $title,
              'source'      => $source,
              'updated_at'  => $now
            ]);
            if($store){
                  // redirect
                  return redirect('system/files')->with('success','Data successfully updated');

            }else{
                  return Redirect()->back()->with('error','Sorry something is error !');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('files')
        ->where('id','=',$id)
        ->delete();

        if($delete){
              // redirect
              return redirect()->back()->with('success','Data successfully deleted');

        }else{
              return Redirect()->back()->with('error','Sorry something is error !');
        }

    }

}
