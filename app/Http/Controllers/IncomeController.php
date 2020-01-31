<?php
namespace App\Http\Controllers;
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
use App\Models\Income;
// use App\Models\Service;
// use App\Models\Invoice;
// use App\Models\Member;
use App\Models\Contributor;
// use App\Models\Lesson;
// use App\Models\Lesson_detail;
use App\Models\IncomeDetail;
use App\Models\ContributorAccount;
use App\Models\IncomeTransfer;
class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
		$this->middleware('auth');
	}
    public function index()
    {
        $data= Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
                ->join('contributors','lessons.contributor_id','=','contributors.id')
                ->select('lessons.contributor_id as id',DB::raw('SUM(lessons.price)*70/100 as price'),'invoice_details.flag as status_paid','contributors.username as name')
                ->where('invoice_details.flag', '0') 
                ->groupby('lessons.contributor_id','invoice_details.flag','contributors.username')
                ->get();
        $bank= ContributorAccount::all();
        return view('admin.income.index',[
            'data' => $data,
            'bank' => $bank
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = array(

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $statusy        = Input::get('status_paid'.$id);
            $bankid         = Input::get('bankid'.$id);
            $date_transfer  = Input::get('date'.$id);
            $nilai          = Input::get('nilaiid'.$id);
            $noted          = Input::get('noted'.$id);

          

            $update = Income::where('contributor_id',$id)
                      ->where('flag', '0')->update(['flag'=> 1, 'updated_at' => $date_transfer]);

            $updates = DB::table('income_details')->insert([
                        ['contributor_id' =>  $id, 'status' => $statusy ,'transfer_date' => $date_transfer, 'total_income' => $nilai,
                        'bank' => $bankid, 'created_at' => $now,'updated_at' => $now]
                        ]);
            

            if(!empty($bankid)){
                $bank= ContributorAccount::where('id',$bankid)->first();
                $store = new IncomeTransfer();
                $store->detail_income_id = $id;
                $store->bank_transfer=$bank->id;
                $store->transfer_date =$date_transfer;
                $store->created_at= $now;
                $store->total_transfer = $nilai;
                $store->note = $noted;
                $store->save();

               
                // if($updates->statusy==1){
                 
                //   DB::table('contributor_notif')->insert([
                //       'contributor_id'=> $updates->contributor_id,
                //       'category'     =>'transfer',
                //       'title'        => 'fee sudah ditransfer oleh admin',
                //       'notif'        => 'fee '.$bulan.' '.$updates->year.' telah ditransfer oleh admin ke rekening '.$bank->bank.' anda',
                //       'status'       => 0,
                //       'created_at'   => new DateTime()
                //   ]);
                // }
            }


            return redirect()->back()->with('success','Data successfully updated');
        }
    }



}
