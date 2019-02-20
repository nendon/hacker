<?php

namespace App\Http\Controllers\Web;

use App\Jobs\UpdateCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\invoice;
use DB;
use Session;
use DateTime;
use Illuminate\Support\Facades\Input;
use App\Models\Cart;
use Auth;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = new DateTime;
        $member_id = Auth::guard('members')->user()->id ?? null;
          if (!$member_id) {
            return redirect('member/signin?next=/cart');
          }
        $total = $request->input('total');
        // dd($total);
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if (!$coupon || $coupon->limit_coupon <= 0) {
            return redirect()->route('cart')->withErrors('Kode Promo yang anda masukkan tidak valid!');
        }
        if($coupon->minimum_checkout > $total){
            return redirect()->route('cart')->withErrors('Kode Promo tidak berlaku untuk paket yang anda pilih!');
        }
        if($coupon){
            $cut=$coupon->limit_coupon - 1;
            DB::table('coupon')
            ->where('code','=',$request->coupon_code)
            ->update(
                        ['limit_coupon' => $cut]
                    );
            // DB::table('invoice')
            // ->where('code', Session::get('invoiceCODE'));
        }
        dispatch_now(new UpdateCoupon($coupon));
        
        return redirect()->route('cart')->with('success_message', 'Selamat! Kode Promo berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('cart')->with('success_message', 'Kode Promo Berhasil Dihapus!');
    }
    public function ganti()
    {
        session()->forget('coupon');
        return redirect('member/package');
    }
}