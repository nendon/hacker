<?php

namespace App\Http\Controllers\Web;

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



use App\Models\Contributor;
use App\Models\Lesson;
use App\Models\Video;
use App\Models\Viewer;

class ContributorsController extends Controller
{

  public function getProfile($username='')
  {
   
    $contributors = Contributor::where('username',$username)->first();

   
    if ($contributors) {
      $contri = DB::table('contributors')
      ->Join('profile', DB::raw('left(contributors.username, 1)'), '=', 'profile.huruf')
      ->where('contributors.id',$contributors->id)->first();
  
      $contributors_total_lessons = Lesson::where('enable', '=', 1)->where('status', 1)->where('contributor_id', '=', $contributors->id)->get();
      $contributors_lessons = Lesson::where('enable', '=', 1)->where('status', 1)->where('contributor_id', '=', $contributors->id)->paginate(12);
      $contributors_total_view 		= 0;
      foreach ($contributors_lessons as $key => $lesson) {
				$videos = Video::where('lessons_id',$lesson->id)->orderBy('position', 'asc')->get();
				if ($videos) {
					foreach ($videos as $key => $video) {
						$viewers = Viewer::where('video_id', '=', $video->id)->first();
						if ($viewers) {
							$contributors_total_view = $contributors_total_view + 1;
						}
					}
				}
			}
      return view('web.contributors.profile',[
          'contributors'              => $contributors,
          'contri'              => $contri,
          'contributors_lessons'      => $contributors_lessons,
          'contributors_total_view'   => $contributors_total_view,
          'contributors_total_lessons' => $contributors_total_lessons,
      ]);
    }else {
      abort(404);
    }
  }


}
