<?php

namespace App\Http\Controllers\Web\Members\MemberAuth;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        $this->middleware('RedirectIfMember', ['except' => 'logout']);
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
        return view('web.members.signin');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $r
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $r, $user)
    {
        /* sync cart */
        if ($r->input('next')) {
            $ids = explode(",", $r->input('lessons'));
            foreach ($ids as $id) {
                /* cek lesson */
                $lesson = \App\Models\Lesson::find($id);
                if ($lesson) {
                    /* simpan ke cart */
                    $cart = \App\Models\Cart::firstOrCreate([
                        'member_id' => Auth::guard('members')->user()->id,
                        'contributor_id' => $lesson->contributor_id,
                        'lesson_id' => $lesson->id
                    ]);
                }
            }
        }else{
            $ids = explode(",", $r->input('lessons'));
            foreach ($ids as $id) {
                /* cek lesson */
                $lesson = \App\Models\Lesson::find($id);
                if ($lesson) {
                    /* simpan ke cart */
                    $cart = \App\Models\Cart::firstOrCreate([
                        'member_id' => Auth::guard('members')->user()->id,
                        'contributor_id' => $lesson->contributor_id,
                        'lesson_id' => $lesson->id
                    ]);
                }
            }
            return redirect('/');
        }


        if (session()->get('invoiceCode')) {
            return view('web.payment.summary', compact('member'));
        } else {
            return redirect($this->redirectTo);
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('members');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard('members')->attempt(
            $this->credentials($request), $request->filled('remember')
        );
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

        $request->session()->invalidate();
        
        //hapus invoice code
        Session::forget('invoiceCODE');

        return redirect('/member/signin');
    }
}
