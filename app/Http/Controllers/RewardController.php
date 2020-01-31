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
use App\Models\RewardCategory;
use App\Models\Reward;

class rewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $now = new DateTime;
        $date = date_format($now,'Y-m-d');
        $data = Reward::all();
        return view('admin.reward.index',[
            'data' => $data,
            'date'  =>$date,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = RewardCategory::where('enable',1)->get();
        return view('admin.reward.create',[
          'cat'=>$cat,
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
          'code'      => 'required|unique:reward',
          'name'      => 'required',
          'value'     => 'required',
          'poin'      => 'required',
          'start'     => 'required',
          'end'       => 'required',
          'limit'     => 'required',
          'cat'       =>'required',
          'type'      =>'required',
          'image'  => 'required',
          'desc'   =>'required',
          'url'     =>'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now        = new DateTime();
            $enab       = Input::get('enable');
            $code       = Input::get('code');
            $name       = Input::get('name');
            $value      = Input::get('value');
            $poin       = Input::get('poin');
            $start      = Input::get('start');
            $end        = Input::get('end');
            $limit      = Input::get('limit');
            $cat        = Input::get('cat');
            $desc       = Input::get('desc');
            $type       = Input::get('type');
            $image       = Input::get('image');
            $url        = Input::get('url');
            $content       = Input::get('content');
            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            $store = new Reward;
            $store->enable      = $enable;
            $store->code        = $code;
            $store->name        = $name;
            $store->value       = $value;
            $store->poin        = $poin;
            $store->start       = $start;
            $store->end         = $end;
            $store->limit       = $limit;
            $store->category_id = $cat;
            $store->description  = $desc;
            $store->created_at  = $now;
            $store->type        = $type;
            $store->image       = $image;
            $store->content      = $content;
            $store->url         =$url;
            $store->save();

            return redirect('system/reward')->with('success','Successfully create data');

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
        $cat = RewardCategory::where('enable',1)->get();
        $data    = Reward::find($id);
        return view('admin.reward.edit',[
            'data'    => $data,
            'cat'     => $cat
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
            'code'       => 'required|unique:reward,code,'.$id,
            'name' => 'required',
            'value'     => 'required',
            'poin'   => 'required',
            'start'      => 'required',
            'end'      => 'required',
            'limit'      => 'required',
            'cat' =>'required',
            'type'        =>'required',
            'image'  => 'required',
            'desc'=>'required',
            'url' =>'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now        = new DateTime();
            $enab       = Input::get('enable');
            $code       = Input::get('code');
            $name       = Input::get('name');
            $value      = Input::get('value');
            $poin       = Input::get('poin');
            $start      = Input::get('start');
            $end        = Input::get('end');
            $limit      = Input::get('limit');
            $cat        = Input::get('cat');
            $desc       = Input::get('desc');
            $type       = Input::get('type');
            $image      =Input::get('image');
            $content    = Input::get('content');
            $url        =Input::get('url');
            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            // store
            $store = Reward::find($id);
            $store->enable      = $enable;
            $store->code        = $code;
            $store->name        =$name;
            $store->value       = $value;
            $store->poin       = $poin;
            $store->start       = $start;
            $store->end         = $end;
            $store->limit       = $limit;
            $store->category_id =$cat;
            $store->description =$desc;
            $store->type       = $type;
            $store->image =$image;
            $store->content =$content;
            $store->url        = $url;
            $store->updated_at= $now;
            $store->save();

            // redirect
            return redirect('system/reward')->with('success','Data successfully updated');
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
        $data = Reward::find($id);
        $data->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }

}
