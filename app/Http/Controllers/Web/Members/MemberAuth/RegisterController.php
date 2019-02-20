<?php

namespace App\Http\Controllers\Web\Members\MemberAuth;

use Illuminate\Http\Request;
use App\Models\Member;
use Validator;
use App\invoice;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use Session;
use Illuminate\Auth\Events\Registered;
use Auth;

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
        protected $redirectTo = '/';
    // } 

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:members',
            'email' => 'required|email|max:255|unique:members',
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
        return Member::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('web.members.signup');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function register(Request $r)
    {
        
        $this->validator($r->all())->validate();

       //Create members
        $members = $this->create($r->all());

        //Authenticates seller
        $this->guard()->login($members);

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

       //Redirects sellers
        
        if (session()->get('invoiceCode')) {
            return view('web.payment.summary', compact('packages', 'member'));
        } else {
            return redirect($this->redirectTo);
        }
    }

    protected function guard()
   {
       return Auth::guard('members');
   }
}
