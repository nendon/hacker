<?php

namespace App\Http\Controllers\Contributors;

use App\Models\Contributor;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use DateTime;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Session;
use Validator;
use Hash;

class AuthController extends Controller {
	/**
	 * 
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login() {
		$this->forgetContributor();
		return view('contrib.home.login');

	}
	public function doLogin() {
		$this->forgetContributor();
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$email = Input::get('email');
			$password = md5(Input::get('password'));
			$now = new DateTime();
			// store
			$contributors = Contributor::where('email', '=', $email, 'AND', 'password', '=', $password)->first();

			if (count($contributors) > 0) {
				Session::put('contribID', $contributors->id);
				// redirect
				return redirect('contributor/dashboard')->with('success', 'Selamat datang kembali,' . $contributors->name);

				// return redirect('member/dashboard')->with('success','Selamat datang,'.$member->username);
			} else {
				// redirect
				return redirect()->back()->with('error', 'Akun tidak di temukan !');
			}
		}
	}

	public function register() {
		$this->forgetContributor();
		return view('contrib.home.register');

	}
	public function doRegister() {
		$this->forgetContributor();
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'username' => 'required',
			'email' => 'required|email|unique:contributors',
			'password' => 'required|min:8',
			'retype_password' => 'required|min:8|same:password',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$username = Input::get('username');
			$email = Input::get('email');
			$password = md5(Input::get('password'));
			$token = str_random(30) . $email;
			$now = new DateTime();
			$url = env('APP_URL');
			// var_dump(env('MAIL_HOST'));
			// store
			$store = new Contributors;
			$store->status = 0;
			$store->username = $username;
			$store->email = $email;
			$store->password = $password;
			$store->token = $token;
			$store->created_at = $now;
			$store->save();

			$send = Contributor::findOrFail($store->id);

			Mail::to($store->email)->send(new EmailVerification($send));
			return Redirect()->to('/contributor/register')->with('success', 'Berhasil Kirim Email! Silahkan Cek Email Anda');

			// set session

//			Session::set('contribID', $store->id);
			//			// redirect
			//			return redirect('contributor')->with('success', 'Selamat Datang !');
		}
	}

	public function aktivasi($token) {
		Contributor::where('activation_token', $token)
			->update(['active' => true,
            'activation_token' => null ]);
		return redirect('contributor/login')->with('success', 'Sukses Aktivasi!, silahkan login ke akun anda');
	}

	public function logout() {
		$this->forgetContributor();

		return redirect('contributor/login');
	}
	//
	// public function resetpassword()
	// {
	//   return view('web.members.edit-password');
	// }
	//
	// public function doreset()
	// {
	//   {
	//   if(Session::get('memberID')){
	//     $memberid=Session::get('memberID');
	//    # code...
	//    // validate the info, create rules for the inputs
	//        $rules = array(
	//
	//        'password' => 'required|min:6', // password can only be alphanumeric and has to be greater than 3 characters
	//
	//    );
	//    // run the validation rules on the inputs from the form
	//    $validator = Validator::make(Input::all(), $rules);
	//    // if the validator fails, redirect back to the form
	//    if ($validator->fails()) {
	//        return redirect()->back()
	//              ->withErrors($validator) // send back all errors to the login form
	//              ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
	//    } else {
	//
	//        $passwordbaru     = md5(Input::get('password'));
	//        $retypepassword  = md5(Input::get('retypepassword'));
	//
	//        if($retypepassword !==$passwordbaru){
	//            return Redirect()->back()->with('error_get','These passwords don t match. Try again?!');
	//        }else{
	//
	//          $update = DB::table('members')
	//                  ->where('id', $memberid)
	//                  ->update([
	//                          'password'       => $passwordbaru ,
	//                      ]);
	//            if($update){
	//
	//                   return Redirect()->to('/member/signin')->with('success','Successfully change Password,please your login again   !');
	//
	//            }else{
	//                  return Redirect()->back()->with('error','Sorry something is error !');
	//            }
	//
	//        }
	//
	//    }
	//    }else{
	//              Session::flash('error_must_login','You must sign');
	//              return Redirect('member/login');
	//       }
	//  }
	// }

	private function forgetContributor() {
		Session::forget('contribID');
	}

}
