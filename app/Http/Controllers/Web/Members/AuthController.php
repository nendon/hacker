<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Support\Str;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\Member;
use Mail;
use DateTime;
use DB;
use App\Mail\InformasiUser;
use Illuminate\Support\Facades\Input;
use PHPMailer;
use Redirect;
use Session;
use Validator;
use Auth;
use Request;

class AuthController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin() {
        $this->forgetMember();
        return view('web.members.signin');
    }

    public function dosignin() {
        $this->forgetMember();
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
            $member = Member::where('email', '=', $email)->where('password', '=', $password)->first();

            if (count($member) > 0) {
                Session::set('memberID', $member->id);
                // redirect
                return redirect('/')->with('success', 'Selamat datang kembali,' . $member->username);

                // return redirect('member/dashboard')->with('success','Selamat datang,'.$member->username);
            } else {
                // redirect
                return redirect()->back()->with('error', 'Akun tidak di temukan !');
            }
        }
    }

    public function signup() {
        $this->forgetMember();
        return view('web.members.signup');
    }

    public function dosignup() {
        $this->forgetMember();
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'username' => 'required|alpha_dash|unique:members',
            'email' => 'required|email|unique:members',
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
            $now = new DateTime();
            // store
            $members = new Member();
            $members->status = 1;
            $members->username = $username;
            $members->email = $email;
            $members->password = $password;
            $members->created_at = $now;
            $members->save();
            $send = Member::findOrFail($members->id);
            Mail::to($members->email)->send(new InformasiUser($send));
            // store
            $member = Member::where('username', '=', $username)->where('email', '=', $email)->first();

            Session::set('memberID', $member->id);
            Session::set('membername', $member->username);
            // redirect
            return redirect('member/package')->with('success', 'Silahkan Pilih Paket Anda !');
        }
    }

    public function signout() {
        $this->forgetMember();

        return redirect('member/signin');
    }

    public function resetpassword() {
        return view('web.members.edit-password');
    }

    public function forgetpassword() {
        return view('web.members.forget-password');
    }

    public function doforgetpassword() {
        $rules = array(
            'email' => 'required|email',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = Input::get('email');
            $token = str_random(30) . $email;
            $now = new DateTime();
            $url = env(APP_URL);

            $forget = DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => $now,
            ]);
            if ($forget) {
                $mail = new PHPMailer;

                $mail->SMTPDebug = 3; // Enable verbose debug output

                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'localhost'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'noreply@cilsy.id'; // SMTP username
                $mail->Password = '5cb09re'; // SMTP password
                $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465; // TCP port to connect to
                #$mail->SMTPOptions = ['ssl' => ['allow_self_signed' => true]];
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->setFrom('noreply@cilsy.id', 'No reply');
                $mail->addAddress($email); // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                $mail->isHTML(true); // Set email format to HTML

                $mail->Subject = 'Cilsy Fiolution';
                $mail->Body = 'Silahkan klik link berikut <a href="' . $url . '/member/reset/update/' . $token . '">reset password</a> ';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    return Redirect()->to('/member/reset')->with('success', 'Berhasil Kirim Email! Silahkan Cek Email Anda');
                }
            } else {
                echo "error";
            }
        }
    }

    public function updatereset($token) {
        return view('web.members.form-forget');
    }

    public function doupdate() {
        $rules = array(
            'password' => 'required|min:6', // password can only be alphanumeric and has to be greater than 3 characters
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // sen d back the input (not the password) so that we can repopulate the form
        } else {
            $email = Input::get('email');
            $passwordbaru = (Input::get('password'));
            $retypepassword = (Input::get('retypepassword'));
            $checkid = DB::table('members')->where('email', '=', $email)->first();
            $check = DB::table('members')->where('email', '=', $email)->count();

            if ($check > 0) {
                // $checkid =DB::table('members')->where('email','=',$email)->first();
                if ($retypepassword !== $passwordbaru) {
                    return Redirect()->back()->with('geterror', 'These passwords don t match. Try again?!');
                } else {

                    $update = DB::table('members')
                            ->where('email', $checkid->email)
                            ->update([
                        'password' => md5($passwordbaru),
                    ]);
                    if ($update) {
                        return Redirect()->to('/member/signin')->with('success', 'Successfully change Password,please your login again   !');
                    } else {
                        return Redirect()->back()->with('error', 'Sorry something is error !');
                    }
                }
            } else {
                return Redirect()->back()->with('geterror', 'Sorry email is not valid !');
            }
        }
    }

    public function doreset(Request $request) {
		$user = Auth::guard('members')->user();
		// dd($user);
        $rules = array(
			'current_password' => 'required|current_password_match',
            'new_password'     => 'required|min:6|confirmed',
		);
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // sen d back the input (not the password) so that we can repopulate the form
		}else{
			$retypepassword = (Input::get('new_password'));
			$update = DB::table('members')
						->update([
							'password' => bcrypt($retypepassword),
						]);
        if($update){
            return back()->with('success', 'Selamat Password Anda Berhasil Di ubah!');
        }else{
        	return back()->with('errors', 'Gagal Reset Password');
        }
        
		}
        
	}

    private function forgetMember() {
        Session::forget('memberID');
    }

}
