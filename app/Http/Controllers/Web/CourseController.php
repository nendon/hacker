<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Bootcamp;
use App\Models\BootcampMember;
use App\Models\Section;
use App\Models\Member;
use App\Models\Contributor;

use App\Models\VideoSection;
use App\Models\ProjectSection;
use App\Models\ProjectUser;
use App\Models\History;
use App\Models\BootcampLampiran;
use DB;
use Auth;
use Datetime;
use App\Notifications\UserProject;
use App\Notifications\MemulaiCourse;
use App\Notifications\MenyelesaikanCourse;
use App\Notifications\MenyelesaikanBootcamp;
use App\Notifications\UserNotifProject;


class CourseController extends Controller
{
    public function courseSylabus($slug)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }

    	// $courses = DB::table('course')->first();
    	// $bcs = Bootcamp::where('bootcamp.id',$courses->bootcamp_id)->first();
        $bcs = Bootcamp::where('slug', $slug)->first();
        $courses = Course::where('bootcamp_id', $bcs->id)->first();
        $cs = DB::table('course')->where('bootcamp_id', $bcs->id)->get();
        $tutor = BootcampMember::where('bootcamp_id', $bcs->id)->where('member_id', Auth::guard('members')->user()->id)->first();
        $mulai = DB::table('course')->where('bootcamp_id', $bcs->id)->first();

        $now = new Datetime();
        
        $exp = BootcampMember::where('bootcamp_id', $bcs->id)
        ->where('member_id', Auth::guard('members')->user()->id)
        ->where('expired_at', '<', $now)
        ->first();
          

        if(!$tutor){
            return redirect('bootcamp/'.$bcs->slug);
        }
        $lampiran = BootcampLampiran::where('bootcamp_id', $bcs->id)->get();
        //penambahan fungsi untuk membantu pembagian deadline per course
        if(!$tutor->start_at){

        $update = BootcampMember::find($tutor->id);
        $update['start_at'] = $now;
        $update['target'] = $target->target;
        $update->save();
        $response['success'] = true;
        }

        if($tutor->expired_at){

        $exp = BootcampMember::where('bootcamp_id', $bcs->id)
               ->where('member_id', Auth::guard('members')->user()->id)
               ->where('expired_at', '<', $now)
               ->first();

        $awal = date_create();
        $akhir = date_create($tutor->expired_at);
        $diff = date_diff($awal, $akhir);
        $deadline = $diff->format('%d');
        }else{
            $exp = '';
            $deadline = '';
        }
                  
        return view('web.courses.CourseSylabus',[
            'course' => $courses,
            'bc' => $bcs,
            'cs' => $cs,
            'tutor' => $tutor,
            'mulai' => $mulai,
            'exp'  => $exp,
            'lampiran' =>$lampiran,
            'deadline' => $deadline ,
            
        ]);
    }
    public function courseLesson($slug, $id)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
        $bcs = Bootcamp::where('slug', $slug)->first();
        $courses = Course::where('id', $id)->first();
        $section = Section::with('video_section')->where('course_id', $courses->id)->get();
        $vsection = $section->first()->video_section->first();
        $cs = DB::table('section')->where('course_id', $courses->id)->get();

        $tutor = BootcampMember::where('bootcamp_id', $bcs->id)->where('member_id', Auth::guard('members')->user()->id)->first();
        $member = Auth::guard('members')->user()->id;
        //cek 404
        $cekdulu = DB::table('bootcamp')
        ->join('course', 'bootcamp.id', 'course.bootcamp_id')
        ->join('section', 'course.id', 'section.course_id')
        ->join('video_section', 'section.id','video_section.section_id')
        ->join('project_section', 'section.id', 'project_section.section_id')
        ->where('course.id', $courses->id)
        ->select('course.id as section', 'course.position as p_course')
        ->groupby('course.id', 'course.position' )
        ->first();

            if($cekdulu->p_course != 1){
               
                $nilai = Course::where('id', $courses->id-1)->first();
                $valid = DB::table('course')
                    ->join('section', 'course.id', 'section.course_id')
                    ->join('video_section', 'section.id','video_section.section_id')
                    ->join('project_section', 'section.id', 'project_section.section_id')
                    ->leftjoin('project_user', function($join){
                    $join->on('project_section.id', '=', 'project_user.project_section_id')
                    ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
                    ->where('project_user.status', '2');})
                    ->leftjoin('history', function($join){
                    $join->on('video_section.id', '=', 'history.video_id')
                    ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                    ->where('course.id', $nilai->id)
                    ->select('course.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
                    ->groupby('course.id')
                    ->first();
               
                
                if($valid->hasil != $valid->project){
                    return view('errors.peringatan',[
                        'bcs' => $bcs,
            
                    ]);
                }
    
            }

        if(!$tutor){
            return redirect('bootcamp/'.$bcs->slug);
        }
        $target = Course::where('bootcamp_id', $bcs->id)->select(DB::raw('sum(estimasi) as target'))->first();
        $now = new Datetime;
        if(!$tutor->start_at){

        $update = BootcampMember::find($tutor->id);
        $update['start_at'] = $now;
        $update['target'] = $target->target;
        $update->save();
        $response['success'] = true;
        
        }
         //penambahan email untuk pemberitahuan memulai belajar
        $members = Member::find($member);
        $bootcamp = Bootcamp::find($bcs->id ); 
        $member_boot = BootcampMember::find($tutor->id);
        $course = Course::find($courses->id);
       
        $now = new DateTime();
        $id_notif = $course->id;
        $type = 'course';
        $title = 'mulai';
        $notif = DB::table('notif_email')->where('member_id', $member)->where('id_notif',$course->id)->first(); 
        $history = DB::table('notif_email')
            ->where('title', '=', $title)
            ->where('member_id', '=', $member)
            ->where('id_notif', '=', $id_notif)
            ->where('type', '=', $type)
            ->select('*')
            ->get();
        if (!isset($history[0])) {
            $members->notify(new MemulaiCourse($members, $bootcamp, $member_boot, $course));
            DB::table('notif_email')->insert([
                'title' => $title,
                'member_id' => $member,
                'id_notif' => $id_notif,
                'type' => $type,
                'created_at' => $now
            ]);
        }

        if($tutor->expired_at){

        $exp = BootcampMember::where('bootcamp_id', $bcs->id)
               ->where('member_id', Auth::guard('members')->user()->id)
               ->where('expired_at', '<', $now)
               ->first();

        $awal = date_create();
        $akhir = date_create($tutor->expired_at);
        $diff = date_diff($awal, $akhir);
        $deadline = $diff->format('%d');
        }else{
            $exp = '';
            $deadline = '';
        }
        $project = DB::table('course')
                ->join('section', 'course.id', 'section.course_id')
                ->join('video_section', 'section.id','video_section.section_id')
                ->leftjoin('project_section', 'section.id', 'project_section.section_id')
                ->leftjoin('project_user', function($join){
                        $join->on('project_section.id', '=', 'project_user.project_section_id')
                ->where('project_user.member_id', '=', Auth::guard('members')->user()->id);})
                ->leftjoin('history', function($join){
                        $join->on('video_section.id', '=', 'history.video_id')
                ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                ->where('course.id', $id)
                ->select('course.id as course', DB::raw('count( DISTINCT video_section.id) as video'),  DB::raw('count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
                ->groupby('course.id')
                ->first();
        return view('web.courses.CourseLesson',[
            'course' => $courses,
            'bc' => $bcs,
            'cs' => $cs,
            'stn' => $section,
            'vsection' => $vsection,
            'exp' => $exp,
            'target' => $target,
            'tutor' => $tutor,
            'deadline' => $deadline ,
            'project' =>$project,
        ]);
    }
     public function videoPage($slug, $id)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
        $bcs = Bootcamp::where('slug', $slug)->first();
        $sect = Section::where('id', $id)->first();
        $courses = Course::where('id', $sect->course_id)->first();
        $section = Section::with('video_section')->where('course_id', $courses->id)->orderBy('position', 'asc')->get();
        $vsection = $section->first()->video_section->first();
        //tes total waktu video
        // $vsections = $section->first()->video_section->first()->where('section_id', $sect->id)->select(DB::raw('sum(durasi) as durasi'))->first();
        $psection = Section::with('project_section')->where('course_id', $courses->id)->get();
        $hist = History::where('section_id', $id)->orderby('created_at', 'desc')->first();

        //untuk penambahan history terakhir
        // if($hist){
        //     $vmateri = DB::table('video_section')->join('history', 'video_section.id', 'history.video_id')->where('history.section_id', $id)->orderby('history.created_at', 'desc')->select('video_section.*')->first();       
        // }else{
            $vmateri = DB::table('video_section')->where('section_id', $id)->orderby('position', 'asc')->first();
        // }
        $cekdulu = DB::table('bootcamp')
                        ->join('course', 'bootcamp.id', 'course.bootcamp_id')
                        ->join('section', 'course.id', 'section.course_id')
                        ->join('video_section', 'section.id','video_section.section_id')
                        ->join('project_section', 'section.id', 'project_section.section_id')
                        ->where('section.id', $sect->id)
                        ->select('section.id as section', 'section.position as position','course.position as p_course')
                        ->groupby('section.id', 'section.position','course.position' )
                        ->first();

        if($cekdulu->position != 1 || $cekdulu->p_course != 1){
        if($sect->position == 1 ){
        $nilai = Course::where('id', $courses->id-1)->first();
        $valid = DB::table('course')
            ->join('section', 'course.id', 'section.course_id')
            ->join('video_section', 'section.id','video_section.section_id')
            ->join('project_section', 'section.id', 'project_section.section_id')
            ->leftjoin('project_user', function($join){
            $join->on('project_section.id', '=', 'project_user.project_section_id')
            ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
            ->where('project_user.status', '2');})
            ->leftjoin('history', function($join){
            $join->on('video_section.id', '=', 'history.video_id')
            ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
            ->where('course.id', $nilai->id)
            ->select('course.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
            ->groupby('course.id')
            ->first();
        }else{
            $nilai = Section::where('id', $sect->id-1)->first();
            $valid = DB::table('course')
            ->join('section', 'course.id', 'section.course_id')
            ->join('video_section', 'section.id','video_section.section_id')
            ->join('project_section', 'section.id', 'project_section.section_id')
            ->leftjoin('project_user', function($join){
            $join->on('project_section.id', '=', 'project_user.project_section_id')
            ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
            ->where('project_user.status', '2');})
            ->leftjoin('history', function($join){
            $join->on('video_section.id', '=', 'history.video_id')
            ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
            ->where('section.id', $nilai->id)
            ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
            ->groupby('section.id')
            ->first();
        }
        
        if($valid->hasil != $valid->project){
            return view('errors.peringatan',[
                'bcs' => $bcs,
    
            ]);
        }

        }
        
        if($vsection == null){
            $vsection = $section->first();
        }
        $tutor = BootcampMember::where('bootcamp_id', $bcs->id)->where('member_id', Auth::guard('members')->user()->id)->first();

        if(!$tutor){
            return redirect('bootcamp/'.$bcs->slug);
        }
        $expired = BootcampMember::where('bootcamp_id', $bcs->id)->select(DB::raw('DATE_ADD( start_at, INTERVAL target day) as exp'))->first();
        return view('web.courses.VideoPage',[
            'course' => $courses,
            'bc' => $bcs,
            'stn' => $section,
            'psection' => $psection,
            'vsection' => $vsection,
            'vmateri' => $vmateri,

        ]);
    }
     public function projectSubmit($slug, $id)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
        $bcs = Bootcamp::where('slug', $slug)->first();
        $sect = Section::where('id', $id)->first();
        $section = Section::with('video_section')->where('course_id', $sect->course_id)->orderBy('position', 'asc')->get();
        $vsection = $section->first()->video_section->first();
        $psection = Section::with('project_section')->where('id', $id)->get();
        // $ps = ProjectSection::
        $sect = Section::where('id', $id)->first();
        $course = Course::where('id',$sect->course_id)->first();
        $member = Auth::guard('members')->user()->id;
        
        $project = ProjectSection::where('section_id', $id)->first();
        $projectUser = ProjectUser::where('project_section_id', $project->id)->where('member_id', Auth::guard('members')->user()->id)->orderby('created_at', 'desc')->first();
 
        $tutor = BootcampMember::where('bootcamp_id', $bcs->id)->where('member_id', Auth::guard('members')->user()->id)->first();

        $full_hist = DB::table('video_section')
        ->leftjoin('history', function($join){
          $join->on('video_section.id', '=', 'history.video_id')
          ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
        ->where('video_section.section_id',  $sect ->id)
        ->select(DB::raw('count(video_section.id) as target '), DB::raw('count(history.video_id) as hasil'))
        ->first();

        $cekdulu = DB::table('bootcamp')
        ->join('course', 'bootcamp.id', 'course.bootcamp_id')
        ->join('section', 'course.id', 'section.course_id')
        ->join('video_section', 'section.id','video_section.section_id')
        ->join('project_section', 'section.id', 'project_section.section_id')
        ->where('section.id', $sect->id)
        ->select('section.id as section', 'section.position as position','course.position as p_course')
        ->groupby('section.id', 'section.position','course.position' )
        ->first();

        if($cekdulu->position != 1 || $cekdulu->p_course != 1){
        if($sect->position == 1 ){
        $nilai = Course::where('id', $course->id-1)->first();
        $valid = DB::table('course')
        ->join('section', 'course.id', 'section.course_id')
        ->join('video_section', 'section.id','video_section.section_id')
        ->join('project_section', 'section.id', 'project_section.section_id')
        ->leftjoin('project_user', function($join){
        $join->on('project_section.id', '=', 'project_user.project_section_id')
        ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
        ->where('project_user.status', '2');})
        ->leftjoin('history', function($join){
        $join->on('video_section.id', '=', 'history.video_id')
        ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
        ->where('course.id', $nilai->id)
        ->select('course.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
        ->groupby('course.id')
        ->first();
        }else{
        $nilai = Section::where('id', $sect->id-1)->first();
        $valid = DB::table('course')
        ->join('section', 'course.id', 'section.course_id')
        ->join('video_section', 'section.id','video_section.section_id')
        ->join('project_section', 'section.id', 'project_section.section_id')
        ->leftjoin('project_user', function($join){
        $join->on('project_section.id', '=', 'project_user.project_section_id')
        ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
        ->where('project_user.status', '2');})
        ->leftjoin('history', function($join){
        $join->on('video_section.id', '=', 'history.video_id')
        ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
        ->where('section.id', $nilai->id)
        ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
        ->groupby('section.id')
        ->first();
        }

        if($valid->hasil != $valid->project){
            return view('errors.peringatan',[
                'bcs' => $bcs,
    
            ]);
        }

        }

        if(!$tutor){
            return redirect('bootcamp/'.$bcs->slug);
        }
        $members = Member::find($member);
        $bootcamp = Bootcamp::find($bcs->id ); 
        $member_boot = BootcampMember::find($tutor->id);
        $courses = Course::find($course->id);
               
       //penambahan email untuk menyelesaikan course belajar
       $project_course = DB::table('course')
            ->join('section', 'course.id', 'section.course_id')
            ->join('video_section', 'section.id','video_section.section_id')
            ->leftjoin('project_section', 'section.id', 'project_section.section_id')
            ->leftjoin('project_user', function($join){
                    $join->on('project_section.id', '=', 'project_user.project_section_id')
            ->where('project_user.member_id', '=', Auth::guard('members')->user()->id);})
            ->leftjoin('history', function($join){
                    $join->on('video_section.id', '=', 'history.video_id')
            ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
            ->where('course.id', $course->id)
            ->select('course.id as course', DB::raw('count( DISTINCT video_section.id) as video'),  DB::raw('count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
            ->groupby('course.id')
            ->first();
            $courseprog = number_format($project_course->hasil/($project_course->video + $project_course->project)*100);
        $now = new DateTime();
        $id_notif = $course->id;
        $type = 'course';
        $title = 'selesai';
        $notif = DB::table('notif_email')->where('member_id', $member)->where('id_notif',$course->id)->first(); 
        $history = DB::table('notif_email')
                ->where('title', '=', $title)
                ->where('member_id', '=', $member)
                ->where('id_notif', '=', $id_notif)
                ->where('type', '=', $type)
                ->select('*')
                ->get();
        if (!isset($history[0]) && $courseprog == 100) {
            $members->notify(new MenyelesaikanCourse($members, $bootcamp, $member_boot, $courses));
            DB::table('notif_email')->insert([
                'title' => $title,
                'member_id' => $member,
                'id_notif' => $id_notif,
                'type' => $type,
                'created_at' => $now
            ]);
        }
        
        $bootcamp_tot = Bootcamp::join('course', 'bootcamp.id', 'course.bootcamp_id')
            ->join('section', 'course.id', 'section.course_id')
            ->join('video_section', 'section.id','video_section.section_id')
            ->leftjoin('project_section', 'section.id', 'project_section.section_id')
            ->leftjoin('project_user', function($join){
            $join->on('project_section.id', '=', 'project_user.project_section_id')
            ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)                         
            ->where('project_user.status', '2');})
            ->leftjoin('history', function($join){
            $join->on('video_section.id', '=', 'history.video_id')
            ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
            ->where('bootcamp.id', $bcs->id)
            ->select(
            DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), 
            DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
            ->first();
            $persen_boot = 0;
            $persen_boot = number_format($bootcamp_tot->hasil / $bootcamp_tot->project*100); 
            if($persen_boot==100 && $tutor->selesai == null){
                $value = 1;
                $update = BootcampMember::find($tutor->id);
                $update['selesai'] = $value;
                $update->save();
                $response['success'] = true;
                $members->notify(new MenyelesaikanBootcamp($members, $bootcamp)); 
            } 

         return view('web.courses.ProjectSubmit',[

            'bc' => $bcs,
            'stn' => $section,
            'psection' => $psection,
            'vsection' => $vsection,
            'project' => $project,
            'sec' =>$sect,
            'course' =>$course ,
            'projectUser' => $projectUser,
            'hist' => $full_hist,

        ]);
    }

    public function saveProject(Request $request){
        $response = array();
        if (empty(Auth::guard('members')->user()->id)) {
            $response['success'] = false;
        } else {

            $now = new DateTime();
            $uid = Auth::guard('members')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();

            $input = new ProjectUser();
            $input['komentar_user'] = $request->input('body');
            $input['member_id'] = $uid;
            $input['status'] = 0;
            $input['project_section_id'] =  $request->input('project_id');
            if ($request->hasFile('file')){
                $input['file'] = '/assets/source/bootcamp/project-'.$request->input('project_id').'/'. $request->file('file')->getClientOriginalName();
                $request->file('file')->move(public_path('/assets/source/bootcamp/project-'.$request->input('project_id').'/'), $input['file']);
            }
            $input->save();
            $response['success'] = true;

            $member = Member::Find($uid);
            $cariuser = ProjectUser::where('komentar_user', $request->input('body'))->where('member_id',$uid)->where('status', 0)->first();
            $user = ProjectUser::Find($cariuser->id);
            $lesson = ProjectSection::Find($request->input('project_id'));
            $bc = Section::join('course', 'course.id', 'section.course_id')
                  ->join('bootcamp', 'bootcamp.id', 'course.bootcamp_id')
                  ->where('section.id', $lesson->section_id)->first();
            $bootcamp = Bootcamp::Find($bc->bootcamp_id ); 
            $contrib = Contributor::find($bc->contributor_id);
            $contrib->notify(new UserProject($member, $lesson, $user, $bootcamp, $contrib));
            $member->notify(new UserNotifProject($member,  $bootcamp, $lesson, $contrib));

        }
        echo json_encode($response);
    }

    public function saveHistory(Request $req)
    {
        $uid = Auth::guard('members')->user()->id;
        $params = $req->all();
        $now = new DateTime();

        // Check if user has history
        $history = DB::table('history')
            ->where('member_id', '=', $uid)
            ->where('section_id', '=', $params['section_id'])
            ->where('video_id', '=', $params['video_id'])
            ->select('*')
            ->get();

        // Insert if user doesn't have any history
        if (!isset($history[0])) {
            DB::table('history')->insert([
                'member_id' => $uid,
                'section_id' => $params['section_id'],
                'video_id' => $params['video_id'],
                'hist' => 1,
                'created_at' => $now
            ]);
        }
    }

}
