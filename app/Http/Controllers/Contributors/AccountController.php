<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Contributor;
use Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
use DB;
use DateTime;
use Auth;
use Hash;

class AccountController extends Controller
{
    public function informasi()
    {
    	$contribID = Auth::guard('contributors')->user()->id;
    	$contributor = Contributor::find($contribID);

    	return view('contrib.account.informasi', [
    		'contrib' => $contributor
    	]);
    }

    public function edit($id)
    {
    	$contribID = Auth::guard('contributors')->user()->id;
    	$contributor = Contributor::find($contribID);

    	return view('contrib.account.edit_informasi', [
    		'contrib' => $contributor
    	]);
    }

    public function update_informasi(Request $request, $id)
    {
    	$rules = array(
    		'email' => 'required|email',
    		'password' => 'required|min:8|confirmed', // password can only be alphanumeric and has to be greater than 3 characters
    	);
    	$validator = Validator::make(Input::all(), $rules);

    	if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // sen d back the input (not the password) so that we can repopulate the form
		}else{
			$email = Input::get('email');
			$passwordbaru = bcrypt(Input::get('password'));
			$checkid = DB::table('contributors')->where('email', '=', $email)->first();
            $check = DB::table('contributors')->where('email', '=', $email)->count();
            if (!(Hash::check($request->get('current_password'), Auth::guard('contributors')->user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }

            if(strcmp($request->get('current_password'), $request->get('new-password')) == 0){
                //Current password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }
			if ($check > 0) {

					$update = DB::table('contributors')
						->where('email', $checkid->email)
						->update([
                            'email' => $email,
							'password' => $passwordbaru,
						]);
					if ($update) {
						return Redirect()->to('/contributor/account/informasi')->with('success', 'Sukses Perbaharui Informasi Akun');

					} else {
						return Redirect()->back()->with('error', 'Maaf Ada yang Error');
					}
			} else {
				return Redirect()->back()->with('geterror', 'Sorry email is not valid !');
			}
		}
    }

    public function halaman()
    {
    	$contribID = Auth::guard('contributors')->user()->id;
    	$contributor = Contributor::find($contribID);

    	return view('contrib.account.halaman', [
    		'contrib' => $contributor
    	]);
    }
    public function edit_halaman($id)
    {
        $contribID = Auth::guard('contributors')->user()->id;
        $contributor = Contributor::find($contribID);

        return view('contrib.account.edit_halaman', [
            'contrib' => $contributor
        ]);
    }

    public function update_halaman(Request $request, $id)
    {
        $rules = array(
            'username' => 'required|alpha_dash',
            'first_name' => 'required',
            'last_name' => 'required',
            'pekerjaan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'bio' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator); // send back all errors to the login form
        }else{
            $now          = new DateTime();
            $username = Input::get('username');
            $firstname = Input::get('first_name');
            $last_name = Input::get('last_name');
            $pekerjaan = Input::get('pekerjaan');
            $tempat_lahir = Input::get('tempat_lahir');
            $tanggal_lahir = Input::get('tanggal_lahir');
            $bio = Input::get('bio');
            $avatar = Input::file('avatar');
            

            $avatarDestinationPath= 'assets/source/avatar';

            if(!empty($avatar)){
                $avatarfilename    = $avatar->getClientOriginalName();
                $avatar->move($avatarDestinationPath, $avatarfilename);
            }else{
                $avatarfilename    = '';
            }
            if($avatarfilename ==''){
                $url_image= $avatarfilename;
            }else{
                $urls=url('');
                $url_image= $urls.'/assets/source/avatar/'.$avatarfilename;
            }

            $halaman = Contributor::find($id);
            $halaman->username = $username;
            $halaman->first_name = $firstname;
            $halaman->last_name = $last_name;
            $halaman->pekerjaan = $pekerjaan;
            $halaman->tempat_lahir = $tempat_lahir;
            $halaman->tanggal_lahir = $tanggal_lahir;
            $halaman->deskripsi = $bio;
            if($url_image == null){
                $halaman->avatar = $halaman->avatar;
            }
            else{
                $halaman->avatar = $url_image;
            }
            
            $halaman->created_at = $now;
            $halaman->save();

            return Redirect()->to('/contributor/account/profile')->with('success', 'Sukses Perbaharui Informasi Akun');
        }
    }
}
