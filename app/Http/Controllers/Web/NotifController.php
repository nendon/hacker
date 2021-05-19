<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use Session;
use Hash;
use DateTime;
use DB;
use App\Models\Member;
use App\Models\UserNotif;
use Auth;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (empty(Auth::guard('members')->user()->id)) {
          return redirect('member/signin');
        }
        $uid = Auth::guard('members')->user()->id;
        $getnotif = DB::table('user_notif')
            ->where('id_user',$uid)
            ->orderBy('user_notif.created_at','DESC')
            ->get();
        return view('web.notifuser.index', [
            'data' => $getnotif
        ]);
    }

    public function read(){
      $id = Input::get('id');
      dd($id);
      $update= UserNotif::find($id);
      $update->status=1;
      $update->save();
    }
    public function view(){
      $id = Input::get('id');
      $update= UserNotif::find($id);
      $update->status=1;
      $update->save();
    }

    public function delete($id){
        if (empty(Auth::guard('members')->user()->id)) {
          return redirect('members/signin');
        }
        $uid = Auth::guard('members')->user()->id;
        $detail  = DB::table('user_notif')
        ->where('id',$id)->first();
        if ($detail->id_user == $uid) {
            DB::table('user_notif')->where('id',$id)->update([
                'status' => 1,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

}
