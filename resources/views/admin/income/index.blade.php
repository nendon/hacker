@extends('admin.app')
@section('content')

<title>Pages - Cilsy</title>

 
<!-- JQuery DataTable Css -->
<link href="{{ asset('template/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Income
                <?php
                // $access = PERMISSION_CHECK('create');
                // if($access == true){?>

                <?php //} ?>
                <ol class="breadcrumb breadcrumb-col-pink pull-right">
                    <li><a href="{{ url('system/dashboard') }}">Dashboard</a></li>
                    <li class="active">Income</li>
                </ol>
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>

        </div>



        <!-- Result Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LIST
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <!-- <form action="{{ url('master/district/doprint') }}" method="post" target="_blank">
                            {{ csrf_field() }}
                            <input type="hidden" name="by" value="">
                            <input type="hidden" name="keyword" value="">
                            <button type="submit" class="btn bg-brown waves-effect">Print</button>
                        </form> -->
                        <!-- <a href="{{ url('system/pages/create') }}" class="btn bg-red waves-effect pull-right">Create</a> -->
                    </ul>
                </div>
                <div class="body">
                    <!-- will be used to show any messages -->


                    @include('admin.include.alert')

                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Status</th>
                                    <th>Contributor</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>
                                        <?php if ($row->status_paid == 0){ ?>
                                            <div class="label label-danger">Unpaid</div>
                                        <?php }else if ($row->status_paid == 1){ ?>
                                            <div class="label label-success">Paid</div>
                                        <?php } ?>
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>Rp. <?php echo number_format($row->price,0,",",".") ;?></td>
                                    <td>
                                        <form id="{{ $row->id }}" action="{{ url('system/income/'.$row->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <a href=""  data-toggle="modal" data-target="#quickModal{{$row->id}}" class="btn bg-pink waves-effect"><i class="material-icons">mode_edit</i></a>
                                                <!-- <button type="button" class="btn bg-pink waves-effect" onclick="if (confirm('Are you sure?')) { $('#{{$row->id}}').submit() }"><i class="material-icons">delete</i></button> -->
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Result Table -->
</div>
</section>


@foreach($data as $row)
<div class="modal fade" id="quickModal{{$row->id}}" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header" style="border: none;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Transfer </h4>
    </div>
    <div class="modal-body" style="border: none;height: 100%;">
    <form action="{{ url('system/income/'.$row->id)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="enable" value="1">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-group form-float">
              <div class="col-md-3">
                      <label class="form-label">Status Paid</label>
              </div>
              <div class="col-md-9">
                  <div class="form-line">
                      <select class="form-control show-tick" name="status_paid{{$row->id}}">
                          <option value="0" <?php if($row->status==0){
                            echo "selected";
                          }?>>Unpaid</option>
                          <option value="1"
                          <?php if($row->status==1){
                            echo "selected";
                          }?>>Paid</option>
                      </select>
                  </div>
              </div>
              <br> <br> <br>
              <div class="col-md-3">
                      <label class="form-label">Bank</label>
              </div>
              <div class="col-md-9">
                  <div class="form-line">
                      <select class="form-control show-tick" name="bankid{{$row->id}}">
                          <option value="">--Select Bank--</option>
                          @foreach($bank as $value)
                            @if($value->contributor_id == $row->id)
                                <option value="{{$value->id}}"<?php if($row->bank==$value->id){echo "selected";}?>>Bank: {{$value->bank}}  - Holder: {{$value->holder}} - No: {{$value->account_no}} </option>
                            @endif
                          @endforeach
                      </select>
                  </div>
              </div>
                <br> <br> <br>
              <div class="col-md-3">
                      <label class="form-label">Value</label>
              </div>
              <div class="col-md-9">
                  <div class="form-line">
                      <input type="text" name="nilaiid{{$row->id}}" class="form-control" id="title" value="{{ $row->price }}">
                  </div>
              </div>
                  <br> <br> <br>
              <div class="col-md-3">
                      <label class="form-label">NOTE</label>
              </div>
              <div class="col-md-9">
                  <div class="form-line">
                      <input type="text" name="noted{{$row->id}}" class="form-control" id="title" value="">
                  </div>
              </div>
                  <br> <br> <br>
                <div class="col-md-3">
                    <label class="form-label">Transfer Date</label>
                </div>
                <div class="col-md-9">
                  <div class="form-line">
                     <input type="date" name="date{{$row->id}}" value="{{$row->transfer_date}}" class="form-control">
                  </div>
                </div>
          </div>
          </div>
      </div>
    </div>
    <div class="modal-footer" style="border: none;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>

    </div>
  </form>
  </div>
</div>
</div>
@endforeach

<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('template/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<!-- <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script> -->
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('template/admin/js/admin.js') }}"></script>
<script src="{{ asset('template/admin/js/pages/tables/jquery-datatable.js') }}"></script>

@endsection
