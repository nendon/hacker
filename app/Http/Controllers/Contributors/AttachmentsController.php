<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use DateTime;
use App\Models\File;
use App\Models\Lesson;
use Auth;

class AttachmentsController extends Controller
{
  public function create($lessonsid)
  {
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    $lesson= Lesson::where('id',$lessonsid)->first();

    if($lesson==null){
        return redirect('contributor/not-found');
    }
    if($lesson->status==2){
        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
    }
   
    $files=File::where('lesson_id',$lessonsid)->get();
    $count_files=count($files);

    # code...
    return view('contrib.attachments.create',[
        'lesson'=>$lesson,
        'count_files'=>$count_files
    ]);
  }
  public function doCreate($lessonsid)
  {
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
    # code...
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'judul'          => 'required',
      'files'    => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Auth::guard('contributors')->user()->id;
        $title        = Input::get('judul');
        $lessons_files = Input::file('files');
        $description  = Input::get('desc');

        $files=File::where('lesson_id',$lessonsid)->get();
        $count_files=count($files);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_files + 1;
        foreach ($title as $key => $titles) {
                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/files-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/files-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i;


                //insert files
                if(!empty($lessons_files[$key])){
                    $lessonsfilename    = $lessons_files[$key]->getClientOriginalName();
                    $lessons_files[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_files= $lessonsfilename;
                }else{
                    $urls=url('');
                    $url_files= $urls.'/assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i.'/'.$lessonsfilename;
                }


                $store                  = new File();
                $store->lesson_id      = $lessonsid;
                $store->title           = $titles;
                $store->source           = $url_files;
                $store->description     = $description[$key];
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','Penambahan lampiran berhasil');

    }
  }

  public function edit($lessonsid){
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
      $lesson= Lesson::where('id',$lessonsid)->first();

      if($lesson==null){
          return redirect('contributor/not-found');
      }
      if($lesson->status==2){
          return redirect('contributor/lessons/'.$lessonsid.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
      }
      $files=File::where('lesson_id',$lessonsid)->get();
      $count_files=count($files);

      # code...
      return view('contrib.attachments.edit',[
          'lesson'=>$lesson,
          'count_files'=>$count_files,
          'files'=>$files,
      ]);
  }

  public function doEdit($lessonsid)
  {
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
    # code...
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
      'judul'          => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    } else {

        $now          = new DateTime();
        $cid          = Auth::guard('contributors')->user()->id;
        $title        = Input::get('judul');

        $lessons_files = Input::file('files');
        $files_text        = Input::get('files_text');
        $description  = Input::get('desc');
        $delete= File::where('lesson_id',$lessonsid)->delete();
        $files=File::where('lesson_id',$lessonsid)->get();
        $count_files=count($files);


        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid);
        }

        $i=$count_files + 1;

        foreach ($title as $key => $titles) {
                if (!is_dir("assets/source/lessons/lessons-".$lessonsid."/files-".$i)) {
                        $newforder=mkdir("assets/source/lessons/lessons-".$lessonsid."/files-".$i);
                }
                $DestinationPath= 'assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i;


                //insert files
                if(!empty($lessons_files[$key])){
                    $lessonsfilename    = $lessons_files[$key]->getClientOriginalName();
                    $lessons_files[$key]->move($DestinationPath, $lessonsfilename);
                }else{
                    $lessonsfilename    = '';
                }
                if($lessonsfilename ==''){
                    $url_files= $files_text[$key];
                }else{
                    $urls=url('');
                    $url_files= $urls.'/assets/source/lessons/lessons-'.$lessonsid.'/files-'.$i.'/'.$lessonsfilename;
                }

                $store                  = new File();
                $store->lesson_id      = $lessonsid;
                $store->title           = $titles;
                $store->source           = $url_files;
                $store->description     = $description[$key];
                $store->created_at      = $now;
                $store->enable=1;
                $store->save();
        $i++;
        }

        // Session::set('lessons_title',$title);
        // Session::set('lessons_category_id',$category_id);
        // Session::set('lessons_image',$image);
        // Session::set('lessons_description',$description);

        return redirect('contributor/lessons/'.$lessonsid.'/view')->with('success','files berhasil update');

    }
  }
  public function delete($lessonsid, $id){
      $delete= File::where('lesson_id',$lessonsid)->where('id', $id)->delete();
      return redirect()->back()->with('success', 'Data successfully deleted');
  }
}
