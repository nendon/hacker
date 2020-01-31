<?php

namespace App\Http\Controllers\Contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Video;
use App\Models\Lesson;
use App\Models\Contributor;
use DateTime;
use Session;
use DB;
use Auth;

class QuizController extends Controller
{
  public function create($lessons_id)
  {
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    # code...

    $data = Lesson::where('contributor_id',Auth::guard('contributors')->user()->id)
    ->where('id',$lessons_id)
    ->first();
    if(empty($data)){
        return redirect('not-found');
    }
    if($data->status==2){
        return redirect('contributor/lessons/'.$lessons_id.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
    }

    $video= Video::where('lessons_id',$lessons_id)->orderBy('position', 'asc')->get();

    return view('contrib.quiz.create', [
      'lessons_id'=>$lessons_id,
      'video' =>$video,
    ]);
  }
  public function store_quiz(Request $request, $lessons_id){
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    $uid = Auth::guard('contributors')->user()->id;
    //Store new Data
           $validator = Validator::make($request->all(), [
               'title'            => 'required',
               'video'            => 'required',
               'desc'             =>'required',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }
           $now                = new DateTime();
           $title             = Input::get('title');
           $video              = Input::get('video');
           $desc             = Input::get('desc');
           $store = new Quiz();
           $store->lesson_id =$lessons_id;
           $store->title =$title;
           $store->slug =str_slug($title);
           $store->video_id =$video;
           $store->description =$desc;
           $store->created_at =$now;
           $store->save();

           //point contributor
           $check_contri=Lesson::join('contributors','lessons.contributor_id','=','contributors.id')
                        ->where('lessons.id',$lessons_id)->first();
           if(count($check_contri)>0){
             $contri = Contributor::find($check_contri->contributor_id);
             $contri->points      = $check_contri->points + 1;
             $contri->updated_at  = new DateTime();
             $contri->save();

             DB::table('contributor_notif')->insert([
                 'contributor_id'=> $uid,
                 'category'=>'point',
                 'title'   => 'Anda mendapatkan pemambahan 1 point',
                 'notif'        => 'Anda mendapatkan pemambahan sebanyak 1 point karena  mereplay membuat 1 buah kuis ',
                 'status'        => 0,
                 'created_at'    => new DateTime()
             ]);
           }


           return Redirect('contributor/lessons/quiz/'.$store->id.'/create/questions');
  }
  public function view($quiz_id){
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    $row=Quiz::where('quiz.id','=',$quiz_id)
    ->Join('videos','quiz.video_id','videos.id')
    ->select('quiz.*','videos.title as videos_title')
    ->first();
    if($row==null){
      return redirect()->back();
    }
    $lessons=Lesson::where('lessons.id',$row->lesson_id)->first();
    $question=Question::where('quiz_id',$row->id)->get();

    # code...
    return view('contrib.quiz.view', [
        'row'=>$row,
        'question'=>$question,
        'lessons'=>$lessons
    ]);
  }

  public function edit($quiz_id){
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    $row=Quiz::where('id','=',$quiz_id)->first();
    if($row==null){
     return redirect('not-found');
    }
    $lessons=Lesson::where('lessons.id',$row->lesson_id)->first();
    $question=Question::where('quiz_id',$row->id)->get();
    $video= Video::where('lessons_id',$row->lesson_id)->orderBy('position', 'asc')->get();
    # code...
    return view('contrib.quiz.edit', [
        'row'=>$row,
        'question'=>$question,
        'video'=>$video,
        'lessons'=>$lessons
    ]);
  }

  public function update_quiz(Request $request, $quiz_id){
    if (empty(Auth::guard('contributors')->user()->id)) {
      return redirect('contributor/login');
    }
    //Store new Data
           $validator = Validator::make($request->all(), [
               'title'            => 'required',
               'video'            => 'required',
               'desc'             =>'required',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }

           $now                = new DateTime();
           $title             = Input::get('title');
           $video              = Input::get('video');
           $desc             = Input::get('desc');
           $store =  Quiz::find($quiz_id);
           $store->title =$title;
           $store->video_id =$video;
           $store->description =$desc;
           $store->updated_at =$now;
           $store->save();

           return Redirect('contributor/lessons/quiz/'.$quiz_id.'/view')->with('success','Quiz Berhasil di update');
  }

  public function delete_quiz($id){
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
       $data= DB::table('quiz')->where('id',$id)->first();
       $checkdata=Question::where('id',$id)->get();
        foreach ($checkdata as $key => $questions) {
          DB::table('answers')->where('question_id',$questions->question_id)->delete();
        }

        $i = DB::table('quiz')->where('id',$id)->delete();
        if($i > 0)
        {
          return redirect('contributor/lessons/'.$data->lesson_id.'/view')->with('success-delete','Quiz berhasil di hapus');
        }else{
          return redirect()->back()->with('no-delete','Delete tutorial gagal!');
        }

  }

}
