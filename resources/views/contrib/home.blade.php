@extends('contrib.app')
@section('title','')
@section('content')
			<div class="row">
                <div class="col-md-4">
                    <div class="card bg-1">
                        <img src="{{asset('template/kontributor/img/icon/5.png')}}" alt="" />
                        <p class="card-title">Profesional</p>
                        <p class="card-desc">Kredibilitas Anda</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-2">
                        <img src="{{asset('template/kontributor/img/icon/3.png')}}" alt="" />
                        <p class="card-title">1300</p>
                        <p class="card-desc">Poin Anda</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-3">
                        <img src="{{asset('template/kontributor/img/icon/2.png')}}" alt="" />
                        <p class="card-title">Rp. 2.500.000</p>
                        <p class="card-desc">Pendapatan Bulan ini</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-4">
                        <img src="{{asset('template/kontributor/img/icon/6.png')}}" alt="" />
                        <p class="card-title">2</p>
                        <p class="card-desc">Tutorial terpublish</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-4">
                        <img src="{{asset('template/kontributor/img/icon/4.png')}}" alt="" />
                        <p class="card-title">100</p>
                        <p class="card-desc">Tutorial belum terverifikasi</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-4">
                        <img src="{{asset('template/kontributor/img/icon/1.png')}}" alt="" />
                        <p class="card-title">50</p>
                        <p class="card-desc">Pertanyaan belum terjawab</p>
                    </div>
                </div>
            </div>
@endsection()