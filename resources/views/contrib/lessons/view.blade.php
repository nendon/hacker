@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
    <!-- <a href="{{ url('contributor/lessons/create')}}" class="btn btn-danger pull-right">Hapus Tutorial</a> -->
    <form id="{{ $row->id }}" action="{{ url('contributor/lessons/'.$row->id.'/delete')}}" method="get">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="DELETE">
          <button type="button"  title="Hapus Tutorial" data-toggle="tooltip" class="btn btn-danger pull-right" data-toggle="tooltip" onclick="checkdelete({{$row->id}})">Hapus Tutorial</button>
    </form>
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
        <li>Tutorial</li>
    </ul>
    </div>
</div>
@endsection
@section('content')

<!-- BEGIN lESSON -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">

      <div class="box-content">
          @if($errors->all())
           <div class="alert\ alert-danger">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
               @foreach($errors->all() as $error)
               <?php echo $error."</br>";?>
               @endforeach
           </div>
           @endif
           @if(Session::has('success'))
               <div class="alert alert-success alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                   {{ Session::get('success') }}
               </div>
           @endif

          @if(Session::has('success-delete'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                {{ Session::get('success-delete') }}
            </div>
          @endif
          @if(Session::has('no-delete'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
                {{ Session::get('no-delete') }}
            </div>
          @endif
        <div class="row">
          <div class="col-md-3">
            <img src="{{$row->image}}" class="img-responsive" alt="Gambar Tutorial">
          </div>
          <div class="col-md-9">
            <!-- Title -->
            <div class="row">
              <div class="col-md-8">
                <h4>{{ $row->title }}</h4>
              </div>
              <div class="col-md-4 text-right">
                  <?php if ($row->status == 0): ?>
                    <div class="label label-warning">Draft</div>
                  <?php elseif($row->status == 1): ?>
                      <div class="label label-success">Publish</div>
                  <?php elseif($row->status == 2): ?>
                      <div class="label label-info">Proses</div>
                  <?php elseif($row->status == 3): ?>
                      <div class="label label-warning">Revisi</div>
                  <?php endif; ?>
                  <a href="{{url('contributor/lessons/'.$row->id.'/edit')}}" class="btn btn-danger">Edit</a>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Kategori</p>
              </div>
              <div class="col-md-9">
                <p>: {{ $row->category_title }}</p>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Deskripsi Tutorial</p>
              </div>
              <div class="col-md-9">
                <p>: <?php  echo nl2br($row->description);?></p>
              </div>
            </div>
            <!-- End Title -->
            <!-- price -->
            <div class="row">
              <div class="col-md-3">
                <p>Price</p>
              </div>
              <div class="col-md-9">
                <p>: Rp. {{ number_format($row->price, 0, ",", ".") }} </p>
              </div>
            </div>
            <!-- End price -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END lESSON -->

<!-- BEGIN VIDEO -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Video</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
              @if(count($video) > 0 )
                <a href="{{url('contributor/lessons/'.$row->id.'/edit/videos')}}" class="btn btn-danger"><i class="fa fa-file-video-o"></i> Edit & Tambah Video</a>
              @else
                <a href="{{url('contributor/lessons/'.$row->id.'/create/videos')}}" class="btn btn-info"> <i class="fa fa-file-video-o"></i> Tambah Video</a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="box-content">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            @if(count($video) == 0 )
                <tr>
                    <td colspan="3">Tidak Ada data</td>
                </tr>
            @endif
               <?php $i=1;?>
             @foreach($video as $value)
                @if($value->lessons_id==$row->id)
              <tr>
                <td width="25">{{ $i }}</td>
                <td>{{$value->title}}</td>
                <td>
                    
                </td>

              </tr>
              <?php $i++;?>
              @endif
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END VIDEO -->

<!-- BEGIN ATTCHMENT -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Lampiran</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
                @if(count($files) > 0 )
              <a href="{{url('contributor/lessons/'.$row->id.'/edit/attachments')}}" class="btn btn-danger">Edit</a>
              @endif
              <a href="{{url('contributor/lessons/'.$row->id.'/create/attachments')}}" class="btn btn-info">Tambah Lampiran</a>
            </div>
          </div>
        </div>
      </div>
      <div class="box-content">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @if(count($files) == 0 )
                    <tr>
                        <td colspan="3">Tidak Ada data</td>
                    </tr>
                @endif
                <?php $i=1;?>
              @foreach($files as $value)
                 @if($value->lesson_id==$row->id)
               <tr>
                 <td width="25">{{ $i }}</td>
                 <td>{{$value->title}}</td>
                 <td>   
                  <div class="btn-group" role="group" aria-label="Default button group">
                  <a href="{{ url('contributor/lessons/'.$row->id.'/delete/attachments/'.$value->id) }}" class="btn bg-pink waves-effect"><i class="fa fa-trash"></i></button>
                  </div>
                </td>
               </tr>
               <?php $i++;?>
               @endif
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@if(count($revisi) > 0)
<!-- BEGIN REVISION -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Revisi</h4>
            </div>
          </div>
          <div class="col-md-6">

          </div>
        </div>
      </div>
      <div class="box-content">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Note</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php $i = 1; ?>
                @foreach($revisi as $value)
                <tr>
                  <td>{{ $i }} <input type="hidden" name="revisi_id[]" id="revisi<?php echo $i; ?>" value="{{$value->id}}"></td>
                  <td><?php echo nl2br($value->notes);?></td>
                  <td width="20%">
                    <?php
                  if($value->status==2){
                      echo "Revisi Proses";
                   }elseif($value->status==3){
                      echo "Revisi Gagal";
                  }elseif ($value->status==1) {
                      echo "Revisi Berhasil";
                  }else{
                    echo "Perlu Revisi";
                  }

                     ?>
                    <!-- <select class="form-control show-tick" id="revisi_status<?php echo $i; ?>" name="revisi_status[]" onchange="chageRevisiSatus()">
                        <option value="">-- Please select --</option>
                        <option value="0"<?php if($value->status==0){echo "selected";} ?>>Pending</option>
                        <option value="2"<?php if($value->status==2){echo "selected";} ?>>Process</option>
                    </select> -->
                  </td>
                  <td>@if($value->status == 1)   <div class="label label-success">Acc</div> @else<a href="{{url('contributor/lessons/revision/'.$value->id.'/proccess')}}" class="btn btn-danger">Revisi</a> @endif</td>
                </tr>
                <?php $i++;?>
                @endforeach
              </tbody>
            </table>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- END revisi -->
@endif


<script>
 function checkdelete(id){

   swal({
     title: "Apakah kamu yakin?",
     text: "Anda tidak akan dapat memulihkan data ini!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Hapus Tutorial!",
     cancelButtonText: "Tidak, Batalkan!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {

       $('#'+id).submit();

       swal("Deleted!", "Data Anda telah dihapus.", "success");
     } else {
       swal("Cancelled", "Data Anda aman :)", "error");
     }
     });
 }
 function hapusfile(id){

   swal({
     title: "Apakah kamu yakin mau menghapus video ini?",
     text: "Anda tidak akan dapat memulihkan data ini!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Hapus Video",
     cancelButtonText: "Tidak, Batalkan!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {

       $('#'+id).submit();

       swal("Deleted!", "Data Anda telah dihapus.", "success");
     } else {
       swal("Cancelled", "Data Anda aman :)", "error");
     }
     });
 }
 </script>
@endsection()
