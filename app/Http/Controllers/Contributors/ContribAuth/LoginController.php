<?php

namespace App\Http\Controllers\Contributors\ContribAuth;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Auth;
use Session;
use DB;
use App\invoice;
use Redirect;

 
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'contributor/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        $this->middleware('RedirectIfContrib', ['except' => 'logout']);
        if ($r->input('next')) {
            $this->redirectTo = url($r->input('next'));
        }
        
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('contrib.home.login');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('contributors');
    }


    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/contributor/login')->with('success', 'Logout berhasil!');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => [
                'required','string',
                Rule::exists('contributors')->where(function($query){
                    $query->where('active',true);
                })
            ],
            'password' => 'required|string',
        ], $this->validationError());
    }

    /**
     * Get the validation error for login
     *
     * @return array
     */
    public function validationError()
    {
        return [
                $this->username () . '.exists' => 'The selected email is invalid or you need to activate your account'
        ];
    }
}
