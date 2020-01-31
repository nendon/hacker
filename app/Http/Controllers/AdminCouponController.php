<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use App\Models\Coupon;
use Validator;
use Redirect;
use DateTime;
use Helper;
use Auth;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coupon::all();
        return view('admin.coupon.index',[
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
        return view('admin.coupon.create');
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
          'code'       => 'required|unique:coupon',
          'limit_coupon' => 'required',
          'minimum'     => 'required',
          'type'   => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $enab         = Input::get('enable');
            $code         = Input::get('code');
            $type          = Input::get('type');
            $limit    = Input::get('limit_coupon');
            $minim        = Input::get('minimum');
            $value      = Input::get('value');
            $percent         = Input::get('percent_off');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }
            if (empty($value)){
                $value = 0;
            }
            if (empty($percent)){
                $percent = 0;
            }
            $store = new Coupon;
            $store->enable      = $enable;
            $store->code        = $code;
            $store->type       = $type;
            $store->limit_coupon      = $limit;
            $store->minimum_checkout   = $minim;
            $store->value       = $value;
            $store->percent_off       = $percent;            
            $store->created_at  = $now;
            $store->updated_at  = $now;
            $store->save();

            return redirect('system/coupon')->with('success','Successfully create data');

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
        $data    = Coupon::find($id);
        return view('admin.coupon.edit',[
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
          'code'       => 'required',
          'limit_coupon' => 'required',
          'minimum'     => 'required',
          'type'   => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $enab         = Input::get('enable');
            $code         = Input::get('code');
            $type          = Input::get('type');
            $limit    = Input::get('limit_coupon');
            $minim        = Input::get('minimum');
            $value      = Input::get('value');
            $percent         = Input::get('percent_off');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }
            if (empty($value)){
                $value = 0;
            }
            if (empty($percent)){
                $percent = 0;
            }
            $store = Coupon::find($id);
            $store->enable      = $enable;
            $store->code        = $code;
            $store->type       = $type;
            $store->limit_coupon      = $limit;
            $store->minimum_checkout   = $minim;
            $store->value       = $value;
            $store->percent_off       = $percent;            
            $store->created_at  = $now;
            $store->updated_at  = $now;
            $store->save();

            return redirect('system/coupon')->with('success','Successfully create data');

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
        $data = Coupon::find($id);
        $data->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }
}