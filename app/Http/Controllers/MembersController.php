<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use DB;
use Validator;
use DateTime;
use App\Models\Member;
use App\Models\Package;
use App\Models\Invoice;
use App\Models\Service;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.members.index', [
            'members' => $members
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        return view('admin.members.create',[
          'packages'=>$packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
        'username'          => 'required|unique:members',
        'email'             => 'required|email|unique:members',
        'password'          => 'required|min:8',
        'retype_password'   => 'required|min:8|same:password',
        'services_packages' => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          $username           = Input::get('username');
          $email              = Input::get('email');
          $password           = Input::get('password');


          $services_status    = Input::get('services_status');
          $services_packages  = Input::get('services_packages');

          $now            = new DateTime();
          // store
          $members = new Member();
          $members->status       = 1;
          $members->username     = $username;
          $members->email        = $email;
          $members->password     = bcrypt($password);
          $members->created_at   = $now;
          $members->save();
            

          $packages = Package::where('id',$services_packages)->first();

          // ADD INVOICE
          $code           = $this->generateCode();

          // store
          $invoice = new Invoice;
          $invoice->status       = $services_status;
          $invoice->code         = $code;
          $invoice->members_id   = $members->id;
          $invoice->packages_id  = $packages->id;
          $invoice->price        = $packages->price;
          $invoice->created_at   = $now;
          $invoice->updated_at   = $now;
          $invoice->save();



          // ADD SERVICES

          $start    = date('Y-m-d');
          $expired  = date('Y-m-d', strtotime(' + '.$packages->expired.' days'));

          // store
          $services = new Service;
          $services->status       = $services_status;
          $services->members_id   = $members->id;
          $services->invoice_id   = $invoice->code;
          $services->title        = $packages->title;
          $services->price        = $packages->price;
          $services->start        = $start;
          $services->expired      = $expired;
          $services->access       = $packages->access;
          $services->update       = $packages->update;
          $services->chat         = $packages->chat;
          $services->download     = $packages->download;
          $services->created_at   = $now;
          $services->updated_at   = $now;
          $services->save();

          // redirect
          return redirect('system/members')->with('success','Succesfully created new data');
      }
    }

    public function addServices() //Add by ajax on edit page
    {

        $rules = array(
          'members_id'        => 'required',
          'services_status'   => 'required',
          'services_packages' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
          echo 0;
        } else {
            $now       = new DateTime();
            $members_id       = Input::get('members_id');
            $services_status  = Input::get('services_status');
            $services_packages= Input::get('services_packages');




            $packages = Package::where('id',$services_packages)->first();

            // ADD INVOICE
            $code           = $this->generateCode();

            // store
            $invoice = new Invoice;
            $invoice->status       = $services_status;
            $invoice->code         = $code;
            $invoice->members_id   = $members_id;
            $invoice->packages_id  = $packages->id;
            $invoice->price        = $packages->price;
            $invoice->created_at   = $now;
            $invoice->updated_at   = $now;
            $invoice->save();



            // ADD SERVICES

            $start    = date('Y-m-d');
            $expired  = date('Y-m-d', strtotime(' + '.$packages->expired.' days'));

            // reset service to expired
            DB::table('services')
            ->where('members_id','=',$invoice->members_id)
            ->update([
            'status'=> 2 //Expired
            ]);



            // store
            $services = new Service;
            $services->status       = $services_status;
            $services->members_id   = $members_id;
            $services->invoice_id   = $invoice->code;
            $services->title        = $packages->title;
            $services->price        = $packages->price;
            $services->start        = $start;
            $services->expired      = $expired;
            $services->access       = $packages->access;
            $services->update       = $packages->update;
            $services->chat         = $packages->chat;
            $services->download     = $packages->download;
            $services->created_at   = $now;
            $services->updated_at   = $now;
            $services->save();

            echo 1;


          }

    }
    private function generateCode()
    {
      $randomCode     = 'INV'.rand(000000,999999);
      // $randomCode = uniqid();
      $check = Invoice::where('code','=',$randomCode)->count();
      if($check > 0){
        $this->generateCode();
      }else{
        return $randomCode;
      }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members    = Member::find($id);
        $packages   = Package::all();

        return view('admin.members.edit',[
            'members'     => $members,
            'packages'    => $packages
        ]);
    }

    public function getServices()
    {
      $members_id     = Input::get('members_id');
      $services       = Service::where('members_id',$members_id)->orderBy('id','DESC')->get();

      $html = '';
      if (count($services) > 0) {

        foreach ($services as $key => $service) {
          $html .= '<tr>';
            $html .= '<td>'.$service->id.'</td>';
            if ($service->status == 0) {
              $html .= '<td><div class="label label-warning">Not Active</div></td>';
            }elseif ($service->status == 1) {
              $html .= '<td><div class="label label-success">Active</div></td>';
            }elseif ($service->status == 2) {
              $html .= '<td><div class="label label-danger">Expired</div></td>';
            }
            $html .= '<td>'.$service->invoice_id.'</td>';
            $html .= '<td>'.$service->title.'</td>';
            $html .= '<td>Rp '.$service->price.'</td>';
            $html .= '<td>'.$service->start.' - '.$service->expired.'</td>';
            $html .= '<td>'.$service->created_at.'</td>';
            $html .= '<td>'.$service->updated_at.'</td>';

            if ($service->status !== 2) {

          dd($password);
              $html .= '<td><button type="button" class="btn bg-pink waves-effect" onclick="openEdit('.$service->id.')">Edit</button></td>';
            }else {
              $html .= '<td><button type="button" class="btn bg-pink waves-effect " disabled onclick="disabledEdit()">Edit</button></td>';
            }
          $html .= '</tr>';
        }

      }else {
            $html .= '<td colspan="9">No Data Available</td>';
      }

      return $html;
    }

    public function getEditServices()
    {
        $services_id  = Input::get('services_id');
        $services     = Service::where('id',$services_id)->first();
        $invoice      = Invoice::where('code',$services->invoice_id)->first();
        $packages     = Package::all();

        $html = '';

        $html .= '<input type="hidden" name="edit_services_id" value="'.$services_id.'">';



        $html .= '<div class="form-group form-float">';
        $html .= '<div class="form-line">';
        $html .= '<select class="form-control show-tick" name="edit_services_status">';
        $html .= '<option value="">-- Please select --</option>';

        // option unpaid
        $html .= '<option value="0"';
        if ($services->status == 0) {
          $html .= 'selected';
        }
        $html .= '>Not Active</option>';


        // option active
        $html .= '<option value="1"';
        if ($services->status == 1) {
          $html .= 'selected';
        }
        $html .= '>Active</option>';


        // option Expired
        $html .= '<option value="2"';
        if ($services->status == 2) {
          $html .= 'selected';
        }
        $html .= '>Expired</option>';


        $html .= '</select>';
        $html .= '<label class="form-label">Icon</label>';
        $html .= '</div>';
        $html .= '</div>';


        $html .= '<div class="form-group form-float">';
        $html .= '<div class="form-line">';
        $html .= '<select class="form-control show-tick" name="edit_services_packages">';
        $html .= '<option value="">-- Please select --</option>';
        foreach ($packages as $key => $package) {

          $html .= '<option value="'.$package->id.'"';
          if($invoice->packages_id == $package->id){
             $html .= 'selected';
          }
          $html .= '>'.$package->title  .'- Rp '.$package->price .'('.$package->expired.' days )</option>';

        }
        $html .= '</select>';
        $html .= '<label class="form-label">Icon</label>';
        $html .= '</div>';
        $html .= '</div>';


        return $html;

    }

    public function editServices()
    {

              $rules = array(
                'members_id'        => 'required',
                'services_id'       => 'required',
                'services_status'   => 'required',
                'services_packages' => 'required'
              );
              $validator = Validator::make(Input::all(), $rules);

              // process the login
              if ($validator->fails()) {
                echo 0;
              } else {
                  $now              = new DateTime();
                  $members_id       = Input::get('members_id');
                  $services_id      = Input::get('services_id');
                  $services_status  = Input::get('services_status');
                  $services_packages= Input::get('services_packages');




                  $packages = Package::where('id',$services_packages)->first();

              
                  $services = DB::table('services')->where('id','=',$services_id)->where('members_id','=',$members_id)->first();

                  DB::table('invoice')
                  ->where('code','=',$services->invoice_id)
                  ->where('members_id','=',$members_id)
                  ->update([
                    'status'        => $services_status,
                    // 'code'          => $packages->title ,
                    // 'members_id' => $packages->price ,
                    'packages_id'   => $packages->id ,
                    'price'         => $packages->price ,
                    'updated_at'    => $now
                  ]);






                  // ADD SERVICES

                  $start    = date('Y-m-d');
                  $expired  = date('Y-m-d', strtotime(' + '.$packages->expired.' days'));

                  // reset service to expired
                  DB::table('services')
                  ->where('id','=',$services_id)
                  ->where('members_id','=',$members_id)
                  ->update([
                    'status'    => $services_status,
                    'title'     => $packages->title ,
                    'price'     => $packages->price ,
                    'start'     => $start ,
                    'expired'   => $expired ,
                    'access'    => $packages->access ,
                    'update'    => $packages->update ,
                    'chat'      => $packages->chat ,
                    'download'  => $packages->download ,

                    'updated_at'=> $now
                  ]);



                  // store
                  // $services = new Service;
                  // $services->status       = $services_status;
                  // $services->members_id   = $members_id;
                  // $services->invoice_id   = $invoice->code;
                  // $services->title        = $packages->title;
                  // $services->price        = $packages->price;
                  // $services->start        = $start;
                  // $services->expired      = $expired;
                  // $services->access       = $packages->access;
                  // $services->update       = $packages->update;
                  // $services->chat         = $packages->chat;
                  // $services->download     = $packages->download;
                  // $services->created_at   = $now;
                  // $services->updated_at   = $now;
                  // $services->save();

                  echo 1;


                }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = array(
          'username'        => 'required|unique:members,username,'.$id,
          'email'           => 'required|unique:members,email,'.$id,
          'password'         => 'min:8|confirmed',
      );
      $validator = Validator::make(Input::all(), $rules);

      // process the login
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      } else {

          // Input
          $username       = Input::get('username');
          $email          = Input::get('email');
          $password       = Input::get('password'); 
          $now            = new DateTime();

          // get old password
          $members = Member::where('id',$id)->first();

          if (!empty('password') && !empty('retype_password')) {
            $password = $members->password;
          }else{
            $password = bcrypt(Input::get('password'));
          }

          // if (!empty(Input::get('password')) && !empty(Input::get('password_confirmation'))) {
          //     # new password
          //     $password = Input::get('password'); 
          // }else{
          //     # old Password
          //     $password = $members->password;
          // }
          // // dd($password);
          

          // store
          $store = Member::find($id);
          $store->status       = 1;
          $store->username     = $username;
          $store->email        = $email;
          $store->password     = bcrypt($password);
          $store->updated_at   = new DateTime();
          $store->save();
          // dd($store);
          // redirect
          return redirect('system/members')->with('success','Data successfully updated');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Member::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }
}
