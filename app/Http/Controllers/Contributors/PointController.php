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
use App\Models\Contributor;
use App\Models\Reward;
use App\Models\RewardCategory;
use App\Models\ContributorReward;
use Auth;

class PointController extends Controller
{
	public function index(){
		if (empty(Auth::guard('contributors')->user()->id)) {
			return redirect('contributor/login');
		}
		$uid = Auth::guard('contributors')->user()->id;
		$now = new DateTime;
    	$date = date_format($now,'Y-m-d');
		$contrib= Contributor::where('id',$uid)->first();
		$category =RewardCategory::where('enable',1)->get();
		$reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->get();
		$myreward = ContributorReward::join('reward','contributor_reward.reward_id','=','reward.id')
		  			->select('reward.*','contributor_reward.id as myid')
					->where('reward.end','>=',$date )->get();
		return view('contrib.point.reward',[
			'contrib'=>$contrib,
			'category'=>$category,
			'reward'	=>$reward,
			'myreward'=>$myreward,
		]);
	}
	public function detail($id){
		if (empty(Auth::guard('contributors')->user()->id)) {
			return redirect('contributor/login');
		}
		$uid = Auth::guard('contributors')->user()->id;
		$now = new DateTime;
        $date = date_format($now,'Y-m-d');
		$contrib= Contributor::where('id',$uid)->first();
		// $category =reward_category::where('enable',1)->get();
		$row = ContributorReward::join('reward','contributor_reward.reward_id','=','reward.id')
		  			->select('reward.*','contributor_reward.id as myid')
					->where('contributor_reward.id',$id)->first();
		// $row = ContributorReward::where('id',$id)->first();
		if ($row==null) {
			return redirect('contributor/reward')->with('no-processing','Reward tidak ditemukan');
		}
		return view('contrib.point.reward-detail',[
			'contrib'=>$contrib,
			'date_now'=>$date,
			// 'category'=>$category,
			'row'	=>$row,
		]);
	}

	public function point(){
		return view('contrib.point.point');
	}
	public function change($id)
	{
		if (empty(Auth::guard('contributors')->user()->id)) {
			return redirect('contributor/login');
		}

		# code...
		$contribID = Auth::guard('contributors')->user()->id;
		$now = new DateTime;
		$date = date_format($now,'Y-m-d');
		$reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
		$contrib= Contributor::where('id',$contribID)->first();
		if($reward==null){
			return redirect('contributor/reward')->with('no-processing','Reward tidak ditemukan');
		}
		if($contrib->points < $reward->poin){
			return redirect('contributor/reward')->with('no-processing','Poin anda tidak mencukupi untuk reward ini!');
		}

		return view('contrib.point.change',[
			'reward'=>$reward
		]);

	}

	public function doChange($id)
	{
		if (empty(Auth::guard('contributors')->user()->id)) {
			return redirect('contributor/login');
		}

		# code...
		$contribID = Auth::guard('contributors')->user()->id;
		$now = new DateTime;
		$date = date_format($now,'Y-m-d');
		$reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
		$contrib= Contributor::where('id',$contribID)->first();
		if($reward==null){
			return redirect('contributor/reward')->with('no-processing','Reward tidak ditemukan');
		}
		if($contrib->points < $reward->poin){
			return redirect('contributor/reward')->with('no-processing','Poin anda tidak mencukupi untuk reward ini!');
		}

		$store = new ContributorReward();
		$store->contributor_id  = $contribID;
		$store->reward_id  = $reward->id;
		// $store->code        = $reward->code;
		// $store->name        = $reward->name;
		// $store->value       = $reward->value;
		// $store->poin        = $reward->poin;
		// $store->start       = $reward->start;
		// $store->end         = $reward->end;
		// $store->category_id = $reward->category_id;
		// $store->description = $reward->description;
		// $store->content = $reward->content;
		// $store->url = $reward->url;
		// $store->type        = $reward->type;
		// $store->image        = $reward->image;
		$store->status      = 0;
		$store->created_at  = $now;
		$store->save();

		$poin_update = Contributor::find($contribID);
		$poin_update->points = $contrib->points - $reward->poin;
		// $poin_update->updated_at  = $now;
		$poin_update->save();

		$reward_update = Reward::find($reward->id);
		$reward_update->limit =$reward->limit - 1 ;
				// $poin_update->updated_at  = $now;
		$reward_update->save();


	 return redirect('contributor/reward')->with('success','Point berhasil di tukar dengan reward ini!');
	}
}
