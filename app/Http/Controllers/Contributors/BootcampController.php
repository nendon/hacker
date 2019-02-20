<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\BootcampCategory;
use App\Models\BootcampSubCategory;
use App\Models\Course;
use App\Models\LampiranBootcamp;
use App\Models\Section;
use App\Models\Contributor;
use Auth;
use DateTime;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
          }
        return view('contrib.bootcamp.bootcamp');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function detail($slug)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $bootcamp = Bootcamp::where('slug', $slug)->first();
        $course = Course::where('bootcamp_id', $bootcamp->id)->get();

        return view('contrib.bootcamp.bootcamp',[
            'bootcamp' => $bootcamp,
            'courses' => $course,
        ]);
    }
    public function lampiran($slug)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $bootcamp = Bootcamp::where('slug', $slug)->first();
        $file = LampiranBootcamp::where('bootcamp_id', $bootcamp->id)->get();

        return view('contrib.bootcamp.lampiran',[
            'bootcamp' => $bootcamp,
            'files' => $file,
        ]);
    }
    public function detailbootcamp($slug)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $bootcamp = Bootcamp::with('bootcamp_category')->where('slug', $slug)->first();
        $cat = BootcampCategory::all();
        $sub = BootcampSubCategory::all();
        $contrib = Contributor::where('id', $bootcamp->contributor_id)->first();
        // dd($contrib);
        return view('contrib.bootcamp.detail',[
            'bootcamp' => $bootcamp,
            'contrib' => $contrib,
            'cat' => $cat,
            'sub' => $sub,
        ]);
    }
    public function getSub(BootcampCategory $bootcamp){
        return $bootcamp->bootcamp_sub_category()->select('id', 'title')->get();
    }
    public function harga($slug)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $bootcamp = Bootcamp::where('slug', $slug)->first();

        return view('contrib.bootcamp.harga',[
            'bootcamp' => $bootcamp,
        ]);
    }

    public function publish($slug)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $bootcamp = Bootcamp::where('slug', $slug)->first();

        return view('contrib.bootcamp.publish',[
            'bootcamp' => $bootcamp,
        ]);
    }
    
    public function saveDetail(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
   
            $input = Bootcamp::find($request->input('boot_id'));
            $input['title'] = $request->input('title');
            $input['deskripsi'] =  $request->input('desc');
            $input['sub_title'] =  $request->input('subjud');
            $input['audience'] = $request->input('target');
            $input['pre_and_req'] =  $request->input('req');
            $input['bootcamp_category_id'] = $request->input('kat');
            $input['bootcamp_sub_category_id'] =  $request->input('subkat');
            if ($request->hasFile('image')){
                $input['cover'] = '/assets/source/bootcamp/bootcamp-'.$request->input('boot_id').'/promo/'. $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/bootcamp/bootcamp-'.$request->input('boot_id').'/promo/'), $input['cover']);
            }
            if ($request->hasFile('video')){
                $input['promote_video'] = '/assets/source/bootcamp/bootcamp-'.$request->input('boot_id').'/cover/'. $request->video->getClientOriginalName();
                $request->video->move(public_path('/assets/source/bootcamp/bootcamp-'.$request->input('boot_id').'/cover/'), $input['promote_video']);
            }
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
          }
        $judul = Input::get('judul');
        $kat_id = Input::get('kategori');
        $slug = str_slug($judul);
        $now = new DateTime();

        $boot = new Bootcamp();
        $boot->title = $judul;
        $boot->bootcamp_category_id = $kat_id;
        $boot->contributor_id = Auth::guard('contributors')->user()->id;
        $boot->created_at = $now;
        $boot->slug = $slug;
        $boot->status = 0;
        $boot->save();
        return redirect('contributor/bootcamp/'.$slug);
    }

    public function saveCourse(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();

            $input = $request->all();
            $bootcamp = Bootcamp::where('id', $request->input('boot_id'))->first();
            $contri = Bootcamp::where('id',$request->input('boot_id'))
                      ->select('contributor_id')
                      ->first();
                    //   dd($bootcamp);    
            $input['title'] = $request->input('title');
            $input['bootcamp_id'] = $bootcamp->id;
            $input['deskripsi'] =  $request->input('desk');
            $input['estimasi'] =  $request->input('estimasi');
            // dd($input);

            if ($request->hasFile('image')){
                // if (!is_dir("assets/source/bootcamp/bootcamp-$bootcamp->id")) {
                //     $newforder = mkdir("assets/source/bootcamp/bootcamp-$bootcamp->id");
                // }
                $input['cover_course'] = '/assets/source/bootcamp/bootcamp-'.$bootcamp->id.'/'. $request->image->getClientOriginalName();
                // $input['file_name'] = $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/bootcamp/bootcamp-'.$bootcamp->id), $input['cover_course']);
            }

            $store = Course::create($input);
            $response['success'] = true;
        }
        echo json_encode($response);
    }

    public function updateCourse(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();

            $input = Course::find($request->input('course_id'));
            // dd($request->input('course_id'));
            $input['title'] = $request->input('title');
            $input['bootcamp_id'] = $request->input('boot_id');
            $input['deskripsi'] =  $request->input('desk');
            $input['estimasi'] =  $request->input('estimasi');
            // dd($input);

            if ($request->hasFile('image')){
                // if (!is_dir("assets/source/bootcamp/bootcamp-$bootcamp->id")) {
                //     $newforder = mkdir("assets/source/bootcamp/bootcamp-$bootcamp->id");
                // }
                $input['cover_course'] = '/assets/source/bootcamp/bootcamp-'.$input['bootcamp_id'].'/'. $request->image->getClientOriginalName();
                // $input['cover_course'] = $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/bootcamp/bootcamp-'.$input['bootcamp_id']), $input['cover_course']);
            }
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }

    public function saveLampiran(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();

            $input = $request->all();
            $bootcamp = Bootcamp::where('id', $request->input('boot_id'))->first();  
            $input['nama'] = $request->input('nama');
            $input['bootcamp_id'] = $bootcamp->id;
            $input['deskripsi'] =  $request->input('deskr');
            $input['estimasi'] =  $request->input('estimasi');
            // dd($input);

            if ($request->hasFile('file')){
                // if (!is_dir("assets/source/bootcamp/bootcamp-$bootcamp->id")) {
                //     $newforder = mkdir("assets/source/bootcamp/bootcamp-$bootcamp->id");
                // }
                $input['file'] = '/assets/source/bootcamp/bootcamp-'.$bootcamp->id.'/lampiran/'. $request->file->getClientOriginalName();
                // $input['file_name'] = $request->image->getClientOriginalName();
                $request->file->move(public_path('/assets/source/bootcamp/bootcamp-'.$bootcamp->id.'/lampiran/'), $input['file']);
            }

            $store = LampiranBootcamp::create($input);
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    public function updateLampiran(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            $input = LampiranBootcamp::find($request->input('lamp_id'));
            // $input = $request->all();  
            $input['nama'] = $request->input('nama');
            $input['bootcamp_id'] = $request->input('boot_id');
            $input['deskripsi'] =  $request->input('deskr');
            // $input['estimasi'] =  $request->input('estimasi');
            // dd($input);
            if ($request->hasFile('image')){
                // if (!is_dir("assets/source/bootcamp/bootcamp-$bootcamp->id")) {
                //     $newforder = mkdir("assets/source/bootcamp/bootcamp-$bootcamp->id");
                // }
                $input['file'] = '/assets/source/bootcamp/bootcamp-'.$input['bootcamp_id'].'/'. $request->image->getClientOriginalName();
                // $input['cover_course'] = $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/bootcamp/bootcamp-'.$input['bootcamp_id']), $input['file']);
            }
           
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
     public function saveHarga(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            $input = Bootcamp::find($request->input('boot_id'));
            // $input = $request->all();  
            $input['price'] = $request->input('harga');
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    public function confirmPublish(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            $input = Bootcamp::find($request->input('boot_id'));
            // $input = $request->all();  
            $input['status'] = $request->input('status');
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
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
    public function destroy($id)
    {
        //
    }
}
