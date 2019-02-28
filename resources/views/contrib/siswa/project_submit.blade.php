@extends('contrib.app')
@section('title', 'Project Submit List')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        <ul class="breadcrumb">
        <li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li>Project Submit</li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row mt-5">
    <div class="col-xs-12 mb-4">
      <h5>Projek Submit</h5>
    </div>

    <hr style="border-top: 1px solid #000;width:98%">

    <div class="col-sm-4 col-xs-12">
      Cari Nama Siswa <br>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
        <input type="text" class="form-control" name="name" id="name" style="border-left:none;">
      </div>
    </div>

    <div class="col-sm-4 col-xs-12">
      Nama Projek <br>
      <select class="form-control">
        <option value="">Explore Weather Trends</option>
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
      </select>
    </div>

    <div class="col-xs-12 mt-4">
      <div class="box">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Nama Siswa</th>
              <th>Komentar</th>
              <th>Tanggal Submit</th>
              <th>Status</th>
              <th>Lebih Lanjut</th>
            </tr>

            @foreach($user_project as $user)
            <tr>
              <td><img src="{{asset($user->avatar)}}"class="img-table img-responsive" alt=""> {{$user->username}}</td>
              <td>{{$user->komentar_user}}</td>
              <td>{{date("jS F Y", strtotime($user->created_at))}}</td>
              @if($user->status == 0)
              <td><span class="c-yellow">Menunggu</span></td>
              @elseif($user->status == 1)
              <td><span class="c-red">Tidak Lulus</span></td>
              @elseif($user->status == 2)
              <td><span class="c-green">Lulus</span></td>
              @endif
              <td><a href="{{url('contributor/project/submit/'.$user->section_id.'/detail/'.$user->id)}}" class="btn btn-green"><i class="fa fa-eye"></i> Lihat</a></td>
            </tr>
            @endforeach


          </table>
        </div>
        <!-- pagination link project submit yang ditambahkan -->
        <div class="row">
          <div class="col-md-12 text-center">
            {{ $user_project->links() }}
          </div>
        </div>

      </div>
    </div>

  </div>
  @endsection()