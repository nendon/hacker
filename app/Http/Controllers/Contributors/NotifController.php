<?php
namespace App\Http\Controllers\Contributors;
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
use App\Models\Contributor;
use App\Models\ContributorNotif;
use Auth;

class NotifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $getnotif = DB::table('contributor_notif')
            ->where('contributor_id',$uid)
            ->where('status','0')
            ->orderBy('contributor_notif.created_at','DESC')
            ->paginate(10);
        return view('contrib.notif.index', [
            'data' => $getnotif
        ]);
    }
    public function notifread(){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $getnotif = DB::table('contributor_notif')
            ->where('contributor_id',$uid)
            ->where('status','1')
            ->orderBy('contributor_notif.created_at','DESC')
            ->paginate(10);
        return view('contrib.notif.read', [
            'data' => $getnotif
        ]);
    }
    public function all(){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $getnotif = DB::table('contributor_notif')
            ->where('contributor_id',$uid)
            ->orderBy('contributor_notif.created_at','DESC')
            ->paginate(10);
        return view('contrib.notif.all', [
            'data' => $getnotif
        ]);
    }
    public function read(){
      $id = Input::get('id');
      $update= ContributorNotif::find($id);
      $update->status=1;
      $update->save();
    }
    public function view(){
      $id = Input::get('id');
      $update= ContributorNotif::find($id);
      $update->status=1;
      $update->save();
    }

    public function delete($id){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $uid = Auth::guard('contributors')->user()->id;
        $detail  = DB::table('contributor_notif')
        ->where('id',$id)->first();
        if ($detail->contributor_id == $uid) {
            DB::table('contributor_notif')->where('id',$id)->update([
                'status' => 1,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

}
