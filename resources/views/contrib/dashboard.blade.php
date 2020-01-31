@extends('contrib.app')
@section('title','')
@section('breadcumbs')
<div id="navigation">
        <div class="container">
		<ul class="breadcrumb">
				<li>Dashboard</li>
        </ul>
        </div>
</div>
@endsection
@section('content')
<div class="row">
    
    <div class="col-md-4">
        <div class="card bg-3">
            <img src="{{asset('template/kontributor/img/icon/2.png')}}" alt="" />
            <p class="card-title">Rp. {{income()}}</p>
            <p class="card-desc">Pendapatan Bulan ini</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="{{asset('template/kontributor/img/icon/6.png')}}" alt="" />
            <p class="card-title">{{lessons_publish()}}</p>
            <p class="card-desc">Tutorial terpublish</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="{{asset('template/kontributor/img/icon/4.png')}}" alt="" />
            <p class="card-title">{{lessons_pending()}}</p>
            <p class="card-desc">Tutorial belum terverifikasi</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-4">
            <img src="{{asset('template/kontributor/img/icon/1.png')}}" alt="" />
            <p class="card-title"><?php echo coments();?></p>
            <p class="card-desc">Pertanyaan belum dibaca</p>
        </div>
    </div>
</div>
@endsection()
