<?php
namespace App\Http\Controllers\Contributors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use Session;
use Hash;
use DateTime;
use DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Lesson;
use Auth;

class QuestionQuizController extends Controller
{

    public function create($quiz_id)
    {
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
      $quiz = Quiz::where('id',$quiz_id)->first();
      if(count($quiz) < 1){
        return redirect('not-found');
      }
      $lesson= Lesson::where('id',$quiz->lesson_id)->first();
      if($lesson->status==2){
          return redirect('contributor/lessons/'.$quiz->lesson_id.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
      }

      $question=Question::where('quiz_id',$quiz_id)->get();
      $count_question=count($question);

      return view('contrib.questions-quiz.create',[
          'quiz'=>$quiz,
          'count_question'=>$count_question,
      ]);
    }

    public function store(Request $request, $quiz_id){
      if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
      }
      //Store new Data
             $validator = Validator::make($request->all(), [
                 'question'            => 'required',
             ]);

             if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
             }
             $now                = new DateTime();
             $question           = Input::get('question');
             $questionid           = Input::get('questionid');

              $count=Question::where('id',$quiz_id)->count();
              $i=0;
              foreach ($question as $key => $questions) {
                $no =$i + 1 + $count;
                $store_question= new Question();
                $store_question->quiz_id =$quiz_id;
                $store_question->question =$questions;
                $store_question->question_no=$no;
                $store_question->created_at =$now;
                $store_question->save();
                $answer           = Input::get('answer'.$questionid[$key]);
                $i=$questionid[$key];

                $check=Question::where('quiz_id','=',$quiz_id)->orderBy('id','=','desc')->first();
                $j=0;
                foreach ($answer as $key => $a) {
                  $store_answer_a = new Answer();
                  $store_answer_a->question_id= $check->id;
                  $store_answer_a->type = $j;
                  $store_answer_a->answer = $a;
                  $question_key     = Input::get('question_key'.$i.'_'.$j);
                  if(!empty($question_key)){
                     $key_s=1;
                   }else{
                     $key_s=0;
                   }
                  $store_answer_a->answer_key = $key_s;
                  $store_answer_a->created_at = $now;
                  $store_answer_a->save();
                  $j++;
                }

                 $i++;
              }
              $checks=Quiz::where('id','=',$quiz_id)->first();

              return Redirect('contributor/lessons/'.$checks->lesson_id.'/view')->with('success','Terimakasih, Quiz berhasil di simpan');
      }

      public function edit($quiz_id){
          if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
          }
          $quiz = Quiz::where('id',$quiz_id)->first();
          if(count($quiz) < 1){
            return redirect('not-found');
          }
          $lesson= Lesson::where('id',$quiz->lesson_id)->first();
          if($lesson->status==2){
              return redirect('contributor/lessons/'.$quiz->lesson_id.'/view')->with('no-delete','Tutorial sedang / dalam verifikasi!');
          }
          $question = Question::where('quiz_id',$quiz_id)->get();
          $answer = Answer::all();
          $count_question=count($question);
          # code...
          return view('contrib.questions-quiz.edit',[
              'quiz'=>$quiz,
              'question'=>$question,
              'answer'=>$answer,
              'count_question'=>$count_question,
          ]);
      }

      public function update(Request $request, $quiz_id){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        //Store new Data

               $validator = Validator::make($request->all(), [
                   'question'            => 'required',
               ]);

               if ($validator->fails()) {
                   return redirect()->back()->withErrors($validator)->withInput();
               }
               $now                = new DateTime();
               $question           = Input::get('question');
               $questionid           = Input::get('questionid');

               //delete questin old
               $checkdata=Question::where('quiz_id',$quiz_id)->get();
                foreach ($checkdata as $key => $questions) {
                  DB::table('answers')->where('question_id',$questions->question_id)->delete();
                }
                DB::table('questions')->where('quiz_id',$quiz_id)->delete();

                $i=0;
                foreach ($question as $key => $questions) {
                  $no = $i + 1 ;
                  $store_question= new Question();
                  $store_question->quiz_id =$quiz_id;
                  $store_question->question =$questions;
                  $store_question->question_no=$no;
                  $store_question->created_at =$now;
                  $store_question->save();
                  $answer           = Input::get('answer'.$questionid[$key]);
                  $i=$questionid[$key];
                  $check=Question::where('quiz_id','=',$quiz_id)->orderBy('id','=','desc')->first();
                  $j=0;

                  foreach ($answer as $key => $a) {
                    $store_answer_a = new Answer();
                    $store_answer_a->question_id= $check->id;
                    $store_answer_a->type = $j;
                    $store_answer_a->answer = $a;
                    $question_key     = Input::get('question_key'.$i.'_'.$j);
                    if(!empty($question_key)){
                       $key_s=1;
                     }else{
                       $key_s=0;
                     }
                    $store_answer_a->answer_key = $key_s;
                    $store_answer_a->created_at = $now;
                    $store_answer_a->save();
                    $j++;
                  }

                   $i++;
                }
                $checks=Quiz::where('id','=',$quiz_id)->first();

                return Redirect('contributor/lessons/quiz/'.$quiz_id.'/view')->with('success','Terimakasih, Quiz berhasil di update');
        }
}
