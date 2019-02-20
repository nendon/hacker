@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
    <form id="{{ $row->id }}" action="{{ url('contributor/lessons/quiz/'.$row->id.'/delete')}}" method="get">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="DELETE">
          <button type="button"  title="Hapus Quiz" data-toggle="tooltip" class="btn btn-danger pull-right" data-toggle="tooltip" onclick="checkdelete({{$row->id}})">Hapus Quiz</button>
    </form>
    <!-- <a href="{{ url('')}}" class="btn btn-danger pull-right">Hapus Quiz</a> -->
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
        <li><a href="{{ url('contributor/lessons/'.$row->lesson_id.'/view') }}">Kelola Quiz</a></li>
        <li>View Quiz</li>

		</ul>
</div>
@endsection
@section('content')

@if($errors->all())
 <div class="alert alert-danger">
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

<!-- BEGIN lESSON -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-content">
        <div class="row">
          <div class="col-md-12">
            <!-- Title -->
            <div class="row">
              <div class="col-md-8">
                <h4>{{ $row->title }}</h4>
              </div>
              <div class="col-md-4 text-right">
                  <a href="{{url('contributor/lessons/quiz/'.$row->id.'/edit')}}" class="btn btn-danger">Edit</a>
              </div>
            </div>
            <!-- End Title -->
            <!-- Title -->
            <div class="row">
              <div class="col-md-3">
                <p>Muncul Setelah Video</p>
              </div>
              <div class="col-md-9">
                  <p>{{$row->videos_title}}</p>
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

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END lESSON -->


<!-- BEGIN QUIZ -->
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
      <div class="box-header">
        <div class="row">
          <div class="col-md-6">
            <div class="box-title">
              <h4>Daftar Soal</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box-option text-right">
              <a href="{{url('contributor/lessons/quiz/'.$row->id.'/edit/questions')}}" class="btn btn-danger">Edit</a>
              <a href="{{url('contributor/lessons/quiz/'.$row->id.'/create/questions')}}" class="btn btn-info">Tambah Soal</a>
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
              </tr>
            </thead>
            <tbody>
              <?php $i=1;?>
              @foreach($question as $value)
              <tr>
                <td width="25">{{ $i }}</td>
                <td>{{$value->question}}</td>
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
<!-- END QUIZ -->
<script>
 function checkdelete(id){

   swal({
     title: "Apakah kamu yakin?",
     text: "Anda tidak akan dapat memulihkan data ini!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Ya, Hapus Quiz!",
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
