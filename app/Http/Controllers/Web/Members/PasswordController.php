<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
// use App\Models\Invoice;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
// use DB;
use Auth;
use Hash;

class PasswordController extends Controller
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
      $members = Member::where('id',$mem_id)->first();
      // dd($members);
      // $packages = Package::all();
      return view('web.members.change-password', [
        // 'packages' => $packages
        'member' => $members,
      ]);
    }
    public function SaveAccount(Request $request)
    {
      $mem_id = Auth::guard('members')->user()->id;
      $now = new DateTime;

      $validatedData = $request->validate([
          'email' => 'email|unique:members|required',
          'username' => 'required'
      ]);

      //Change Password
      $user = Auth::guard('members')->user();
      $user->email = $request->get('email');
      $user->username = $request->get('username');
      $user->updated_at = $now;
      $user->save();

      return redirect()->back()->with("success","Akun Berhasil di Ubah");
    }

    public function doSubmit(Request $request)
    {
      $mem_id = Auth::guard('members')->user()->id;

      if (!(Hash::check($request->get('current_password'), Auth::guard('members')->user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
      }

      if(strcmp($request->get('current_password'), $request->get('new-password')) == 0){
          //Current password and new password are same
          return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
      }

      $validatedData = $request->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:8|confirmed',
      ]);
      $now = new DateTime;

      //Change Password
      $user = Auth::guard('members')->user();
      $user->password = bcrypt($request->get('password'));
      $user->updated_at = $now;
      $user->save();

      return redirect()->back()->with("success","Password changed successfully !");
    }

}
