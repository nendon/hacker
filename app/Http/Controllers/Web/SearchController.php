<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\Cart;
use Auth;
// use App\Models\Member;
use App\Models\Lesson;
use App\Models\Category;
// use App\Models\Video;
// use App\Models\Service;
// use App\Models\File;
use DateTime;

use Session;
class SearchController extends Controller
{
  public function index(Request $request)
  {
    $c  = Input::get('category');
    $q  = Input::get('q');
    $mem_id = isset(Auth::guard('members')->user()->id) ? Auth::guard('members')->user()->id : 0;
    // dd($c);
    $categories = Category::where('enable','=',1)->get();
    
    if (!empty($c)) { //with Category

          $category = Category::where('enable','=',1)->where('title','like','%'.$c.'%')->first();
          if (count($category) > 0) { 
            $cateid = $category->id;
          }else {
            $cateid = 0;
          }
          if(!empty($mem_id ) && $request->id != null){

                    $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                    ->leftjoin('tutorial_member', function($join){
                    $join->on('lessons.id', '=', 'tutorial_member.lesson_id')
                    ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
                    ->leftjoin('cart', function($join){
                    $join->on('lessons.id', '=', 'cart.lesson_id')
                    ->where('cart.member_id','=', Auth::guard('members')->user()->id);})
                    ->select('lessons.*', 'categories.title as category_title', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
                    ->where('lessons.title','like','%'.$q.'%')
                    ->where('lessons.category_id','=',$c)
                    ->where('lessons.status', 1)
                    ->paginate(10);
                    }else{
                      $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                      ->select('lessons.*', 'categories.title as category_title')
                      ->where('lessons.enable', 1)
                      ->where('lessons.status', 1)
                      ->where('lessons.title','like','%'.$q.'%')
                      ->where('lessons.category_id','=',$c)
                      ->paginate(10);
                    // dd($c);

                    }
                    $results->withPath('search?category='.$c.'&q='.$q);

    }else { //Without Category
      if(!empty($mem_id)){
                      $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                      ->leftjoin('tutorial_member', function($join){
                          $join->on('lessons.id', '=', 'tutorial_member.lesson_id')
                          ->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
                      ->leftjoin('cart', function($join){
                          $join->on('lessons.id', '=', 'cart.lesson_id')
                          ->where('cart.member_id','=', Auth::guard('members')->user()->id);})
                      ->select('lessons.*', 'categories.title as category_title', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
                      ->where('lessons.enable','=',1)
                      ->where('lessons.title','like','%'.$q.'%')
                      ->where('lessons.status', 1)
                      ->paginate(10);
                      }else{
                      $results = Lesson::Join('categories', 'lessons.category_id', 'categories.id')
                      ->select('lessons.*', 'categories.title as category_title')
                      ->where('lessons.enable', 1)
                      ->where('lessons.status', 1)
                      ->where('lessons.title','like','%'.$q.'%')
                      // ->where('lessons.category_id','=',$request->id)
                      ->paginate(10);
                      }

                      // dd($results);
                      $results->withPath('search?&q='.$q);
    }


    return view('web.search.index',[
      'categories'  => $categories,
      'results'     => $results
    ]);
  }

  public function autocomplete(Request $request)
  {

    
      $keyword 			= Input::get('term');
      $category 			= Input::get('category');
      if($request->id != null){
  		    $lessons 	= Lesson::where('enable','=','1')->where('category_id', $request->id)->where('title','like','%'.$keyword.'%')->where('status', 1)->get();
      }
      else{
        $lessons 	= Lesson::where('enable','=','1')->where('title','like','%'.$keyword.'%')->get();
      }



  		$results = array();
  		foreach ($lessons as $key => $lesson) {
  			// if($av->ask->id_user == Sentry::getUser()->id){
  				// foreach ($pelajaran as $key => $pel) {
  					// if ($pel->id == $av->ask->id_pelajaran ) {
  						// if (!empty($keyword)) {
  						// 		if (strpos($av->ask->body, $keyword) !== false) {
  						// 			 array_push($results,['pelajaran'=> $pel->id ,'value'=>$av->ask->body,'label'=>$av->ask->body.' di '.$pel->title]);
  						// 		}
  						// }else{
  								 array_push($results,[
                    //  'pelajaran'=> $pel->id ,
                     'value'=>$lesson->title,
                     'slug' =>$lesson->slug,
                    //  'label'=>$av->ask->body.' di '.$pel->title
                   ]);
  						// }
  					// }
  				// }
  			// }
  		}

  		echo json_encode($results);

  }


}
