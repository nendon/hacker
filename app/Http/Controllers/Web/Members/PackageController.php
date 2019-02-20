<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Package;
use App\Models\Cart;
use Session;
use Hash;
use DateTime;
use DB;
use Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $packages = Package::all();
      return view('web.members.package', [
        'packages' => $packages
      ]);
    }
    public function dopackage()
    {
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'packages_id'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $packages_id    = Input::get('packages_id');
          $packages       = Package::where('id','=',$packages_id)->first();
          if(Auth::guard('members')->user()){
            $member_id      = Auth::guard('members')->user()->id;
          }else{
            $member_id      = null;
          }
          $member = Member::where('id', '=', $member_id)->first();
          // dd($packages);
          Session::put('price', $packages->price);
          if($member_id == null){
            session()->put('package', [
            'paket' => $packages->title,
            'harga' => $packages->price,
            'expired' => $packages->expired,
            ]);
            Session::put('package_id', $packages->id);
                // dd(Session::get('invoiceCODE'));
                return redirect('member/signup');
                
          } else{
            session()->put('package', [
            'paket' => $packages->title,
            'harga' => $packages->price,
            'expired' => $packages->expired,
            ]);
            Session::put('email', $member->email);
            Session::put('package_id', $packages->id);
            # code...
            return view('web.payment.summary', compact('packages', 'member')
              
            );
          }
          
          
          
      }
    }
    public function summary(){
          $now = new DateTime();
          $member_id = Auth::guard('members')->user()->id ?? null;
          if (!$member_id) {
            return redirect('member/signin?next=/cart');
          }

          /* ambil data cart */
          $price = 0;
          $carts = 0;
          $boot = 0;
          $total = 0;
          $harga = 0;
          $carts = Cart::where('member_id', $member_id)->with('lesson')->get();
          $boot = Cart::where('member_id', $member_id)->with('bootcamp')->get();

          foreach ($carts as $cart) {
            if($cart->lesson_id){
            $total += $cart->lesson->price;
            }
          }
          foreach ($boot as $boots) {
            if($boots->bootcamp_id){
            $harga += $boots->bootcamp->price;
            }
          }

          $price += $total + $harga;

          if(Session::get('coupon')){
            $disc = 0;
            
            if(session()->get('coupon')['type'] == 'percent'){
              $disc =  $price*session()->get('coupon')['percent_off']/100;
            }else{
              $disc = session()->get('coupon')['discount'];
            }
            $price = $price-$disc;
          }
          
          $code = $this->generateCode();
          // store
          $invoice = Invoice::updateOrCreate([
            'members_id' => $member_id,
            'status' => 0,
          ], [
            'price' => $price,
            'code' => $code
          ]);
          // store invoice detail
          if ($invoice) {
            foreach ($carts as $cart) {
              if($cart->lesson_id){
              InvoiceDetail::updateOrCreate([
                'invoice_id' => $invoice->id,
                'lesson_id' => $cart->lesson->id,
                'harga_lesson' => $cart->lesson->price,
                'contributor_id' => $cart->lesson->contributor_id,
              ]);
              }
              }

              foreach ($boot as $boots) {
                if($boots->bootcamp_id){
                InvoiceDetail::updateOrCreate([
                  'invoice_id' => $invoice->id,
                  'bootcamp_id' => $cart->bootcamp->id,
                  'harga_lesson' => $cart->bootcamp->price,
                  'contributor_id' => $cart->bootcamp->contributor_id,
                ]);
                }
            }

            session()->forget('coupon');
          }

          Session::put('invoiceCODE', $invoice->code);
          Session::put('price', $invoice->price);

          return redirect('checkout');
  }
    private function generateCode()
    {
      $randomCode     = 'INV'.rand(000000,999999);
      // $randomCode = uniqid();
      $check = Invoice::where('code','=',$randomCode)->count();
      if($check > 0){
        $this->generateCode();
      }else{
        return $randomCode;
      }
    }

}