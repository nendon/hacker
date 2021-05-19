<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contributor;
use App\Models\File;
use App\Models\Lesson;
use App\Models\Point;
use App\Models\Quiz;
use App\Models\Service;
use App\Models\Video;
use App\Models\Viewer;
use App\Models\TutorialMember;
use App\Models\Member;
use App\Models\Comment;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Notifications\UserCommentNotification;
use App\Notifications\UserReplyNotification;
use App\Notifications\NimbrungReplyNotification;
use Auth;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Mail\WaitingNotifMail;
use Illuminate\Support\Facades\Mail;

class LessonsController extends Controller
{

    public function index($by, $keyword)
    {
        $mem_id = isset(Auth::guard('members')->user()->id) ? Auth::guard('members')->user()->id : 0;

        $categories = Category::where('enable', 1)->get();
        // dd($categories);
        if ($by == 'category') {
            $category = Category::where('enable', 1)->where('title', 'like', '%' . $keyword . '%')->first();

            if(!empty($mem_id)){
            $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
            ->leftjoin('tutorial_member', function($join){
                $join->on('lessons.id', '=', 'tutorial_member.lesson_id')
                ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
            ->leftjoin('cart', function($join){
                $join->on('lessons.id', '=', 'cart.lesson_id')
                ->where('cart.member_id','=', Auth::guard('members')->user()->id);})
            ->select('lessons.*', 'categories.title as category_title', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
            ->where('lessons.enable', 1)
            ->where('lessons.status', 1)
            ->where('lessons.category_id', $category->id)
            ->paginate(10);
            // dd($results);
            }else{
                $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                ->select('lessons.*', 'categories.title as category_title')
                ->where('lessons.enable', 1)
                ->where('lessons.status', 1)
                ->where('lessons.category_id', $category->id)
                ->paginate(10); 
            }

        } else {
            if(!empty($mem_id)){
            $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                ->leftjoin('tutorial_member', function($join){
                    $join->on('lessons.id', '=', 'tutorial_member.lesson_id')
                    ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
                ->leftjoin('cart', function($join){
                    $join->on('lessons.id', '=', 'cart.lesson_id')
                    ->where('cart.member_id','=', Auth::guard('members')->user()->id);})
                ->select('lessons.*', 'categories.title as category_title', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
                ->where('lessons.enable', 1)
                ->where('lessons.status', 1)
                ->paginate(10);
            }else{
                $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                ->select('lessons.*', 'categories.title as category_title')
                ->where('lessons.enable', 1)
                ->where('lessons.status', 1)
                ->paginate(10);
            }
        }
        # code...
        // $tutorial = TutorialMember::Join('lessons', 'lessons.id', 'tutorial_member.lesson_id')
        // ->select('tutorial_member.lesson_id')
        // ->where('lessons.status', 1)
        // ->where('lessons.enable', 1)
        // ->where('tutorial_member.member_id' , $mem_id)
        // ->get();

        // dd($tutorial);
        return view('web.lessons.index', [
            'categories' => $categories,
            'results' => $results,    
            // 'invo' => $invo,
        ]);

    }
    public function getSearchcategory(Category $category){
        return $category->lesson()->select('id', 'title')->get();
    }

    public function preview($slug)
    {
        $mem_id = isset(Auth::guard('members')->user()->id) ? Auth::guard('members')->user()->id : 0;
                
        $now = new DateTime();

        $lessons = Lesson::where('enable', 1)->where('status', 1)->where('slug', $slug)->first();
        $cart = Cart::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->first();
        $categories = Category::where('id', $lessons->category_id)->first();
        $time = strtotime($lessons->created_at);
        $myFormatForView = date("d F y", $time);
        $tutorial = TutorialMember::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->first();
        if(($tutorial != null && $mem_id != null)){
            return redirect('kelas/v3/'.$slug);
        }
        // dd($cart);
        if (count($lessons) > 0) {
            $main_videos = Video::where('lessons_id', $lessons->id)->orderBy('position', 'asc')->get();
            $preview = Video::where('enable', 1)->where('lessons_id', $lessons->id)->orderBy('position', 'asc')->first();
            $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
            ->select('videos.*', 'viewers.video_id')
            ->where('viewers.member_id', $mem_id)
            ->where('videos.lessons_id', $lessons->id)->orderBy('viewers.updated_at', 'desc')->first();
            // dd($last_videos);
            $files = File::where('enable', 1)->where('lesson_id', $lessons->id)->orderBy('id', 'asc')->get();
            
            // Contributor
            $contributors = DB::table('contributors')
            ->leftJoin('profile', DB::raw('left(contributors.username, 1)'), '=', 'profile.huruf')
            ->where('contributors.id',$lessons->contributor_id)->first();  
            $contributors_total_lessons = Lesson::where('enable', 1)->where('status', 1)->where('contributor_id', $lessons->contributor_id)->with('videos.views')->get();
            $contributors_total_view = 0;
            foreach ($contributors_total_lessons as $lessonss) {
                foreach ($lessonss->videos as $videos) {
                    if ($videos->views) {
                        $contributors_total_view += 1;
                    }
                }
            }

            return view('web.lessons.preview', [
                'categories' => $categories,
                'lessons' => $lessons,
                'main_videos' => $main_videos,
                'last_videos' => $last_videos,
                'file' => $files,
                'tutor' => $tutorial,
                'cart' => $cart,
                'preview' => $preview,
                'tanggal' => $myFormatForView,
                'contributors' => $contributors,
                'contributors_total_lessons' => $contributors_total_lessons,
                'contributors_total_view' => $contributors_total_view,
            ]);
            // echo "syehbo";
        } else {
            abort(404);
        }
    }
    public function detail($slug)
    {
        
        $now = new DateTime();
        $mem_id = isset(Auth::guard('members')->user()->id) ? Auth::guard('members')->user()->id : 0;
        $lessons = Lesson::where('enable', 1)->where('status', 1)->where('slug', $slug)->first();
        $tutorial = TutorialMember::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->first();
        if(($tutorial == null)){
            return redirect('lessons/'.$slug);
        }
        $cart = Cart::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->first();
        $categories = Category::where('enable', 1)->get();
        // $invo = Invoice::with('members')->where('status', 2)->where('created_at', '<=', now()->subHours(4)->toDateTimeString())->get();
        // // dd($invo);
        // $from = date("Y-m-d H:i:s", strtotime("-4 hours"));
        // $to = date("Y-m-d H:i:s");
        // $invo = Invoice::with('members')->where('status', 2)->where('created_at', '<=', $from)->get();        
        // // dd($invo);
        // // // // $member = Member::where('id', $invo->members_id)->first();
        // // // // dd($member);
        // foreach($invo as $inv){
        //     dd($inv->members['email']);
        // }
        
        $invo = Invoice::Join('invoice_details', 'invoice_details.invoice_id', 'invoice.id')
                ->Join('lessons', 'lessons.id', 'invoice_details.lesson_id')
                ->select('invoice.code', 'invoice_details.lesson_id', 'lessons.title', 'invoice.status as status')
                ->where('lessons.id', $lessons->id)
                ->where('invoice.members_id', $mem_id)
                ->where('invoice.status','<>', '1')
                ->orderby('invoice.created_at', 'desc')
                ->first();
        // SELECT A.code, B.lesson_id, C.title , A.status as status FROM `invoice` A JOIN invoice_details B On A.id = B.invoice_id JOIN lessons C On B.lesson_id = C.id
        if (count($lessons) > 0) {
            $main_videos = Video::where('enable', 1)->where('lessons_id', $lessons->id)->orderBy('position', 'asc')->get();
            $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
            ->select('videos.*', 'viewers.video_id')
            ->where('viewers.member_id', '=', $mem_id)
            ->where('videos.lessons_id', '=', $lessons->id)->orderBy('viewers.updated_at', 'desc')->first();
            $files = File::where('enable', 1)->where('lesson_id', $lessons->id)->orderBy('id', 'asc')->get();
            // Contributor
            $contributors = DB::table('contributors')
            ->leftJoin('profile', DB::raw('left(contributors.username, 1)'), '=', 'profile.huruf')
            ->where('contributors.id',$lessons->contributor_id)->first();           
             $contributors_total_lessons = Lesson::where('enable', 1)->where('status', 1)->where('contributor_id', $lessons->contributor_id)->with('videos.views')->get();
            $contributors_total_view = 0;
            foreach ($contributors_total_lessons as $lessonss) {
                foreach ($lessonss->videos as $videos) {
                    if ($videos->views) {
                        $contributors_total_view += 1;
                    }
                }
            }


            return view('web.lessons.detail', [
                'categories' => $categories,
                'lessons' => $lessons,
                'main_videos' => $main_videos,
                'last_videos' => $last_videos,
                'file' => $files,
                'tutor' => $tutorial,
                'cart' => $cart,
                'invo' => $invo,
                // 'services' => $services,
                'contributors' => $contributors,
                'contributors_total_lessons' => $contributors_total_lessons,
                'contributors_total_view' => $contributors_total_view,
            ]);
            echo "syehbo";
        } else {
            abort(404);
        }
    }
    public function videoTracking()
    {
        if (Auth::guard('members')->user()) {
            $mem_id = Auth::guard('members')->user()->id;
        } else {
            $mem_id = 0;
        }
        $rules = array(
            'videosrc' => 'required|min:3|max:255',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $now = new DateTime();
            $ip_address = $this->getUserIP();
            $videosrc = Input::get('videosrc');
            $video = Video::where('video', 'like', '%' . $videosrc . '%')->first();
            if ($video) {
                $nilai =  Viewer::where('video_id',$video->id)->where('member_id',$mem_id)->first();

                $viewers  = Viewer::where('video_id',$video->id)->where('member_id',$mem_id)->first();
                    DB::table('viewers')
                    ->where('video_id', $video->id)
                    ->update(['updated_at' => $now ]);
				if (count($nilai)== 0 ){
					
				if ($viewers) { // Viewers exist

					$update = Viewer::find($viewers->id);
					$update->member_id 	= $mem_id;
					$update->hits 			= $viewers->hits + 1;
					$update->updated_at = $now;
					if ($update->save()) {
							return 'true';
                    }
                   
				}else { // Create new Viewers

					$store = new Viewer;
					$store->video_id 	= $video->id;
					$store->ip_address 	= $ip_address;
					$store->hits		= 1;
					$store->member_id 	= $mem_id;
					$store->created_at 	= $now;
					$store->updated_at 	= $now;
					if($store->save()){
						if($this->createCompletePoints($video->lessons_id,$mem_id)){
							return 'true';
						}
				}
            }
        }
    }
    }
    }
    private static function createCompletePoints($lessons_id, $mem_id)
    {
        // create points
        $now = new DateTime();
        $total_videos = Video::where('lessons_id', $lessons_id)->where('enable', 1)->orderBy('position', 'asc')->get();
        $total_viewing = 0;
        foreach ($total_videos as $key => $totv) {
            $view = Viewer::where('video_id', $totv->id)->where('member_id', $mem_id)->first();
            if ($view) {
                $total_viewing = $total_viewing + 1;
            }
        }
        if ($total_viewing >= count($total_videos)) {
            $point = new Point;
            $point->status = 0;
            $point->member_id = $mem_id;
            $point->type = 'COMPLETE';
            $point->value = 10;
            $point->created_at = $now;
            $point->updated_at = $now;
            if ($point->save()) {
                return true;
            }
        }
    }
    public function LessonsQuiz()
    {
        if (Auth::guard('members')->user()) {
            $mem_id = Auth::guard('members')->user()->id;
        } else {
            $mem_id = 0;
        }
        $rules = array(
            'videosrc' => 'required|min:3|max:255',
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // $now                 = new DateTime();
            //      $ip_address = $this->getUserIP();
            $videosrc = urldecode(Input::get('videosrc'));
            $vsrc = str_replace(url(''), '', $videosrc);
            $video = Video::where('video', 'like', '%' . $vsrc . '%')->first();
			$check = Quiz::where('video_id', $video->id)->first();
			
            if ($check) {
				$lesson = Lesson::find($check->lesson_id);
                return '/lessons/'.$lesson->slug.'/'.$check->slug;
            }
        }
    }
    private static function getUserIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }
    
    public function doComment(Request $request)
    {
        $response = array();
        if (empty(Auth::guard('members')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('members')->user()->id;
            // $body = Input::get('body');
            // $lesson_id = Input::get('lesson_id');
            $member = DB::table('members')->where('id', $uid)->first();
            
            // // dd($lesson_id);
            // $image = Input::file('image');
            // // dd($image);
            
            // $lessonsDestinationPath= 'assets/source/komentar';

            $input = $request->all();
            $lessons = DB::table('lessons')->where('id', $input['lesson_id'])->first();
            $parent_id = Input::get('parent_id');
            $contri = Lesson::where('id',$input['lesson_id'])
                      ->select('contributor_id')
                      ->first();
            $input['images'] = null;
            $input['member_id'] = $member->id;
            $input['contributor_id'] = str_replace('}','',str_replace('{"contributor_id":', '',$contri));
            $input['status'] = 0;
            // dd($input);

            if ($request->hasFile('image')){
                $input['images'] = '/assets/source/komentar/'.$request->image->getClientOriginalName();
                $input['file_name'] = $request->image->getClientOriginalName();
                $request->image->move(public_path('/assets/source/komentar'), $input['images']);
            }
            // dd($input);

            

            $store = Comment::create($input);
            // dd($store);
            if ($store) {
                Mail::to($member)->send(new WaitingNotifMail());
                $getmembercomment = DB::table('comments')
                ->where('comments.lesson_id',$input['lesson_id'])
                ->where('comments.status',0)
                ->select('comments.id as id')
                ->first();
    
                DB::table('contributor_notif')->insert([
                'contributor_id' => $lessons->contributor_id,
                'category' => 'Komentar',
                'title' => 'Anda mendapat pertanyaan dari ' . $member->username,
                'notif' => 'Anda mendapatkan pertanyaan dari ' . $member->username . ' pada ' . $lessons->title,
                'status' => 0,
                'slug' => $getmembercomment->id,
                'created_at' => $now,
            
            ]);
            $getemailchild = DB::table('comments')
                             ->Join('comments as B', 'comments.id', 'B.parent_id')
                             ->Join('members','members.id','=','B.member_id')
                             ->Where('B.parent_id', $input['parent_id'])
                             ->where('comments.member_id', '<>', 'B.member_id')
                             ->where('comments.member_id', '<>', 'B.contributor_id')
                             ->select('comments.member_id as tanya', 'B.member_id as jawab', 'members.username as username')->distinct()
                             ->get();
                            
            if($parent_id != null){
                foreach ($getemailchild as $mails) {
                    if( $mails->tanya !=$input['member_id'] ){
                        if($mails->tanya != $mails->jawab){
                    $getnotif = DB::table('user_notif')->insert([
                        'id_user' => $mails->tanya,
                        'category' => 'Komentar',
                        'title' => 'Pertanyaan anda mendapat balasan dari ' . $mails->username,
                        'notif' => 'Anda mendapatkan balasan dari ' . $mails->username . ' pada ' . $lessons->title,
                        'status' => 0,
                        'slug' => $lessons->slug,
                        'created_at' => $now,
                    ]);

                    $member = Member::Find($mails->tanya);
                    $lesson = Lesson::Find($lessons->id);
                    $contrib = Contributor::find($lessons->contributor_id);
                    $member->notify(new UserReplyNotification($member, $lesson, $contrib));
                   
                        }
                    }

                    if( $mails->jawab !=$input['member_id'] ){
                        if($mails->tanya != $mails->jawab){
                    $getnotif = DB::table('user_notif')->insert([
                        'id_user' => $mails->jawab,
                        'category' => 'Komentar',
                        'title' => 'Hello, Anda Nimbrung di komentar ini ada tanggapan dari ' . $mails->username,
                        'notif' => 'Anda mendapatkan balasan dari ' . $mails->username . ' pada ' . $lessons->title,
                        'status' => 0,
                        'slug' => $lessons->slug,
                        'created_at' => $now,
                    ]);

                    $member = Member::Find($mails->jawab);
                    $lesson = Lesson::Find($lessons->id);
                    $contrib = Contributor::find($lessons->contributor_id);
                    $member->notify(new NimbrungReplyNotification($member, $lesson, $contrib));
                   
                 
                        }
                    }
                //  Check type
                
                       
                   
                }
            }

           
            // dd($getmembercomment);
                // dd($uid);
            
                    $member = Member::Find($member->id);
                    $comment = Comment::Find($store->id);
                    $lesson = Lesson::find($lessons->id);
                    $contrib = Contributor::find($lessons->contributor_id);
                    $contrib->notify(new UserCommentNotification($member, $comment, $contrib, $lesson));
                    
                    // dd($contrib);
                // Create Point
                // if ($parent_id == 0) { // Berkomentar
                //     $point = new Point;
                //     $point->status = 0;
                //     $point->member_id = $uid;
                //     $point->type = 'QUESTION';
                //     $point->value = 2;
                //     $point->created_at = $now;
                //     $point->updated_at = $now;
                // } else { // Membalas Komentar
                //     $point = new Point;
                //     $point->status = 0;
                //     $point->member_id = $uid;
                //     $point->type = 'REPLY';
                //     $point->value = 3;
                //     $point->created_at = $now;
                //     $point->updated_at = $now;
                // }
                // if ($point->save()) {
                        // dd($getemailchild);
                    $response['success'] = true;
                // }
            }
        }
        echo json_encode($response);
    }
    public function getComments($lesson_id)
    {
        $comments = DB::table('comments')
        ->leftJoin('members', 'members.id', '=', 'comments.member_id')
        ->leftJoin('contributors','contributors.id','=','comments.contributor_id')
        ->leftJoin('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
        ->leftJoin('profile as B', DB::raw('left(contributors.username, 1)'), '=', 'B.huruf')
        ->select('comments.*', 'members.username as username', 'members.avatar as avatar', 'members.public', 'members.full_name', 'contributors.username as contriname', 'contributors.avatar as avatarc', 'profile.slug as slug', 'B.slug as slg')
        ->where('comments.parent_id', '=', 0)
        ->where('comments.lesson_id', '=', $lesson_id)
        ->orderBy('comments.id', 'DESC')
        ->get();

        $tutorial = TutorialMember::Join('lessons', 'lessons.id', 'tutorial_member.lesson_id')
        ->select('tutorial_member.lesson_id')
        ->where('lessons.status', 1)
        ->where('lessons.enable', 1)
        ->where('tutorial_member.member_id' , Auth::guard('members')->user()->id)
        ->where('tutorial_member.lesson_id', $lesson_id)
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
                                        $html .='<a href="'.url('member/profile/'.$usernam).'"><strong style="font-color:#2BA8E2;">' . $usernam . '</strong></a> <span class="text-muted"> ' . $this->time_elapsed_string($comment->created_at) . '</span>';
                                        }else{
                                        $html .='<strong>' . $usernam . '</strong> <span class="text-muted"> ' . $this->time_elapsed_string($comment->created_at) . '</span>';
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
                                                                <input type="hidden" name="lesson_id" value="' . $lesson_id . '">
                                                                <input type="hidden" name="parent_id" value="' . $comment->id . '"> 
    									                        <div class="form-group">
									                              <label>Komentar</label>
									                              <textarea name="name" rows="8" cols="80" class="form-control" name="body" id="textbody' . $comment->id . '"></textarea>
                                                                </div>
                                                                <input type="file" name="image" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
					<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                                                <button type="button" class="btn btn-primary pull-right" onClick="replyComment(' . $lesson_id . ',' . $comment->id . ')" >Tambah Jawaban</button>
                                                                </form>
									                          </div>
									                        </div>
									                      </div>
                                                        </div>';
                }
            }
            $html .= '</div><!-- /panel panel-default -->';
            $childcomments = DB::table('comments')
                ->leftJoin('members', 'members.id', '=', 'comments.member_id')
                ->leftJoin('contributors','contributors.id','=','comments.contributor_id')
                ->leftJoin('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
                ->leftJoin('profile as B', DB::raw('left(contributors.username, 1)'), '=', 'B.huruf')
                ->select('comments.*', 'members.username as username', 'members.public', 'members.full_name', 'members.avatar as avatar', 'contributors.username as contriname', 'contributors.avatar as avatarc', 'profile.slug as slug', 'B.slug as slg')
                ->where('comments.parent_id', '=', $comment->id)
                ->where('comments.lesson_id', '=', $lesson_id)
                ->orderBy('comments.id', 'asc')
                ->get();
            foreach ($childcomments as $key => $child) {
                $html .= '<!-- Comments Child -->
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
                                        $html .='<a href="'.url('member/profile/'.$userna).'"><strong>' . $userna . '</strong></a> <span class="text-muted"> ' . $this->time_elapsed_string($child->created_at) . '</span>';
                                        }else{
                                        $html .='<strong>' . $userna . '</strong> <span class="text-muted"> ' . $this->time_elapsed_string($child->created_at) . '</span>';
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
    private static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public function doComment_bak()
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return 0;
            exit();
        }
        $uid = Auth::guard('members')->user()->id;
        $member = DB::table('members')->where('id', $uid)->first();
        $comment = Input::get('comment');
        $lesson_id = Input::get('lesson_id');
        $lessons = DB::table('lessons')->where('id', $lesson_id)->first();
        $store = DB::table('comments')->insertGetId([
            'lesson_id' => $lesson_id,
            'member_id' => $uid,
            'description' => $comment,
            'parent' => 0,
            'status' => 0,
            'desc'   => 0,
            'created_at' => new DateTime(),
        ]);
        // if(count($check)==1){
        //     $check_contri=Contributor::where('id',$uid)->first();
        //     if(count($check_contri)>0){
        //       $contri = Contributor::find($uid);
        //       $contri->points      = $check_contri->points + 3;
        //       $contri->updated_at  = new DateTime();
        //       $contri->save();
        //
        //       DB::table('contributor_notif')->insert([
        //           'contributor_id'=> $uid,
        //           'category'=>'point',
        //           'title'   => 'Anda mendapatkan pemambahan 3 point',
        //           'notif'        => 'Anda mendapatkan pemambahan sebanyak 3 point karena  mereplay komentar dari '.$lessons->title.' ',
        //           'status'        => 0,
        //           'created_at'    => new DateTime()
        //       ]);
        //     }
        //
        // }
        if ($store) {
            DB::table('contributor_notif')->insert([
                'contributor_id' => $lessons->contributor_id,
                'category' => 'comments',
                'title' => 'Anda mendapat pertanyaan dari ' . $member->username,
                'notif' => 'Anda mendapatkan pertanyaan dari ' . $member->username . ' pada ' . $lessons->title,
                'status' => 0,
                'created_at' => new DateTime(),
            ]);
            $comment = DB::table('comments')
                ->leftJoin('members', 'members.id', '=', 'comments.member_id')
                ->select('comments.*', 'members.username as username')
                ->where('comments.id', $store)
                ->where('comments.parent', 0)
                ->where('comments.status', 0)
                ->orderBy('comments.created_at', 'DESC')
                ->first();
            echo '<div class="col-md-12" style="margin-bottom:30px;" id="row' . $comment->id . '">';
            echo '<img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">';
            if($comment->public == 1){
            echo '<a href="member/profile/'.$comment->username.'">	<strong>' . $comment->username . '</strong></a> pada <strong>' . date('d/m/Y', strtotime($comment->created_at)) . '</strong>';
            }else{
            echo '	<strong>' . $comment->username . '</strong> pada <strong>' . date('d/m/Y', strtotime($comment->created_at)) . '</strong>';
            }
            echo '	<strong style="color:#ff5e10;">';
            if ($comment->member_id !== null) {
                echo 'User';
            }
            if ($comment->contributor_id !== null) {
                echo 'Contributor';
            }
            echo '</strong>';
            echo '	<div class="col-md-12" style="margin-top:10px;padding-left:5%;">' . $comment->description . '</div>';
            echo '	<br><br>';
            $getchild = DB::table('coments')
                ->leftJoin('members', 'members.id', '=', 'coments.member_id')
                ->leftJoin('contributors', 'contributors.id', '=', 'coments.contributor_id')
                ->where('coments.lesson_id', $lessons->id)
                ->where('parent', $comment->id)
                ->orderBy('coments.created_at', 'ASC')
                ->select('coments.*', 'members.username as username', 'contributors.username as contriname')
                ->get();
            if (count($getchild) > 0) {
                foreach ($getchild as $child) {
                    echo '<div class="col-md-12" style="margin-top:10px;padding-left:7%;">';
                    echo '<img class="user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"height="40px" width="40px" style="object-fit:scale-down;border-radius: 100%;margin-bottom:10px;">';
                    echo '<strong>';
                    if (!empty($child->username)) {
                        echo '' . $child->username . '';
                    } else {
                        echo '' . $child->contriname . '';
                    }
                    echo '</strong> pada <strong>' . date('d/m/Y', strtotime($child->created_at)) . '</strong>';
                    echo '	<div class="col-md-12" style="margin-top:10px;margin-bottom:10px;padding-left:5%;">';
                    echo '' . $child->description . '';
                    echo '</div>';
                    echo '<div class="clearfix"></div>';
                    echo '</div>';
                }
            }
               
            echo '<div class="col-md-12" id="balas' . $comment->id . '" style="padding-top:10px; padding-left:0px; padding-right:0px;">';
            echo '<a href="javascript:void(0)" class="btn btn-info pull-right" onclick="formbalas(' . $comment->id . ')">Balas</a>';
            echo '	</div>';
            echo '</div>';
        } else {
            return null;
        }
    }
    public function postcomment()
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return 0;
            exit();
        }
        $uid = Auth::guard('members')->user()->id;
        $member = DB::table('members')->where('id', $uid)->first();
        $isi_balas = Input::get('isi_balas');
        $comment_id = Input::get('comment_id');
        $lesson_id = Input::get('lesson_id');
        $lessons = DB::table('lessons')->where('id', $lesson_id)->first();
        DB::table('comments')->insert([
            'lesson_id' => $lesson_id,
            'member_id' => $uid,
            'description' => $isi_balas,
            'parent' => $comment_id,
            'status' => 0,
            'desc'   => 0,
            'created_at' => new DateTime(),
        ]);
        $check = DB::table('coments')->where('parent', $comment_id)->get();
        // if(count($check)==1){
        //     $check_contri=Contributor::where('id',$uid)->first();
        //     if(count($check_contri)>0){
        //       $contri = Contributor::find($uid);
        //       $contri->points      = $check_contri->points + 3;
        //       $contri->updated_at  = new DateTime();
        //       $contri->save();
        //
        //       DB::table('contributor_notif')->insert([
        //           'contributor_id'=> $uid,
        //           'category'=>'point',
        //           'title'   => 'Anda mendapatkan pemambahan 3 point',
        //           'notif'        => 'Anda mendapatkan pemambahan sebanyak 3 point karena  mereplay komentar dari '.$lessons->title.' ',
        //           'status'        => 0,
        //           'created_at'    => new DateTime()
        //       ]);
        //     }
        //
        // }
        DB::table('contributor_notif')->insert([
            'contributor_id' => $lessons->contributor_id,
            'category' => 'coments',
            'title' => 'Anda kembali mendapat pertanyaan dari ' . $member->username,
            'notif' => 'Anda kembali mendapatkan pertanyaan dari ' . $member->username . ' pada ' . $lessons->title,
            'status' => 0,
            'created_at' => new DateTime(),
        ]);
        return 1;
    }
    public function getquizlist(Request $r)
    {
        $lesson_id = $r->input('lesson_id');
		$quiz = Quiz::select('title', 'slug', 'video_id')->where('lesson_id', $lesson_id)->get();
		
		return json_encode($quiz);
    }
    public function getplaylist()
    {
        $now = date('Y-m-d');
        $memberID = 0;
        if (Auth::guard('members')->user()) {
            $memberID = Auth::guard('members')->user()->id;
        }
		$lessons_id = Input::get('lessons_id');
		$lesson = Lesson::find($lessons_id);
        $videos = Video::where('enable', 1)->where('lessons_id', $lessons_id)->orderBy('position', 'asc')->get();
        
        $services = Service::where('status', 1)->where('members_id', $memberID)->where('expired', '>=', $now)->first();
        $tutorial = TutorialMember::where('member_id', $memberID)->where('lesson_id', $lessons_id)->first();
        // dd($tutorial);

        //last video
        $last_videos = Viewer::leftJoin('videos', 'videos.id', '=', 'viewers.video_id')
            ->select('videos.*', 'viewers.video_id')
            ->where('viewers.member_id', '=', $memberID)
            ->where('videos.lessons_id', '=', $lessons_id)->orderBy('viewers.updated_at', 'desc')->first();

        $access = 0;
        if (isset($services) && $services->access == 1) {
            $access = 1;
        }
        
        $play = array();
        foreach ($videos as $key => $video) {
            if ($key >= 3 && $tutorial == null && isset($video['video'])) {
                // Guest
                $play[] = array(
                    'name' => $video['title'],
                    'description' => strip_tags($video['description']),
                    'duration' => 'duration',
                    'sources' => 'invalid',
                    'poster' => url('/template/web/img/video-lock.png'),
                    'thumbnail' => array([
                        'srcset' => url('/template/web/img/video-lock.png'),
                        'type' => 'image/png',
                        'media' => '(min-width: 400px;)',
                    ],
					[
						'src' => url('/template/web/img/video-lock.png'),
					]),
                );
            } else {
                if (isset($video['video'])) {
                    if(count($last_videos) != 0){
                       
                    $play[] = array(
                        'name' => $video['title'],
                        'description' => strip_tags($video['description']),
                        'duration' => $video['durasi'],
                        'sources' => array([
                            'src' => url($video['video']),
                            'type' => $video['type_video'],
                        ]),
                        'poster' => url($video['image']),
                        'thumbnail' => array([
                            'srcset' => url($video['image']),
                            'type' => 'image/png',
                            'media' => '(min-width: 400px;)',
                        ],
						[
							'src' => url($video['image']),
						]),
                    ); 
                    }else{
                        $play[] = array(
                            'name' => $video['title'],
                            'description' => strip_tags($video['description']),
                            'duration' => $video['durasi'],
                            'sources' => array([
                                'src' => url($video['video']),
                                'type' => $video['type_video'],
                            ]),
                            'poster' => url($video['image']),
                            'thumbnail' => array([
                                'srcset' => url($video['image']),
                                'type' => 'image/png',
                                'media' => '(min-width: 400px;)',
                            ],
                            [
                                'src' => url($video['image']),
                            ]),
                        ); 
                    }
                }
			}
			
        }
        return json_encode($play, JSON_UNESCAPED_SLASHES) . "\n";
        exit;
    }
}