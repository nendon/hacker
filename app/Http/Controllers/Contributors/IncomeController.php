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
use App\Models\Service;
use App\Models\Invoice;
use App\Models\Member;
use App\Models\Contributor;
use App\Models\Lesson;
use App\Models\Lesson_detail;
use App\Models\IncomeDetail;
use App\Models\Income;
use App\Models\ContributorAccount;
use Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $date= new DateTime();
        $moth= $date->format('m');
        $year= $date->format('Y');

        $contribID = Auth::guard('contributors')->user()->id;
        $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
               ->select(DB::raw('SUM(harga_lesson)*70/100 as price'), 'flag','invoice_details.updated_at')
               ->where('lessons.contributor_id',$contribID)
               ->where('flag', '1')
               ->groupby('flag','invoice_details.updated_at')
               ->first();

        $income = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
                ->where('lessons.contributor_id',$contribID)
                ->where('flag', '0')->get();

        $srow= ContributorAccount::where('contributor_id',$contribID)->first();
        $rekening=ContributorAccount::where('contributor_id',$contribID)->get();
      return view('contrib.income.index', [
        'row'=>$row,
        'income'=>$income,
        'rekening'=>$rekening,
        'srow' =>$srow
      ]);
    }
    public function create(){

        return view('contrib.income.create', [
        ]);
    }
    public function doCreate()
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $contribID = Auth::guard('contributors')->user()->id;
      # code...
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'bank'          => 'required',
        'noreg'          => 'required',
        'name'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $now          = new DateTime();
          $bank         = Input::get('bank');
          $noreg        = Input::get('noreg');
          $name         = Input::get('name');

          $store                  = new ContributorAccount();
          $store->contributor_id  = $contribID;
          $store->account_no      = $noreg;
          $store->bank            = $bank;
          $store->holder          = $name;
          $store->created_at      = $now;
          $store->enable=1;
          $store->save();

          return redirect('contributor/income')->with('success','Penambahan rekening berhasil');

      }
    }

    public function edit($id){
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $contribID = Auth::guard('contributors')->user()->id;
        $row =ContributorAccount::where('contributor_id',$contribID)->where('id',$id)->first();
        if(count($row)==0){
            return Redirect('not-found');
        }
        return view('contrib.income.edit', [
            'row'=>$row,
        ]);
    }

    public function doEdit($id)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $contribID = Auth::guard('contributors')->user()->id;
      # code...
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'bank'          => 'required',
        'noreg'          => 'required',
        'name'          => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $now          = new DateTime();
          $bank         = Input::get('bank');
          $noreg        = Input::get('noreg');
          $name         = Input::get('name');

          $store                  = ContributorAccount::find($id);
          $store->contributor_id  = $contribID;
          $store->account_no      = $noreg;
          $store->bank            = $bank;
          $store->holder          = $name;
          $store->updated_at      = $now;
          $store->save();

          return redirect('contributor/income')->with('success','Penambahan rekening berhasil');

      }
    }

    public function view()
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $date= new DateTime();
        $moth= $date->format('m');
        $year= $date->format('Y');

        $contribID = Auth::guard('contributors')->user()->id;
        $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
               ->select(DB::raw('SUM(harga_lesson)*70/100 as price'), 'flag', 'lessons.title', 'invoice_details.updated_at')
               ->where('lessons.contributor_id',$contribID)
               ->where('flag', '1')
               ->groupby('flag', 'lessons.title' , 'updated_at')
               ->get();

      return view('contrib.income.view', [
        'row'=>$row,
      ]);
    }

    public function doDelete($id){

        if (empty(Auth::guard('contributors')->user()->id)) {
          return redirect('contributor/login');
        }
        $contribID = Auth::guard('contributors')->user()->id;
        $row =ContributorAccount::where('contributor_id',$contribID)->where('id',$id)->first();
        if(count($row)==0){
            return Redirect('not-found');
        }

      $i = ContributorAccount::where('contributor_id',$contribID)->where('id',$id)->delete();
      if($i > 0)
      {
        return redirect('contributor/income')->with('success-delete','Rekening berhasil di hapus');
      }else{
        return redirect()->back()->with('no-delete','Delete Rekening gagal!');
      }

    }
}
