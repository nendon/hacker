@extends('web.app')

@section('content')

<style>
  li.active{
    background-color: #2BA8E2;
    color: white;
  }
</style>
<section class="member-main pt-25 pb-25" style="">
  <div class="container">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav">
            <li class="{{ request()->is('member/profile/edit') ? 'active' : ''}}"><a href="{{ url('member/profile/edit') }}">Profil</a></li>
            <li class="{{ request()->is('member/change-password') ? 'active' : ''}}"><a href="{{ url('member/change-password') }}">Akun</a></li>
            <li class="{{ request()->is('member/riwayat') ? 'active' : ''}}"><a href="{{ url('member/riwayat') }}">Riwayat Pembelian</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
            @yield('member-content')
    </div>
  </div>



</section>


@endsection
