<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BootcampCategory;
use App\Models\Bootcamp;
use Auth;
use App\Models\Cart;
use DB;

class BrowseController extends Controller
{
    public function index(){
        //load data dengan eager loading
        $bootcat = BootcampCategory::with('bootcamp.contributor', 'bootcamp.bootcamp_member', 'bootcamp.course')->get();
        // dd($bootcat);
        $member_id = Auth::guard('members')->user()->id ?? null;

        $cart = Cart::where('member_id', $member_id )->where('lesson_id', null)->first();
        if($cart){
            DB::table('cart')
            ->where('member_id', $member_id)
            ->where('lesson_id',null)
            ->update([
              'aktif'      => 0
            ]);
        }

        return view('web.browse.kategori', [
            'boot' => $bootcat,
        ]);
    }

    public function detail($slug){
        $bucat = BootcampCategory::where('slug', $slug)->first();
        $boot = Bootcamp::with(['bootcamp_category' => function ($query) use ($slug){
            $query->where('slug', $slug);}], 'contributor', 'bootcamp_member', 'course')->where('bootcamp_category_id', $bucat->id)->paginate(4);
        $cat = BootcampCategory::all();
        $new = Bootcamp::with(['bootcamp_category' => function ($query) use ($slug){
            $query->where('slug', $slug);}], 'contributor', 'bootcamp_member', 'course')->where('bootcamp_category_id', $bucat->id)->orderBy('created_at', 'asc')->take(2)->get();
        return view('web.browse.detail', [
            'hasil' => $boot,
            'cat' => $cat,
            'new' => $new,
            'bucat' => $bucat,
        ]);

    }
}
