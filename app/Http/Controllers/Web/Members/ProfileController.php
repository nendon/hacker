<?php

namespace App\Http\Controllers\Web\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Validator;
use Redirect;
use App\Models\Member;
use App\Models\Invoice;
use App\Models\TutorialMember;
// use App\Models\Package;
use Session;
// use Hash;
use DateTime;
use DB;
use Auth;
use App\Models\Lesson;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      $members = Member::where('id',$mem_id)->first();
      if ($members) {
        return view('web.members.profile', [
          'members' => $members
        ]);
      }else {
        return redirect('/member/signin');
        exit;
      }
    }

    public function view($username)
    {
      // Authentication
      
      if (empty(Auth::guard('members')->user())) {
        return redirect('/member/signin')->with('error','Kamu Harus Login terlebih dahulu');
      }else{
        $mem_id = Auth::guard('members')->user()->id;
        $belitut = TutorialMember::join('lessons','lessons.id', 'tutorial_member.lesson_id')
                 ->join('members', 'members.id', 'tutorial_member.member_id')
                 ->where('username', $username)->get();  
        // dd($belitut);
      $members = Member::where('username',$username)->first();

         
      if ($members) {
        return view('web.members.view_profile', [
          'members' => $members,
          'lessons' => $belitut,
        ]);
      }else {
        return redirect('/member/signin');
        exit;
      }
    }
      }
      

    public function doSubmit()
    {
      // Authentication
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'full_name'      => 'required|min:3|max:255',
        // 'gender'         => 'required',
        'avatar'         => 'image|max:800',
        'bio'            => 'max:500',
      );

      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      } else {

        $now = new DateTime();
        $full_name = Input::get('full_name');
        $gender    = Input::get('gender');
        $avatar = Input::file('avatar');
        $born = Input::get('bornday');
        $lokasi = Input::get('lokasi');
        $skill = Input::get('keahlian');
        $instansi = Input::get('instansi');
        $public = Input::get('public');
        $bio = Input::get('bio');
        $role = Input::get('role');
        if($public == null){
          $public = 0;
        }
        $avatarDestinationPath= 'assets/source/member/avatar';

        if(!empty($avatar)){
            $avatarfilename    = $avatar->getClientOriginalName();
            $avatar->move($avatarDestinationPath, $avatarfilename);
        }else{
            $avatarfilename    = '';
        }
        if($avatarfilename ==''){
            $url_image= $avatarfilename;
        }else{
            $urls=url('');
            $url_image= $urls.'/assets/source/member/avatar/'.$avatarfilename;
        }

        $update = Member::findOrFail($mem_id);
        $update->full_name   = $full_name;
        $update->gender      = $gender;
        $update->tanggal_lahir= $born;
        if($url_image == null){
          $update->avatar = $update->avatar;
        }
        else{
            $update->avatar = $url_image;
        }
        $update->lokasi      = $lokasi;
        $update->keahlian      = $skill;
        $update->instansi      = $instansi;
        $update->public      = $public;
        $update->role      = $role;
        $update->bio      = $bio;
        $update->updated_at = $now;

        if ($update->save()) {
          return redirect()->back()->with('success','Profil Berhasil di ubah');
        }
      }
    }

    public function Riwayat(){
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }

      $get_hist = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.status', '2')
      ->where('B.harga_lesson', '<>', '0')
      ->orderBy('invoice.created_at', 'desc')
      ->distinct()
      ->select(['invoice.code as invoice' , 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status',  DB::raw('SUM(distinct invoice.price) as total'), DB::raw('SUM( B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code', 'invoice.type', 'invoice.created_at', 'invoice.status' )
      ->paginate(5);

      $get_tot = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.status','<>', '2')
      ->where('B.harga_lesson', '<>', '0')
      ->orderBy('invoice.created_at', 'desc')
      ->distinct()
      ->select(['invoice.code as invoice' , 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , 'invoice.status as status', DB::raw('SUM(distinct invoice.price) as total'),  DB::raw('SUM( B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code','invoice.type', 'invoice.created_at', 'invoice.status' )
      ->get();
       if(empty($get_tot)){
        $get_tot  = 0;
       }
       if(empty($get_hist)){
        $get_hist  = 0;
       }
      return view('web.members.riwayat', [
        'get_hist' => $get_hist,
        'get_tot' => $get_tot,
    ]);
    }

    public function Tambah($invoice){
      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }


    }
    public function download($inv){

      $mem_id = Auth::guard('members')->user()->id;
      if (!$mem_id) {
        return redirect('/member/signin');
        exit;
      }
      $get_hist = Invoice::join('invoice_details as B', 'invoice.id', '=', 'B.invoice_id')
      ->join('lessons as C', 'B.lesson_id', '=', 'C.id')
      ->join('members as D', 'invoice.members_id', '=', 'D.id')
      ->where('invoice.members_id', '=', $mem_id)
      ->where('invoice.code',$inv)
      ->orderBy('invoice.created_at', 'desc')
      ->distinct()
      ->select(['invoice.code as invoice' ,'D.username as user', DB::raw('SUM(distinct B.harga_lesson) as subtotal'), 'D.email as email', 'invoice.created_at as hari',  'invoice.type as type', 
      DB::raw('DATE_ADD(invoice.created_at, INTERVAL 23 HOUR) as batas') , DB::raw('SUM(distinct invoice.price) as total'), DB::raw('SUM( B.harga_lesson)-Sum(distinct invoice.price) as disc')])
      ->groupby('invoice.code', 'D.username', 'D.email', 'invoice.created_at', 'invoice.type', 'invoice.created_at' )
      ->get();

      return view('web.members.sertifikat.sertifikat',[
        'get_hist' => $get_hist,
      ]);


    }

}
