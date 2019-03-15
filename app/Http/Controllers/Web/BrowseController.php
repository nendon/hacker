<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BootcampCategory;
use App\Models\Bootcamp;

class BrowseController extends Controller
{
    public function index(){
        //load data dengan eager loading
        $bootcat = BootcampCategory::with('bootcamp.contributor', 'bootcamp.bootcamp_member', 'bootcamp.course')->get();
        // dd($bootcat);
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
