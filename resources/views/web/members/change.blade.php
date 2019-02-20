@extends('web.app')
@push('css')
<style media="screen">
    .btn-more{
        background-color: #2ba8e2;
        color: #fff;
    }
    .member-point {
        margin-top: 100px;
    }
    .member-point .point-information{
        margin-bottom: 130px;
    }
    .member-point .point-information .cover .member{
        color: #fff;
        min-height: 150px;
    }
    .member-point .point-information .cover .counter {
        position: absolute;
        margin-top: -50px;
        width: 100%;
        padding-right: 8%;
    }
    .member-point .point-information .cover .counter .item {
        color: #fff;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        padding: 0 10%;
    }
    .member-point .point-information .cover .counter .item .middle{
        display: table;
    }
    .member-point .point-information .cover .counter .item .inner{
        display: table-cell;
        vertical-align: middle;
    }
    .green{
        background-color: #1cc327;
    }
    .blue{
        background-color: #2798cc;
    }
    .purple{
        background-color: #a238b9;
    }

</style>
@endpush
@section('content')
<section class="member-point pt-25 pb-25">
    <div class="container">
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
	          <a href="{{ url('member/reward')}}" class="btn btn-danger">Batal</a>
			  <button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
    </div>
</section>
@endsection
@push('js')

@endpush
