@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/lessons') }}">Kelola Tutorial</a></li>
			  <li><a href="{{ url('contributor/lessons/create') }}">Buat tutorial</a></li>
        <li>Submit</li>
		</ul>
		</div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
		<div class="box-white">

	    <form class="form-horizontal form-contributor" action="" method="post">
				{{ csrf_field() }}
				<div class="submit">
					<div class="text-center">
						<img src="{{ asset('template/kontributor/img/icon/question.png') }}" alt="" width="150">
						<h4><strong>Apakah anda yakin untuk mensubmit tutorial ini ?</strong></h4>
					</div>
					<div class="text">
						<p>Apabila tutorial ini sudah disubmit, maka anda tidak bisa mengedit apapun dari tutorial ini sampai ada hasil dari tim verifikator Cilsy.</p>
						<p><i>Catatan: Seluruh tutorial yang di submit oleh kontributor akan melalui proses verifikasi terlebih dahulu dari tim internal Cilsy untuk memastikan kualitas tutorial.</i></p>
					</div>
				</div>

	      <div class="form-group">

	        <div class="col-sm-12 text-center">
	          <a href="{{ url('contributor/lessons/'.$row->id.'/submit')}}" class="btn btn-danger">Batal</a>
						<button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
