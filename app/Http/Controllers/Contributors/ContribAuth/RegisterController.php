<?php

namespace App\Http\Controllers\Contributors\ContribAuth;

use Illuminate\Http\Request;
use App\Models\Contributor;
use Validator;
use App\invoice;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use Session;
use Illuminate\Auth\Events\Registered;
use Auth;
use App\Events\ContributorRegistered;
use App\Mail\Auth\ActivationMail;
use Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // if(Session::get('invoiceCODE')){
    //     DB::table('invoice')->where('code', '=', Session::get('invoiceCODE'))->update([
    //         'members_id' => $member->id
    //     ]);
    //     protected $redirectTo = '/checkout';
    // }else{
        protected $redirectTo = '/contributor/dashboard';
    // }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('RedirectIfContrib', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:contributors',
            'email' => 'required|email|max:255|unique:contributors',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Contributor::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'active' =>false,
            'activation_token' => str_random(40),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('contrib.home.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function guard()
   {
       return Auth::guard('contributors');
   }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $contributor)
    {
        //sending mail
        Mail::to($contributor->email)->send(new ActivationMail($contributor));

         $this->guard()->logout();
        return redirect('contributor/login')->withSuccess('Registered. Please check your email to activate your account.');
    }
}

