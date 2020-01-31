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

use App\Models\Page;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Page::all();
        return view('admin.pages.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
          'url'       => 'required|unique:pages',
          'meta_desc' => 'required',
          'title'     => 'required',
          'content'   => 'required',
          'tags'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $enab         = Input::get('enable');
            $url          = Input::get('url');
            $meta_desc    = Input::get('meta_desc');
            $title        = Input::get('title');
            $content      = Input::get('content');
            $tags         = Input::get('tags');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            $store = new Pages;
            $store->enable      = $enable;
            $store->url        = $url;
            $store->meta_desc  = $meta_desc;
            $store->title      = $title;
            $store->content    = $content;
            $store->tags       = $tags;
            $store->created_at  = $now;
            $store->updated_at  = $now;
            $store->save();

            return redirect('system/pages')->with('success','Successfully create data');

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
        $data    = Page::find($id);
        return view('admin.pages.edit',[
            'data'    => $data
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
            'url'       => 'required|unique:pages,url,'.$id,
            'meta_desc' => 'required',
            'title'     => 'required',
            'content'   => 'required',
            'tags'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $enab         = Input::get('enable');
            $url          = Input::get('url');
            $meta_desc    = Input::get('meta_desc');
            $title        = Input::get('title');
            $content      = Input::get('content');
            $tags         = Input::get('tags');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            // store
            $store = Page::find($id);
            $store->enable    = $enable;
            $store->url       = $url;
            $store->meta_desc = $meta_desc;
            $store->title     = $title;
            $store->content   = $content;
            $store->tags      = $tags;
            $store->updated_at= $now;
            $store->save();

            // redirect
            return redirect('system/pages')->with('success','Data successfully updated');
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
        $data = Page::find($id);
        $data->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }

}
