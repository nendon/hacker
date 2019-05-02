<?php
 
namespace App\Http\Controllers\web;
use Illuminate\Support\Facades\Input;
use App\Notifications\UserCommentNotification;
use App\Notifications\UserReplyNotification;
use App\Notifications\NimbrungReplyNotification;
use App\Notifications\UserReplyBootcamp;
use App\Notifications\NimbrungReplyBootcamp;
use App\Notifications\UserCommentBootcamp;
use App\Mail\WaitingNotifMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\BootcampCategory;
use App\Models\Course;
use App\Models\Section;
use App\Models\Member;
use App\Models\Exercise;
use App\Models\BootcampMember;
use App\Models\Contributor;
use DateTime;
use DB;
use App\Models\CommentBootcamp;
use Auth;
use App\Models\Category;
use App\Models\File;
use App\Models\Lesson;
use App\Models\Point;
use App\Models\Quiz;
use App\Models\Service;
use App\Models\Video;
use App\Models\Viewer;
use App\Models\TutorialMember;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ProjectSection;
use App\Models\ProjectUser;
use App\Models\VideoSection;
use Validator;
class BootcampController extends Controller
{

	public function bootcamp($slug)
    {
        $mem_id = isset(Auth::guard('members')->user()->id) ? Auth::guard('members')->user()->id : 0;
        $bc = Bootcamp::where('status', 1)->where('slug', $slug)->with('contributor', 'course.section.video_section', 'course.section.project_section')->first();
        //menambahkan fungsi untuk memanggil kategori bootcamp
        $boot_cat = BootcampCategory::where('id',$bc->bootcamp_category_id)->first();
        //menambahkan fungsi untuk menjumlahkan total hari
        $target = Course::where('bootcamp_id', $bc->id)->select(DB::raw('sum(estimasi) as target'))->first();
        $durasi_bootcamp = Bootcamp::join('course', 'bootcamp.id', 'course.bootcamp_id')
          ->join('section', 'course.id', 'section.course_id')
          ->join('video_section', 'section.id','video_section.section_id')
          ->where('course.bootcamp_id', $bc->id)
          ->Select( DB::raw('sum(durasi) as durasi'))
          ->first();
        $project_bootcamp = Bootcamp::join('course', 'bootcamp.id', 'course.bootcamp_id')
          ->join('section', 'course.id', 'section.course_id')
          ->join('project_section', 'section.id','project_section.section_id')
          ->where('course.bootcamp_id', $bc->id)
          ->Select(DB::raw('count(section_id) as durasi'))
          ->first();
        $pg_bootcamp = Bootcamp::join('course', 'bootcamp.id', 'course.bootcamp_id')
          ->join('section', 'course.id', 'section.course_id')
          ->join('exercise', 'section.id','exercise.section_id')
          ->where('course.bootcamp_id', $bc->id)
          ->Select(DB::raw('count(section_id) as durasi'))
          ->first();  
        $cart = Cart::where('member_id', $mem_id )->where('bootcamp_id', $bc->id)->first();
        // $cs = Course::where('bootcamp_id', $bc->id)->first();
        // $courses = DB::table('course')->where('bootcamp_id', $bc->id)->get();
        $courses = Course::with('section.project_section', 'section.video_section')->where('bootcamp_id', $bc->id)->get();
        // $main_videos = Section::with('video_section')->where('course_id', $cs->id)->get();
        $main_course = Course::where('bootcamp_id', $bc->id)->get();
    	$now = new DateTime();
    	$time = strtotime($bc->created_at);
        $myFormatForView = date("d F y", $time);
        $contributors = DB::table('contributors')->where('contributors.id',$bc->contributor_id)->first();
        // dd($bc);
        $tutor = BootcampMember::where('bootcamp_id', $bc->id)->where('member_id', $mem_id)->first();

        return view('web.bootcamp.bootcamp',[
            'bca' => $bc,
            'butcat' => $boot_cat,
            'target' => $target,
            'contributors' => $contributors,
            'course' => $courses,
            'cart' => $cart,
            'tanggal' => $myFormatForView,
            'tutor' =>$tutor,
            'main_course' => $main_course,
            'project_bootcamp' => $project_bootcamp,
            'durasi_bootcamp' =>  $durasi_bootcamp,
            'pg_bootcamp' =>  $pg_bootcamp
        ]);
    }
    public function next(Request $request){
        $input = $request->all();
        $response = array();
        $video = VideoSection::where('id', Input::get('video_id'))->where('section_id',Input::get('section_id') )->first();
        $posisi = $video->position + 1; 
        $next = VideoSection::where('position', $posisi)->where('section_id', Input::get('section_id'))->first();
        $section = Section::where('id',Input::get('section_id') )->first();
        $course = Course::where('id', $section->course_id)->first();
        $bootcamp = Bootcamp::where('id', $course->bootcamp_id)->first();
        $exercise = Exercise::where('section_id',Input::get('section_id'))->first();

        $max =  VideoSection::where('section_id', Input::get('section_id'))->select(DB::raw('max(position) as max'))->first();
        if($max->max == $video->position){
            $response['end'] = true;
            if($exercise){
            $response['url'] =  '/bootcamp/'.$bootcamp->slug.'/exercise/'.$section->id;
            }else{
            $response['url'] =  '/bootcamp/'.$bootcamp->slug.'/projectSubmit/'.$section->id;
            }
             return json_encode($response);
         }else{
            $response['videoid'] = $next->id;
            $response['position'] = $next->position;
            $response['url'] = $next->file_video;
            $response['title'] = $next->title;
            $response['section'] = $next->section_id;
            $response['max']= $max->max;
            $response['end'] = false;
             //kode biasa 
         }
        
       

        
        echo json_encode($response);
    }
    public function projectView($id)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
        $project = ProjectSection::where('section_id', $id)->first();
        $projectUser = ProjectUser::where('project_section_id', $project->id)
                       ->where('member_id', Auth::guard('members')->user()->id)
                       ->where('status', '<>', '0')->get();
        $sect = Section::where('id', $id)->first();           
        $course = Course::where('id',$sect->course_id)->first();
        $bcs = Bootcamp::where('id', $course->bootcamp_id)->first();
        
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

        return view('web.courses.ProjectView',[
            'project' => $project,
            'projectUser' => $projectUser,
            'sect' => $sect,
            'course' => $course,
            'bcs' => $bcs,

        ]);
    }
    public function member()
    {
       
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
          
        $mem_id = Auth::guard('members')->user()->id;
        
        $bootcamp = BootcampMember::join('bootcamp','bootcamp.id', '=', 'bootcamp_member.bootcamp_id')
                    ->join('contributors', 'contributors.id', '=', 'bootcamp.contributor_id')
                    ->join('course', 'course.bootcamp_id', 'bootcamp.id')
                    ->join('section', 'section.course_id', 'course.id')
                    ->join('video_section', 'video_section.section_id', 'section.id')
                    ->join('project_section', 'project_section.section_id', 'section.id')
                    ->leftjoin('history', function($join){
                        $join->on('video_section.id', '=', 'history.video_id')
                        ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                    ->where('bootcamp_member.member_id', $mem_id )
                    ->select('bootcamp.id as id', 'bootcamp.cover as cover', 'bootcamp.slug as slug', 'contributors.avatar as avatar', 'contributors.username as username','bootcamp.title as title', DB::raw('count(history.id) as hasil'), DB::raw('count(video_section.id) as target'))
                    ->groupby('bootcamp.id', 'bootcamp.cover', 'contributors.avatar','bootcamp.slug', 'contributors.username','bootcamp.title')
                    ->get();  

        $full_boot = BootcampMember::join('bootcamp','bootcamp.id', '=', 'bootcamp_member.bootcamp_id')
                    ->join('contributors', 'contributors.id', '=', 'bootcamp.contributor_id')
                    ->join('course', 'course.bootcamp_id', 'bootcamp.id')
                    ->join('section', 'section.course_id', 'course.id')
                    ->join('video_section', 'video_section.section_id', 'section.id')
                    ->join('project_section', 'project_section.section_id', 'section.id')
                    ->leftjoin('history', function($join){
                        $join->on('video_section.id', '=', 'history.video_id')
                        ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                    ->where('bootcamp_member.member_id', $mem_id )
                    ->select('bootcamp.id as id', 'bootcamp.cover as cover', 'bootcamp.slug as slug','contributors.avatar as avatar', 'contributors.username as username','bootcamp.title as title', DB::raw('count(history.id) as hasil'), DB::raw('count(video_section.id) as target'))
                    ->groupby('bootcamp.id', 'bootcamp.cover', 'bootcamp.slug', 'contributors.avatar', 'contributors.username','bootcamp.title')
                    ->get();  
        
        $last = BootcampMember::join('bootcamp','bootcamp.id', '=', 'bootcamp_member.bootcamp_id')
                ->join('contributors', 'contributors.id', '=', 'bootcamp.contributor_id')
                ->join('course', 'course.bootcamp_id', 'bootcamp.id')
                ->join('section', 'section.course_id', 'course.id')
                ->join('video_section', 'video_section.section_id', 'section.id')
                ->join('project_section', 'project_section.section_id', 'section.id')
                ->join('history', 'video_section.id', '=', 'history.video_id')
                ->where('bootcamp_member.member_id', $mem_id )
                ->select('bootcamp.title as title', 'bootcamp.cover as cover', 'bootcamp.slug', 'course.id as id_course', 'course.title as course_title' )
                ->orderby('history.created_at', 'desc')
                ->first();       

        $last_course =   BootcampMember::join('bootcamp','bootcamp.id', '=', 'bootcamp_member.bootcamp_id')
                        ->join('contributors', 'contributors.id', '=', 'bootcamp.contributor_id')
                        ->join('course', 'course.bootcamp_id', 'bootcamp.id')
                        ->join('section', 'section.course_id', 'course.id')
                        ->join('video_section', 'video_section.section_id', 'section.id')
                        ->join('project_section', 'project_section.section_id', 'section.id')
                        ->leftjoin('history', function($join){
                            $join->on('video_section.id', '=', 'history.video_id')
                            ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                        ->where('bootcamp_member.member_id', $mem_id )->where('course.id', $last->id_course)
                        ->select('section.id as id', DB::raw('count(history.id) as hasil'), DB::raw('count(video_section.id) as target'))
                        ->groupby('section.id')
                        ->get();
                        
                        
        $belitut =  TutorialMember::join('lessons','lessons.id', '=', 'tutorial_member.lesson_id')
                    ->join('contributors', 'contributors.id', '=', 'lessons.contributor_id')
                    ->join('videos', 'lessons.id', '=', 'videos.lessons_id')
                    ->leftjoin('viewers', function($join){
                          $join->on('videos.id', '=', 'viewers.video_id')
                          ->where('viewers.member_id', '=', Auth::guard('members')->user()->id);})
                    ->select( DB::raw('count(distinct viewers.video_id) as hasil, count(distinct videos.id) as target'),'lessons.title as title', 'lessons.image as image', 'lessons.id as lesson_id', 'lessons.slug as slug', 'contributors.avatar as avatar', 'contributors.username as username')
                    ->where('tutorial_member.member_id', '=',  $mem_id)
                    ->groupby('lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug',  'contributors.avatar', 'contributors.username')
                    ->get();
  
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
                       ->select(DB::raw('count(distinct viewers.video_id) as id_count, count(distinct videos.id) as vid_id, lessons.title, lessons.image, lessons.id, lessons.slug as slug'))
                       ->groupby('lessons.title', 'lessons.image', 'lessons.id', 'lessons.slug')
                       ->having(DB::raw('count(distinct viewers.video_id)'), '=', DB::raw('count(distinct videos.id)'))                   
                       ->get();
         $tes = Lesson::join('videos', 'lessons.id', '=', 'videos.lessons_id')
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
         
        return view('web.courses.CourseDashboard',[
            'bootcamp' => $bootcamp,
            'progress' => $progress,
            'last' => $last_lessons,
            'belitut' => $belitut,
            'lessons' => $get_lessons,
            'full' => $get_full,
            'last_course' => $last_course,
            'full_boot' => $full_boot,
            'last' => $last,
            'tes' => $tes,
        ]);
    }
    public function doComment(Request $request)
    {
        $response = array();
        if (empty(Auth::guard('members')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('members')->user()->id;
            $member = DB::table('members')->where('id', $uid)->first();
           
            $input = $request->all();
            $bootcamp = DB::table('bootcamp')->where('id', $input['bootcamp_id'])->first();
            $parent_id = Input::get('parent_id');
            $contri = Bootcamp::where('id',$input['bootcamp_id'])
                      ->select('contributor_id')
                      ->first();
            $input['images'] = null;
            $input['member_id'] = $member->id;
            $input['contributor_id'] = str_replace('}','',str_replace('{"contributor_id":', '',$contri));
            $input['status'] = 0;

            if ($request->hasFile('image')){
                $input['images'] = '/assets/source/komentar/'.$request->image->getClientOriginalName();
                $input['file_name'] = $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/komentar'), $input['images']);
            }
            // dd($input);

            

            $store = CommentBootcamp::create($input);
            // dd($store);
            if ($store) {
                Mail::to($member)->send(new WaitingNotifMail());
                $getmembercomment = DB::table('comments_bootcamp')
                ->where('comments_bootcamp.bootcamp_id',$input['bootcamp_id'])
                ->where('comments_bootcamp.status',0)
                ->select('comments_bootcamp.id as id')
                ->first();
    
                DB::table('contributor_notif')->insert([
                'contributor_id' => $bootcamp->contributor_id,
                'category' => 'Komentar',
                'title' => 'Bootcamp Anda mendapat pertanyaan dari ' . $member->username,
                'notif' => 'Bootcamp Anda mendapatkan pertanyaan dari ' . $member->username . ' pada ' . $bootcamp->title,
                'status' => 0,
                'slug' => 'bootcamp/'.$getmembercomment->id,
                'created_at' => $now,
            
            ]);
            $getemailchild = DB::table('comments_bootcamp')
                             ->Join('comments_bootcamp as B', 'comments_bootcamp.id', 'B.parent_id')
                             ->Join('members','members.id','=','B.member_id')
                             ->Where('B.parent_id', $input['parent_id'])
                             ->where('comments_bootcamp.member_id', '<>', 'B.member_id')
                             ->where('comments_bootcamp.member_id', '<>', 'B.contributor_id')
                             ->select('comments_bootcamp.member_id as tanya', 'B.member_id as jawab', 'members.username as username')->distinct()
                             ->get();
                            
            if($parent_id != null){
                $member = Member::Find($member->id);
                $comment = CommentBootcamp::Find($store->id);
                $bootcamp = Bootcamp::find($bootcamp->id);
                $contrib = Contributor::find($bootcamp->contributor_id);
                $contrib->notify(new UserCommentBootcamp($member, $comment, $contrib, $bootcamp));

                foreach ($getemailchild as $mails) {
                    if( $mails->tanya !=$input['member_id'] ){
                        if($mails->tanya != $mails->jawab){
                    $getnotif = DB::table('user_notif')->insert([
                        'id_user' => $mails->tanya,
                        'category' => 'Komentar',
                        'title' => 'Dibootcamp Pertanyaan anda mendapat balasan dari ' . $mails->username,
                        'notif' => 'Dibootcamp Anda mendapatkan balasan dari ' . $mails->username . ' pada ' . $bootcamp->title,
                        'status' => 0,
                        'slug' => $bootcamp->slug,
                        'created_at' => $now,
                    ]);

                    $member = Member::Find($mails->tanya);
                    $bootcamp = Bootcamp::Find($bootcamp->id);
                    $contrib = Contributor::find($bootcamp->contributor_id);
                    $member->notify(new UserReplyBootcamp($member, $bootcamp, $contrib));
                    

                        }
                    }

                    if( $mails->jawab !=$input['member_id'] ){
                        if($mails->tanya != $mails->jawab){
                    $getnotif = DB::table('user_notif')->insert([
                        'id_user' => $mails->jawab,
                        'category' => 'Komentar',
                        'title' => 'Hello di bootcamp, Anda Nimbrung di komentar ini ada tanggapan dari ' . $mails->username,
                        'notif' => 'Dibootcamp Anda mendapatkan balasan dari ' . $mails->username . ' pada ' . $bootcamp->title,
                        'status' => 0,
                        'slug' => 'bootcamp/'.$bootcamp->slug,
                        'created_at' => $now,
                    ]);

                    $member = Member::Find($mails->jawab);
                    $boot = Bootcamp::Find($bootcamp->id);
                    $contrib = Contributor::find($bootcamp->contributor_id);
                    $member->notify(new NimbrungReplyBootcamp($member, $boot, $contrib));
                   
                 
                        }
                    }
                   
                }
            }else{
                    $member = Member::Find($member->id);
                    $comment = CommentBootcamp::Find($store->id);
                    $bootcamp = Bootcamp::find($bootcamp->id);
                    $contrib = Contributor::find($bootcamp->contributor_id);
                    $contrib->notify(new UserCommentBootcamp($member, $comment, $contrib, $bootcamp));
                    

                // }
            }
            $response['success'] = true;
         }
        }
        
        echo json_encode($response);
    }

    public function getComments($bootcamp_id)
    {
        $comments = DB::table('comments_bootcamp')
        ->leftJoin('members', 'members.id', '=', 'comments_bootcamp.member_id')
        ->leftJoin('contributors','contributors.id','=','comments_bootcamp.contributor_id')
        ->leftJoin('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
        ->leftJoin('profile as B', DB::raw('left(contributors.username, 1)'), '=', 'B.huruf')
        ->select('comments_bootcamp.*', 'members.username as username', 'members.avatar as avatar', 'members.public', 'members.full_name', 'contributors.username as contriname', 'contributors.avatar as avatarc', 'profile.slug as slug', 'B.slug as slg')
        ->where('comments_bootcamp.parent_id', '=', 0)
        ->where('comments_bootcamp.bootcamp_id', '=', $bootcamp_id)
        ->orderBy('comments_bootcamp.id', 'DESC')
        ->get();

        $tutorial = BootcampMember::Join('bootcamp', 'bootcamp.id', 'bootcamp_member.bootcamp_id')
        ->select('bootcamp_member.bootcamp_id')
        ->where('bootcamp.status', 1)
        ->where('bootcamp_member.member_id' , Auth::guard('members')->user()->id)
        ->where('bootcamp_member.bootcamp_id', $bootcamp_id)
        ->first();
        $html = '';
        $i = 1;
        foreach ($comments as $key => $comment) {
            $html .= '<div class="row">
				                <div class="col-sm-1">
                                                    ';
            if($comment->desc == 0)     {
                $ava = $comment->avatar;
                $usernam =  $comment->username;
            }else{
                $ava = $comment->avatarc;
                $usernam =  $comment->contriname;
            }        
            if ($ava != null) {
                $html .= '<img class="img-circle img-responsive" src="' . asset($comment->avatar) . '">';
            } else {
                if($comment->desc == 0){
                $html .= '<img class="img-circle img-responsive" src="'.asset($comment->slug).'">';
                }else{
                $html .= '<img class="img-circle img-responsive" src="'.asset($comment->slg).'">';  
                }
            }
            
            $html .= '</div><!-- /thumbnail -->
				                
				                <div class="col-sm-11">
				                  <div class="panel panel-default">
				                    <div class="panel-heading">';
                                    if($comment->public == 1){
                                        $html .='<a href="'.url('member/profile/'.$usernam).'"><strong style="font-color:#2BA8E2;">' . $usernam . '</strong></a> <span class="text-muted"> ' . $comment->created_at . '</span>';
                                        }else{
                                        $html .='<strong>' . $usernam . '</strong> <span class="text-muted"> ' . $comment->created_at . '</span>';
                                        }
				                        $html .='</div>
				                    <div class="panel-body" style="white-space:pre-line;">
				                      ' . $comment->body . '
                                    </div>';
                                    if($comment->images != null){
                                    $html .= '<a id="firstlink" data-gall="myGallery" class="venobox vbox-item" data-vbtype="iframe" href="'. asset($comment->images) .'"><i class="fa fa-paperclip"></i> Attachment</a>';
                                    }
                                    if (!empty(Auth::guard('members')->user()->id)) {
                                        if(count($tutorial) >0 ){
                                        $html .= '<div class="panel-footer reply-btn-area text-right">
									                        <button type="button" name="button" class="btn btn-primary" data-toggle="collapse" data-target="#reply' . $comment->id . '"><i class="glyphicon glyphicon-share-alt"></i> Jawab</button>
									                    </div>
									                    <div class="collapse" id="reply' . $comment->id . '">
									                      <div class="panel-footer ">
									                        <div class="row reply">
                                                              <div class="col-md-12">
                                                              <form id="form-comment" class="mb-25" enctype="multipart/form-data" method="POST">
                                                                <input type="hidden" name="_method" value="POST">
                                                                <input type="hidden" name="bootcamp_id" value="' . $bootcamp_id . '">
                                                                <input type="hidden" name="parent_id" value="' . $comment->id . '"> 
    									                        <div class="form-group">
									                              <label>Komentar</label>
									                              <textarea name="name" rows="8" cols="80" class="form-control" name="body" id="textbody' . $comment->id . '"></textarea>
                                                                </div>
                                                                <input type="file" name="image" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
					<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                                                <button type="button" class="btn btn-primary pull-right" onClick="replyComment(' . $bootcamp_id . ',' . $comment->id . ')" >Tambah Jawaban</button>
                                                                </form>
									                          </div>
									                        </div>
									                      </div>
                                                        </div>';
                }
            }
            $html .= '</div><!-- /panel panel-default -->';
            $childcomments = DB::table('comments_bootcamp')
                ->leftJoin('members', 'members.id', '=', 'comments_bootcamp.member_id')
                ->leftJoin('contributors','contributors.id','=','comments_bootcamp.contributor_id')
                ->leftJoin('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
                ->leftJoin('profile as B', DB::raw('left(contributors.username, 1)'), '=', 'B.huruf')
                ->select('comments_bootcamp.*', 'members.username as username', 'members.public', 'members.full_name', 'members.avatar as avatar', 'contributors.username as contriname', 'contributors.avatar as avatarc', 'profile.slug as slug', 'B.slug as slg')
                ->where('comments_bootcamp.parent_id', '=', $comment->id)
                ->where('comments_bootcamp.bootcamp_id', '=', $bootcamp_id)
                ->orderBy('comments_bootcamp.id', 'asc')
                ->get();
            foreach ($childcomments as $key => $child) {
                $html .= '<!-- comments_bootcamp Child -->
				                  <div class="row">
				                    <div class="col-sm-1">
                                    ';
                if($child->desc == 0){
                   $ava = $child->avatar;
                   $userna = $child->username;
                }else{
                    $ava = $child->avatarc;
                    $userna = $child->contriname;

                }                                     
                if ($ava) {
                    $html .= '<img class="img-circle img-responsive" src="' . asset($ava) . '">';
                } else {
                    if($child->desc == 0){
                    $html .= '<img class="img-circle img-responsive" src="'.asset($child->slug).'">';
                    }else{
                    $html .= '<img class="img-circle img-responsive" src="'.asset($child->slg).'">'; 
                    }
                }
                $html .= '</div><!-- /thumbnail -->
				                   <!-- /col-sm-1 -->
				                    <div class="col-sm-11">
				                      <div class="panel panel-default">
                                        <div class="panel-heading">';
                                        if($child->public == 1){
                                        $html .='<a href="'.url('member/profile/'.$userna).'"><strong>' . $userna . '</strong></a> <span class="text-muted"> ' .$child->created_at . '</span>';
                                        }else{
                                        $html .='<strong>' . $userna . '</strong> <span class="text-muted"> ' .$child->created_at . '</span>';
                                        }
				                        $html .='</div>
				                        <div class="panel-body" style="white-space: pre-line;">
                                          ' . $child->body . '
                                        </div><!-- /panel-body -->';
                                        if($child->images != null){
                                    $html .= '<a id="firstlink" data-gall="myGallery" class="venobox vbox-item" data-vbtype="iframe" href="'. asset($child->images) .'"><img src="'. asset($child->images) .'" alt="image alt" style="height:50px; width:50px; margin-left: 15px; margin-bottom: 20px;"/></a>';
                                        }
				                      $html .= '</div><!-- /panel panel-default -->
				                    </div><!-- /col-sm-5 -->
				                  </div><!-- ./row -->
				                  <!-- ./Comments Childs -->';
            }
            $html .= '</div><!-- /col-sm-5 -->
				              </div><!-- ./row -->';
            $i++;
        }
        echo $html;
    }

}
