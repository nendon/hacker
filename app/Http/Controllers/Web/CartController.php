<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Lesson;
use App\Models\Bootcamp;
use App\Models\Coupon;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $member_id = Auth::guard('members')->user()->id ?? null;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('total');
        // dd($code);
        $data = [
            'carts' => Cart::where('member_id', $member_id)->with('member', 'contributor', 'lesson', 'bootcamp')->where('cart.lesson_id', '<>', null )->get(),
        ];
        // dd($data);
        return view('web.cart', $data);
    }

    public function indexboot()
    {
        $member_id = Auth::guard('members')->user()->id ?? null;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('total');
        // dd($code);
        $data = [
            'carts' => Cart::where('member_id', $member_id)->with('member', 'contributor','lesson', 'bootcamp')->where('cart.bootcamp_id', '<>', null )->get(),
        ];
        // dd($data);
        if($data){
        return view('web.keranjang', $data);
        }else{
            return redirect('browse/bootcamp');
        }
    }

    public function store(Request $r)
    {
        /* cek lesson */
        $lesson = Lesson::find($r->input('id'));
        if (!$lesson) {
            throw new \Exception('Tutorial tidak ditemukan');
        }

        if (!Auth::guard('members')->user()) {
            return response()->json([
                'id' => $lesson->id,
                'image' => url($lesson->image),
                'title' => $lesson->title,
                'price' => $lesson->price
            ]);
        }

        /* simpan ke cart */
        $cart = Cart::firstOrCreate([
            'member_id' => Auth::guard('members')->user()->id,
            'contributor_id' => $lesson->contributor_id,
            'lesson_id' => $lesson->id
        ]);
        // Session::put('cart', $cart);
        // dd($cart);
        
        return response()->json([
            'id' => $lesson->id,
            'title' => $lesson->title
        ]);
    }

    public function storeBootcamp(Request $r)
    {
        /* cek lesson */
        $bootcamp = Bootcamp::find($r->input('id'));
        // dd($bootcamp);
        if (!$bootcamp) {
            throw new \Exception('Bootcamp tidak ditemukan');
        }

        if (!Auth::guard('members')->user()) {
            return response()->json([
                'id' => $bootcamp->id,
                'image' => url($bootcamp->cover),
                'title' => $bootcamp->title,
                'price' => $bootcamp->price
            ]);
        }

        /* simpan ke cart */
        $cart = Cart::firstOrCreate([
            'member_id' => Auth::guard('members')->user()->id,
            'contributor_id' => $bootcamp->contributor_id,
            'bootcamp_id' => $bootcamp->id
        ]);
        // Session::put('cart', $cart);
        dd($cart);
        return response()->json([
            'id' => $bootcamp->id,
            'title' => $bootcamp->title
        ]);
    }
    public function storeCicilan(Request $r)
    {
        /* cek lesson */
        $bootcamp = Bootcamp::find($r->input('id'));
        // dd($bootcamp);
        if (!$bootcamp) {
            throw new \Exception('Bootcamp tidak ditemukan');
        }
        $price = $bootcamp->normal_price/3;
        if (!Auth::guard('members')->user()) {
            return response()->json([
                'id' => $bootcamp->id,
                'image' => url($bootcamp->cover),
                'title' => $bootcamp->title,
                'price' => $price
            ]);
        }

        /* simpan ke cart */
        $cart = Cart::firstOrCreate([
            'member_id' => Auth::guard('members')->user()->id,
            'contributor_id' => $bootcamp->contributor_id,
            'bootcamp_id' => $bootcamp->id,
            'cicilan' =>  1,
        ]);
        // Session::put('cart', $cart);
        return response()->json([
            'id' => $bootcamp->id,
            'title' => $bootcamp->title
        ]);
    }
    public function destroy(Request $r, Cart $cart)
    {
        if (!Auth::guard('members')->user()) {
            return 0;
        }
        $member_id = Auth::guard('members')->user()->id ?? null;

        /* delete */
        if($cart->bootcamp_id == null){
        $kupon = session()->get('coupon')['name'];
        $cart->delete();

        $minimal = Coupon::where('code', $kupon)->sum('minimum_checkout');
       
        $code =  Cart::join('lessons', 'lessons.id', 'cart.lesson_id')->where('member_id', $member_id)->sum('lessons.price');
        if($code <= $minimal){
            session()->forget('coupon');
            return redirect('/cart')->withErrors('Kode Promo tidak berlaku untuk paket yang anda pilih!');

        }else{
            return redirect('/cart');

        }
        }else{
            $kupon = session()->get('coupon')['name'];
            $cart->delete();
    
            $minimal = Coupon::where('code', $kupon)->sum('minimum_checkout');
           
            $code =  Cart::join('lessons', 'lessons.id', 'cart.lesson_id')->where('member_id', $member_id)->sum('lessons.price');
            if($code <= $minimal){
                session()->forget('coupon');
                return redirect('/cartboot')->withErrors('Kode Promo tidak berlaku untuk paket yang anda pilih!');
    
            }else{
                return redirect('/browse/bootcamp');
    
            }  
        }
    }
}
