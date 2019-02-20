<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Service;
// use App\Models\Invoice;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
// use DB;
use Auth;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      $service  = Service::where('status',1)->where('members_id',$mem_id)->first();
      $services = Service::where('members_id',$mem_id)->orderBy('id','DESC')->get();
      return view('web.members.subscriptions', [
        'service'   => $service,
        'services'  => $services
      ]);
    }

    public function doUnsubscribe($id)
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      $now = new DateTime();
      $service  = Service::where('status',1)->where('members_id',$mem_id)->where('id',$id)->first();
      if ($service) {
        $update             = Service::findOrFail($id);
        $update->status     = 2;
        $update->updated_at = $now;
        if ($update->save()) {
        return redirect()->back()->with('success','Berhasil berhenti berlangganan');
        }
      }else {
        abort(404);
      }

    }

}
