<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;
use Validator;
use Redirect;
use DateTime;
use Helper;
use Auth;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Revision;
use App\Models\Contributor;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = DB::table('lessons')
        ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
        ->select('lessons.*','categories.title as category_title')
        ->get();
        return view('admin.lesson.index',[
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = DB::table('categories')->get();
        return view('admin.lesson.create',[
            'cat' => $cat,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
          'title'   => 'required|unique:lessons',
          'price'   => 'required',
          'cat'     => 'required',
          'desc'    => 'required',
          'slug'    => 'required',
          'image'   => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $title        = Input::get('title');
            $price        = Input::get('price');
            $categori_id  = Input::get('cat');
            $desc         = Input::get('desc');
            $slug         = Input::get('slug');
            $image        = Input::get('image');
            $tiket_upload_status=1;
            $pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $desc);            
            if (!is_dir("assets/filepraktek/")) {
                $newforder=mkdir("assets/filepraktek");
            }
            $file = Input::file('file');
            if ($file !==null) {

             $fileName   = $file->getClientOriginalName();
             $file->move("assets/filepraktek", $fileName);
            //  $fileName   = $file->getClientOriginalName();
            //  $request->file('file')->move("assets/file/ticket/".$fileName);
             $store->file_praktek = $fileName;
            $store->save();
            }
            $insert = DB::table('lessons')->insert([
              'enable'      => 1,
              'title'       => $title,
              'price'       => $price,
              'category_id' => $categori_id,
              'image'       => $image,
              'description' => $desc,
              'slug'        => $slug,
              'meta_desc'   => str_limit($pre, 150),
              'created_at'  => $now,
              'updated_at'  => $now
            ]);
            if ($file !==null) {
             foreach ($file as $key =>  $tiket)
               {
                 $fileName   = $tiket->getClientOriginalName();
                 $tiket->move("assets/filepraktek", $fileName);

                  $insert= DB::table('file_praktek')->insert([
                   'lesson_id'=>$lesson_id,
                   'file_status'=>$file_status,
                   'tiket_name'=>$tiketname[$key],
                   'file_praktek'=>$fileName,
                   'created_at' => $now,
                   ]);
               }
            }
            $tiketname = Input::get('tiketname');
          // $size = $file->getSize();
          // var_dump($size) ;exit;
         // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image

           if ($file !==null) {
             foreach ($file as $key =>  $tiket)
               {
                 $fileName   = $tiket->getClientOriginalName();
                 $tiket->move("assets/filepraktek", $fileName);

                  $insert= DB::table('file_praktek')->insert([
                   'lesson_id'=>$lesson_id,
                   'file_status'=>$file_status,
                   'tiket_name'=>$tiketname[$key],
                   'file_praktek'=>$fileName,
                   'created_at' => $now,
                   ]);
               }
           }
            if($insert){
                 return redirect('system/lessons')->with('success','New Data Succesfully created');

            }else{
                  return Redirect()->back()->with('error','Sorry something is error !');
            }

        }
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
        $lessons    = Lesson::find($id);
        $categories = Category::where('enable','=','1')->get();
        $revisi = Revision::where('lession_id',$id)->get();
        return view('admin.lesson.edit',[
            'categories'    => $categories,
            'lessons'       => $lessons,
            'revisi'        => $revisi,
        ]);
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
        $rules = array(
            'title'         => 'required|unique:lessons,title,'.$id,
            'category_id'   => 'required',
            'description'   => 'required',
            'slug'          => 'required',
            'image'         => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $title=Input::get('title');
            $pre = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', Input::get('description'));
            // store
            $check= Lesson::where('id',$id)->first();
            $store = Lesson::find($id);
            $store->enable      = Input::get('enable');
            $store->title       = Input::get('title');
            $store->price       = Input::get('price');
            $store->category_id = Input::get('category_id');
            $store->image       = Input::get('image');
            $store->description = Input::get('description');
            $store->slug        = Input::get('slug');
            $store->meta_desc   = str_limit($pre, 150);
            $store->status      = Input::get('status');
            $store->updated_at  = new DateTime();
            $store->save();

            // if($check->status !== 1){
            //   if($store->status==1){
            //     $check_contri=Contributor::where('id',$store->contributor_id)->first();

            //     if(count($check_contri)>0){
            //       $contri = Contributor::find($store->contributor_id);
            //       $contri->points      = $check_contri->points + 10;
            //       $contri->updated_at  = new DateTime();
            //       $contri->save();

            //       DB::table('contributor_notif')->insert([
            //           'contributor_id'=> $check_contri->id,
            //           'category'=>'point',
            //           'title'   => 'Anda mendapatkan pemambahan 10 point',
            //           'notif'        => 'Anda mendapatkan pemambahan sebanyak 10 point karena '.$title.' berhasil dipublish',
            //           'status'        => 0,
            //           'created_at'    => new DateTime()
            //       ]);
            //       DB::table('contributor_notif')->insert([
            //           'contributor_id'=> $check_contri->id,
            //           'category'=>'publish',
            //           'title'   => 'Tutorial berhasil dipublish',
            //           'notif'        => $title.' berhasil dipublish/acc oleh admin',
            //           'status'        => 0,
            //           'created_at'    => new DateTime()
            //       ]);
            //     }

            //   }
            // }
            // if(Input::get('status')==3 and input::get('notes') !== ''){
            //   $store_revision= new Revision;
            //   $store_revision->lession_id =$id;
            //   $store_revision->notes=input::get('notes');
            //   $store_revision->status=0;
            //   $store->created_at  = new DateTime();
            //   $store_revision->save();

            //   DB::table('contributor_notif')->insert([
            //       'contributor_id'=> $store->contributor_id,
            //       'category'=>'rivisi',
            //       'title'   => 'Tutorial perlu rivisi',
            //       'notif'        => $title.' perlu direvisi agar dapat dipublish oleh admin.',
            //       'status'        => 0,
            //       'created_at'    => new DateTime()
            //   ]);
            // }
            // $revisi = Revision::where('lession_id',$id)->get();

            // if(count($revisi) > 0 ){
            //   $revisi_id= Input::get('revisi_id');
            //   $revisi_status= Input::get('revisi_status');

            //   if($revisi_id !==null){
            //     foreach ($revisi_id as $key => $revisiid) {
            //       $update_revision= Revision::find($revisiid);
            //       $update_revision->status=$revisi_status[$key];
            //       $update_revision->updated_at  = new DateTime();
            //       $update_revision->save();
            //     }
            //   }
            // }
            // redirect
            return redirect('system/lessons')->with('success','Data successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Lesson::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }

}
