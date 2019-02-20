<?php

namespace App\Http\Controllers\Web;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Lesson;
use App\Models\TutorialMember;
use DateTime;
use Session;
use Auth;
use App\Models\Rate;
use DB;
use App\Models\Cart;


class HomeController extends Controller {
	//

	public function index() {
		# code...
		$now = new DateTime();
		if(Auth::guard('members')->user()){
            $mem_id      = Auth::guard('members')->user()->id;
          }else{
            $mem_id      = 0;
        }
        
		$categories = Category::where('enable', '=', 1)->get();
		if(!empty($mem_id)){
            $lessons = Lesson::leftjoin('tutorial_member', function($join){
				$join->on('lessons.id', '=', 'tutorial_member.lesson_id')
				->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
				->leftjoin('cart', function($join){
				$join->on('lessons.id', '=', 'cart.lesson_id')
				->where('cart.member_id','=', Auth::guard('members')->user()->id);})
				->select('lessons.*', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
				->where('lessons.enable', 1)
				->where('lessons.status', 1)
				->orderBy('id','ASC')->get();
			$newlessons = Lesson::leftjoin('tutorial_member', function($join){
				$join->on('lessons.id', '=', 'tutorial_member.lesson_id')
				->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
				->leftjoin('cart', function($join){
				$join->on('lessons.id', '=', 'cart.lesson_id')
				->where('cart.member_id','=', Auth::guard('members')->user()->id);})
				->select('lessons.*', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
				->where('lessons.enable', 1)
				->where('lessons.status', 1)
				->orderBy('id','DESC')->get();
            }else{
				$newlessons = Lesson::where('enable', '=', 1)->where('status', 1)->orderBy('id','DESC')->get();
                $lessons = Lesson::where('enable', '=', 1)
				   ->where('status', 1)
				   ->orderBy('id','ASC')->get();
        }
		
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		$mem_id= Auth::guard("members")->user();
		// $tutorial = TutorialMember::where('member_id', $mem_id)->get();
		// $cart = Cart::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->get();
		// dd($lessons);		
		if(($mem_id) != null){

		$cekdulu = TutorialMember::where('member_id', Auth::guard("members")->user()->id)
		->where(DB::raw('DATEDIFF( now(),`created_at`)') , '>', 30)
		->orderby('created_at', 'asc')->first();

		$ratenow = Rate::select('id_member')
		->where('id_member', '=', Auth::guard("members")->user()->id)
    	->whereRaw('YEAR(created_at) = YEAR(now()) AND MONTH(created_at) = MONTH(now())')
    	->get();

		}else{
			$ratenow=[''];
			$cekdulu =[''];
		}
    	$now = new DateTime();
		$categories = Category::where('enable', '=', 1)->get();
		$newlessons = Lesson::where('enable', '=', 1)->where('status', 1)->orderBy('id','DESC')->get();
		if(!empty($mem_id)){
            $lessons = Lesson::leftjoin('tutorial_member', function($join){
				$join->on('lessons.id', '=', 'tutorial_member.lesson_id')
				->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
				->leftjoin('cart', function($join){
				$join->on('lessons.id', '=', 'cart.lesson_id')
				->where('cart.member_id','=', Auth::guard('members')->user()->id);})
				->select('lessons.*', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
				->where('lessons.enable', 1)
				->where('lessons.status', 1)
				->orderBy('id','ASC')->get();
				$newlessons = Lesson::leftjoin('tutorial_member', function($join){
					$join->on('lessons.id', '=', 'tutorial_member.lesson_id')
					->where('tutorial_member.member_id','=', Auth::guard('members')->user()->id);})
					->leftjoin('cart', function($join){
					$join->on('lessons.id', '=', 'cart.lesson_id')
					->where('cart.member_id','=', Auth::guard('members')->user()->id);})
					->select('lessons.*', 'tutorial_member.member_id as nilai', 'cart.member_id as hasil')
					->where('lessons.enable', 1)
					->where('lessons.status', 1)
					->orderBy('id','DESC')->get();
            }else{
				$newlessons = Lesson::where('enable', '=', 1)->where('status', 1)->orderBy('id','DESC')->get();
                $lessons = Lesson::where('enable', '=', 1)
				   ->where('status', 1)
				   ->orderBy('id','ASC')->get();
        }
		// $tutorial = TutorialMember::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->get();
		// $cart = Cart::where('member_id', $mem_id)->where('lesson_id', $lessons->id)->get();
		// dd($tutorial);
		$invoice = Invoice::where('status', '=', 1)->where('members_id', '=', $mem_id)->first();
		return view('web.home', [
			'categories' => $categories,
			'newlessons' => $newlessons,
			'lessons' => $lessons,
			'invoice' => $invoice,
			'mem_id' => $mem_id,
			// 'tutor' => $tutorial,
            // 'cart' => $cart,
			'ratenow' => $ratenow,
			'cekdulu' => $cekdulu,
			
		]);
	}
}