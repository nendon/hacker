@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('contributor/reward') }}">Reward</a></li>
        <li>Penukaran Reward</li>
		</ul>
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
						<h4><strong>Apakah anda yakin menukar point dengan reward ini ?</strong></h4>
					</div>
					<div class="text" style="text-align:center">
						<p>Apabila reward ini sudah disubmit, points anda akan dipotong {{$reward->poin}} pts untuk mendapatakan reward ini.</p>
						<p><i>Catatan: Point yand ditukar tidak dapat dikembalikan lagi.</i></p>
					</div>
				</div>

	      <div class="form-group">

	        <div class="col-sm-12 text-center">
	          <a href="{{ url('contributor/reward')}}" class="btn btn-danger">Batal</a>
						<button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
@endsection()
