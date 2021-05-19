<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Lesson;
use App\Models\Bootcamp;
use App\Models\Cicilan;
use App\Models\CicilanDetail;
use App\Models\Coupon;
use Auth;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $member_id = Auth::guard('members')->user()->id ?? null;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('total');
        // dd($code);
        $data = [
            'carts' => Cart::where('member_id', $member_id)->with('member', 'contributor', 'lesson', 'bootcamp')->get(),
        ];
        // dd($data);
        return view('web.cart', $data);
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

        return view(route('cart.bootcamp'));
        // session('cicilan_bootcamp_id', 'bootcamp_id');
    }

    public function destroy(Request $r, $cart_id)
    {
        if (!Auth::guard('members')->user()) {
            return 0;
        }
        $member_id = Auth::guard('members')->user()->id ?? null;
        
        /* delete */
        $kupon = session()->get('coupon')['name'];
        $cart = Cart::where('member_id', $member_id)->where('id', $cart_id)->delete();

        $minimal = Coupon::where('code', $kupon)->sum('minimum_checkout');
       
        $code =  Cart::join('lessons', 'lessons.id', 'cart.lesson_id')->where('member_id', $member_id)->sum('lessons.price');
        if($code <= $minimal){
            session()->forget('coupon');
            return redirect('/cart')->withErrors('Kode Promo tidak berlaku untuk paket yang anda pilih!');

        }else{
            return redirect('/cart');

        }
    }

    public function viewBootcampPayment($type, $id){
        {
            if($type != "cicilan" && $type != "cash" ){
                return abort(404);
            }

            $member_id = Auth::guard('members')->user()->id ?? null;
            if(empty($member_id)){
                return redirect('member/signin?next=bootcamp/payment/'.$type.'/'.$id);
            }
            $discount = session()->get('coupon')['discount'] ?? 0;
            $code = session()->get('total');

            $cicilan = Cicilan::where('member_id', $member_id)->where('bootcamp_id', $id)->with('CicilanDetail', 'bootcamp')->first();
            $boot = Bootcamp::with('contributor')->find($id);

            if(session()->get('coupon')['bootcamp_id'] !== $id || session()->get('coupon')['bootcamp_type'] !== $type){
                session()->forget('coupon');
            }

            Session()->forget('bootcamp_total');
            if($type=="cicilan"){
                Session()->put('bootcamp_total', $boot->price);
            }else{
                Session()->put('bootcamp_total', $boot->price*3);
            }

            if(is_null($cicilan)){
                return view('web.cart-cicilan', [
                    "bootcamp" => $boot,
                    "type" => $type,
                    "lunas" => false
                ]);
            }else{
                $sisa_cicilan = CicilanDetail::where('cicilan_id', $cicilan->id)->where('status', 2)->count();
                $sisa_cicilan == 0 ? $lunas = true : $lunas = false;

                return view('web.cart-cicilan', [
                    "bootcamp" => $cicilan->bootcamp,
                    "jadwal" => $cicilan->CicilanDetail,
                    "type" => $type,
                    "lunas" => $lunas
                ]);
            }
        }
    }

    public function storeBootcampNew(Request $r){
        $id = $r->input('id');
        $type = $r->input('type');

        $uid = Auth::guard('members')->user()->id;
        if (!$uid) {
            return redirect('member/signin');
        }
        $cicilan = Cicilan::where('bootcamp_id', $id)->where('member_id', $uid)->first();
        $bootcamp = Bootcamp::find($id);

        if(session()->has('coupon')){
            $kode_voucher = session()->get('coupon')['name'];

            if(session()->get('coupon')['type'] == 'fixed'){
                $nilai_voucher = session()->get('coupon')['value'];
            }elseif(session()->get('coupon')['type'] == 'percent'){
                $nilai_voucher = $bootcamp->price * session()->get('coupon')['percent_off'] / 100;
            }
        }else{
            $kode_voucher = NULL;
            $nilai_voucher = NULL;
        }


        if(is_null($cicilan)){
            $cicilan = Cicilan::Create([
                'bootcamp_id' => $bootcamp->id,
                'member_id' => $uid,
                'total' => $bootcamp->price * 3,
                'status' => 2,
                'posisi' => 0
                ]);
                
                if($type=="cicilan"){
                    for($x=1;$x<=3;$x++){
                        $detail = CicilanDetail::Create([
                            'cicilan_id' => $cicilan->id,
                            'tgl_tempo' => date('Y-m-d', strtotime("$x month")),
                            'total_cicilan' => $bootcamp->price,
                            'tgl_bayar' => $x == 1 ? date('Y-m-d') : NULL,
                            'status' => $x == 1 ? 1 : 2,
                            'posisi' => $x,
                            'kode_voucher' => $x == 1 ? $kode_voucher : NULL,
                            'nilai_voucher' => $x == 1 ? $nilai_voucher : NULL
                        ]);
                    }
                }else{
                    $detail = CicilanDetail::Create([
                        'cicilan_id' => $cicilan->id,
                        'tgl_tempo' => date('Y-m-d'),
                        'total_cicilan' => $bootcamp->price * 3,
                        'tgl_bayar' => date('Y-m-d'),
                        'status' => 1,
                        'posisi' => 1,
                        'kode_voucher' => $kode_voucher,
                        'nilai_voucher' => $nilai_voucher
                    ]);
                }
                
                if($cicilan){
                    session()->forget('coupon');
                    return json_encode(["Sukses" => "Pendaftaran bootcamp baru berhasil di daftarkan"]);
                }
        }else{

            $cicilandetail = CicilanDetail::where('cicilan_id', $cicilan->id)->where('status', 2)->orderBy('posisi')->first();

            if(is_null($cicilandetail)){
                return json_encode('Pembayaran sudah dibayar semua');
            }else{
                $cicilandetail->tgl_bayar = date('Y-m-d');
                $cicilandetail->status = 1;
                $cicilandetail->kode_voucher = $kode_voucher;
                $cicilandetail->nilai_voucher = $nilai_voucher;
                $cicilandetail->save();

                session()->forget('coupon');
                return json_encode(["sukses" => "Cicilan Tgl ".date('d F Y', strtotime($cicilandetail->tgl_tempo))." berhasil dibayar"]);
            }

        }

    }
}
