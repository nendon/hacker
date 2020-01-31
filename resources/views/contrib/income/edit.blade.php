@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/income') }}">Kelola pendapatan</a></li>
        <li>Info Rekening</li>
		</ul>
		</div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
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
		<div class="box-white">
	    <div class="form-title">
	      <h3>Edit Rekening</h3>
	    </div>
	     <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="method" value="PUT">
				<div class="form-group">
	        <label class="col-sm-2 control-label">Bank</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name= "bank" placeholder="Contoh: Mandiri" value="{{$row->bank}}">
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-2 control-label">No Rekening</label>
	        <div class="col-sm-10">
	        <input type="text" class="form-control" name= "noreg" placeholder="Contoh: 151 90002 982"value="{{$row->account_no}}">
	        </div>
	      </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Penerima</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name= "name" placeholder="Contoh: Andryana" value="{{$row->holder}}">
            </div>
          </div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10 text-right">
	          <a href="{{url('contributor/income')}}" class="btn btn-danger">Batal</a>
	          <button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
