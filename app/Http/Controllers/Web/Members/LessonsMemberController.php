<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Viewer;
use App\Models\Video;
use App\Models\Member;
use App\Models\Service;
use App\Models\Category;
use App\Models\File;
use App\Models\LessonDetail;
use App\Models\LessonDetailView;
use App\Models\TutorialMember;
use DateTime;
use Session;
use DB;
use Auth;
use PDF;

class LessonsMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Auth::guard('members')->user()->id)) {
          return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
        }
        $mem_id = Auth::guard('members')->user()->id;

        $belitut = TutorialMember::join('lessons','lessons.id', '=', 'tutorial_member.lesson_id')
                        ->where('member_id', '=',  $mem_id)->get();

        $get_lessons = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           
                   
        $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.updated_at', 'desc')->first();
    
                
        $get_full = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->leftjoin('viewers', function($join){
                        $join->on('videos.id', '=', 'viewers.video_id')
                        ->where('viewers.member_id', '=', Auth::guard('members')->user()->id);})
                     ->select(DB::raw('count(distinct viewers.video_id) as id_count, count(distinct videos.id) as vid_id, lessons.title, lessons.image, lessons.id, lessons.slug'))
                     ->groupby('lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug')
                     ->having(DB::raw('count(distinct viewers.video_id)'), '=', DB::raw('count(distinct videos.id)'))                   
                     ->get();

       if(!empty($last_videos)){
       $last_lessons = Lesson::where('lessons.id', '=', $last_videos->lessons_id)->first();
       
       $get_hist = Viewer::join('videos', 'viewers.video_id', '=', 'videos.id')
       ->where('viewers.member_id', '=', $mem_id)
       ->where('videos.lessons_id', '=', $last_videos->lessons_id)->get();
       $get_videos = Video::where('videos.lessons_id', '=', $last_videos->lessons_id)->orderBy('position', 'asc')->get();
       $progress = count($get_hist)*100/count($get_videos);

       
       }else{
        $last_lessons = 0;
        $get_hist = 0; 
        $get_videos = 0; 
        $progress = 0;
        $get_full = 0;
       }
       
        return view('web.members.dashboard_tutorial', [
            'progress' => $progress,
            'last' => $last_lessons,
            'belitut' => $belitut,
            'lessons' => $get_lessons,
            'full' => $get_full,
            //  'videos' => $last_videos,
        ]);
    }

    // public function index()
    // {
    //     if (empty(Auth::guard('members')->user()->id)) {
    //       return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
    //     }
    //     $mem_id = Auth::guard('members')->user()->id;

    //     $belitut = TutorialMember::join('lessons','lessons.id', '=', 'tutorial_member.lesson_id')
    //     ->where('member_id', '=',  $mem_id)->get();

    //     $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
    //                  ->select('videos.*', 'viewers.*')
    //                  ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.updated_at', 'desc')->first();
    
    //                  if(empty($last_videos)){
    //                     $last_videos = [''];
    //                  }


    //     $last_lessons = Lesson::where('lessons.id', '=', $last_videos->lessons_id)->first();

    //     if(empty($last_lessons)){
    //         $last_lessons = [''];
    //      } 
    //     $get_lessons = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
    //                  ->join('viewers', 'videos.id', '=', 'viewers.video_id')
    //                  ->where('viewers.member_id', '=', $mem_id)
    //                  ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
    //                  ->distinct()
    //                  ->get(['viewers.member_id', 'lessons.*']);           
    //                  if(empty($get_lessons)){
    //                     $get_lessons = [''];
    //                  }
    //     $get_videos = Video::where('videos.lessons_id', '=', $last_videos->lessons_id)->get();
    //     // dd( count($watched_video));
    //     if(empty($get_videos)){
    //         $get_videos = [''];
    //      }

    //     $get_hist = Viewer::join('videos', 'viewers.video_id', '=', 'videos.id')
    //     ->where('viewers.member_id', '=', $mem_id)
    //     ->where('videos.lessons_id', '=', $last_videos->lessons_id)->get();

    //     if(empty($get_hist)){
    //         $get_hist = [''];
    //      }

    //     $progress = count($get_hist)*100/count($get_videos);
    //      if(empty($progress)){
    //         $progress = [''];
    //      } 
    //     // $get_full = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
    //     //              ->leftjoin('viewers', 'videos.id', '=', 'viewers.video_id', 'and', '`viewers`.`member_id`', '=', $mem_id)
    //     //              ->select('lessons.title', 'lessons.image')
    //     //              ->select(DB::raw('count(distinct viewers.video_id) as id_count, count(distinct videos.id) as vid_id, lessons.title, lessons.image, lessons.id, lessons.slug'))
    //     //             //  ->where('viewers.member_id', '=', $mem_id)
    //     //              ->groupby('lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug')
    //     //              ->having(DB::raw('count(distinct viewers.video_id)'), '=', DB::raw('count(distinct videos.id)'))                   
    //     //              ->get(['lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug']);
                    
    //     return view('web.members.dashboard_tutorial', [
    //          'progress' => $progress,
    //         'last' => $last_lessons,
    //         // 'lessons' => $get_lessons,
    //         // 'full' => $get_full,
    //         'belitut' => $belitut,
    //         //  'videos' => $last_videos,
    //     ]);
    // }

    public function detail($slug) {

        if (empty(Auth::guard('members')->user()->id)) {
          return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
        }
        $now = new DateTime();
        $mem_id = Auth::guard('members')->user()->id;

        $services = Service::where('status', '=', 1)->where('download', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>', $now)->first();
        $lessons = Lesson::where('enable', '=', 1)->where('status', '=', 1)->where('slug', '=', $slug)->first();
        $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
                     ->select('videos.*', 'viewers.*')
                     ->where('viewers.member_id', '=', $mem_id)->orderBy('viewers.updated_at', 'desc')->first();
        
        $last_lessons = Lesson::where('lessons.id', '=', $last_videos->lessons_id)->first();


        $get_lessons = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                     ->join('viewers', 'videos.id', '=', 'viewers.video_id')
                     ->where('viewers.member_id', '=', $mem_id)
                     ->orderBy('viewers.member_id', 'viewers.updated_at', 'asc')
                     ->distinct()
                     ->get(['viewers.member_id', 'lessons.*']);           

        $get_videos = Video::where('videos.lessons_id', '=', $last_videos->lessons_id)->orderBy('position', 'asc')->get();

        $get_full = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
                    ->leftjoin('viewers', 'videos.id', '=', 'viewers.video_id', 'and', '`viewers`.`member_id`', '=', $mem_id)
                    ->select('lessons.title', 'lessons.image')
                    ->select(DB::raw('count(distinct viewers.video_id) as id_count, count(distinct videos.id) as vid_id, lessons.title, lessons.image, lessons.id, lessons.slug'))
                //  ->where('viewers.member_id', '=', $mem_id)
                    ->groupby('lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug')
                    ->having(DB::raw('count(distinct viewers.video_id)'), '=', DB::raw('count(distinct videos.id)'))                   
                    ->get(['lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug']);

        $get_hist = Viewer::join('videos', 'viewers.video_id', '=', 'videos.id')
                    ->where('viewers.member_id', '=', $mem_id)
                    ->where('videos.lessons_id', '=', $last_videos->lessons_id)->get();
                    
        $progress = count($get_hist)*100/count($get_videos);
      if (count($lessons) > 0) {
                $main_videos = Video::where('enable', '=', 1)->where('lessons_id', '=', $lessons->id)->orderBy('position', 'asc')->get();
                $files = File::where('enable', '=', 1)->where('lesson_id', '=', $lessons->id)->orderBy('id', 'asc')->get();
            // Contributor
            $contributors = DB::table('contributors')
            ->leftJoin('profile', DB::raw('left(contributors.username, 1)'), '=', 'profile.huruf')
            ->where('contributors.id',$lessons->contributor_id)->first();
            $contributors_total_lessons = Lesson::where('enable', '=', 1)->where('contributor_id', '=', $lessons->contributor_id)->get();
            $contributors_total_view        = 2545;
      //
      //
            // foreach ($contributors_total_lessons as $key => $lesson) {
            //     $videos = Video::where('lessons_id',$lesson->id)->get();
            //     if ($videos) {
            //         foreach ($videos as $key => $video) {
            //             $viewers = Viewer::where('video_id', '=', $video->id)->first();
            //             if ($viewers) {
            //                 $contributors_total_view = $contributors_total_view + 1;
            //             }
            //         }
            //     }
            // }

            return view('web.lessons.dashboard_lesson', [
                'lessons' => $lessons,
                'main_videos' => $main_videos,
                'file' => $files,
                'services' => $services,
                'contributors' => $contributors,
                'contributors_total_lessons' => $contributors_total_lessons,
                'contributors_total_view' => $contributors_total_view,
                'progress' => $progress,
                'last' => $last_lessons,
                'full' => $get_full,
                'get' =>$get_videos,
                'hits' => $get_hist,
            ]);
        }else {
            abort(404);
        }
    }
    //Create sertifikat
    public function download($id){
      $user = Member::find($id);

      $pdf = PDF::loadView('web.members.sertifikat.sertifikat', compact('user'));
      $pdf->setPaper('A4', 'landscape');
      return $pdf->stream('sertifikat.pdf');

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
        //
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