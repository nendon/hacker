@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/create') }}">Buat tutorial</a></li>
        <li>Video</li>
		</ul>
		</div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">
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
	    <form class="form-horizontal form-contributor">
				<div class="form-title">
					<h3>Tutorial Linux Fundamental dengan ubuntu 14.04 LTS</h3>
			 	</div>
				<div class="item">
					<div class="option">
						<div class="row">
							<div class="col-md-6">
								<h4>1.Soal 1</h4>
							</div>
							<div class="col-md-6 text-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
									<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
								  <button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/delete.png') }}" alt="" width="15"></button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Contoh:Apa kepanjangan dari LTS pada versi Ubuntu?">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban A</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban B</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban C</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Jawaban D</label>
						<div class="col-sm-1">
							<div class="checkbox">
				        <label>
				          <input type="checkbox">
				        </label>
				      </div>
						</div>
						<div class="col-sm-7">
							<input type="text" class="form-control" placeholder="Tulis Jawaban disini">
						</div>
						<div class="col-sm-2 text-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-up.png') }}" alt="" width="15"></button>
								<button type="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/sort-down.png') }}" alt="" width="15"></button>
							</div>
						</div>
					</div>


				</div>

	      <div class="form-group">
					<div class="col-sm-2">
						<button type="button" name="button" class="btn btn-default btn-outline"><img src="{{ asset('template/kontributor/img/icon/tambah.png') }}" alt="" width="15"> tambah soal</button>
					</div>
	        <div class="col-sm-10 text-right">
	          <a class="btn btn-danger">Batal</a>
	          <a class="btn btn-info">Submit</a>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
