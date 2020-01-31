<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
use App\Models\Point;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
use Auth;
use App\Models\RewardCategory;
use App\Models\Reward;

// use DB;
class PointController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Authentication
        $mem_id = Auth::guard('members')->user()->id;
        if ($mem_id == null) {
            return redirect('/member/signin');
        }
        $members = Member::where('status', 1)->where('id', $mem_id)->first();
        if ($members) {
            $now = new DateTime;
            $date = date_format($now,'Y-m-d');
            $point_question = Point::where('type', 'QUESTION')->where('member_id', $mem_id)->sum('value');
            $point_reply = Point::where('type', 'REPLY')->where('member_id', $mem_id)->sum('value');
		    $reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->get();
		    $category =RewardCategory::where('enable',1)->get();
            $point_complete = Point::where('type', 'COMPLETE')->where('member_id', $mem_id)->sum('value');
            return view('web.members.point', [
                'members' => $members,
                'point_question' => $point_question,
                'point_reply' => $point_reply,
                'point_complete' => $point_complete,
                'reward'	=>$reward,
                'category'=>$category,
            ]);
        } else {
            return redirect('/member/signin');
            exit;
        }
    }

    public function change($id)
	{
		if (empty(Auth::guard('members')->user()->id)) {
			return redirect('member/signin');
		}

		# code...
		$memberID = Auth::guard('members')->user()->id;
		$now = new DateTime;
		$date = date_format($now,'Y-m-d');
		$reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
		$member= Member::where('id',$memberID)->first();
		if($member==null){
			return redirect('member/reward')->with('no-processing','Reward tidak ditemukan');
		}
		if($member->points < $reward->poin){
			return redirect('member/reward')->with('no-processing','Poin anda tidak mencukupi untuk reward ini!');
		}

		return view('web.members.change',[
			'reward'=>$reward
		]);

	}

	public function doChange($id)
	{
		if (empty(Auth::guard('members')->user()->id)) {
			return redirect('member/signin');
		}

		# code...
		$contribID = Auth::guard('members')->user()->id;
		$now = new DateTime;
		$date = date_format($now,'Y-m-d');
		$reward = Reward::where('enable',1)->where('end','>=',$date )->where('limit','>',0)->where('slug',$id)->first();
		$contrib= Contributor::where('id',$contribID)->first();
		if($reward==null){
			return redirect('member/reward')->with('no-processing','Reward tidak ditemukan');
		}
		if($contrib->points < $reward->poin){
			return redirect('member/reward')->with('no-processing','Poin anda tidak mencukupi untuk reward ini!');
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


	 return redirect('member/reward')->with('success','Point berhasil di tukar dengan reward ini!');
	}
}
