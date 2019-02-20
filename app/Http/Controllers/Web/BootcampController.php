<?php
 
namespace App\Http\Controllers\web;
use Illuminate\Support\Facades\Input;
use App\Notifications\UserCommentNotification;
use App\Notifications\UserReplyNotification;
use App\Notifications\NimbrungReplyNotification;
use App\Mail\WaitingNotifMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Member;
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
use Validator;
class BootcampController extends Controller
{

	public function bootcamp($slug)
    {
        if (empty(Auth::guard('members')->user()->id)) {
            return redirect('member/signin')->with('error', 'Anda Harus Login terlebih dahulu!');
          }
    	$bc = Bootcamp::where('status', 1)->where('slug', $slug)->first();
    	$now = new DateTime();
    	$time = strtotime($bc->created_at);
        $myFormatForView = date("d F y", $time);
        $contributors = DB::table('contributors')->where('contributors.id',$bc->contributor_id)->first();

        return view('web.bootcamp.bootcamp',[
            'bca' => $bc,
            'contributors' => $contributors,
            'tanggal' => $myFormatForView,
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
                    ->where('member_id', $mem_id )
                    ->get(); 
          $belitut = TutorialMember::join('lessons','lessons.id', '=', 'tutorial_member.lesson_id')
                          ->join('contributors', 'contributors.id', '=', 'lessons.contributor_id')
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
         
        return view('web.courses.CourseDashboard',[
            'bootcamp' => $bootcamp,
            'progress' => $progress,
            'last' => $last_lessons,
            'belitut' => $belitut,
            'lessons' => $get_lessons,
            'full' => $get_full,
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
                    $member->notify(new UserReplyNotification($member, $lesson, $contrib));
                   
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
                    $member->notify(new NimbrungReplyNotification($member, $boot, $contrib));
                   
                 
                        }
                    }
                   
                }
            }
                    // $member = Member::Find($member->id);
                    // $comment = CommentBootcamp::Find($store->id);
                    // $bootcamp = Bootcamp::find($bootcamp->id);
                    // $contrib = Contributor::find($bootcamp->contributor_id);
                    // $contrib->notify(new UserCommentNotification($member, $comment, $contrib, $bootcamp));
                    
                    $response['success'] = true;
                // }
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
