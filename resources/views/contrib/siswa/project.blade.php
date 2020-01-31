@extends('contrib.app')
@section('title', 'Project List')
@section('breadcumbs')
<div id="navigation">
    <div class="container">
        <ul class="breadcrumb">
        <li><a href="{{ url('contributor/dashboard') }}">Dashboard</a></li>
        <li>List Project</li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<div class="row mt-5">
    <div class="col-xs-12 mb-4">
      <h5>Projek</h5>
    </div>

    <hr style="border-top: 1px solid #000;width:98%">

    <div class="col-sm-4 col-xs-12">
      Nama Bootcamp/Tutorial <br>
      <select class="form-control">
        <option value="">Semua Bootcamp/Tutorial</option>
        @foreach($bcid as $bcids)
          <option value="{{$bcids->id}}">{{$bcids->title}}</option>
        @endforeach
      </select>
    </div>

    <div class="col-xs-12 mt-4">
      <div class="box">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Nama Projek</th>
              <th>Tipe Kelas</th>
              <th>Siswa Submit</th>
              <th>Lebih Lanjut</th>
            </tr>
            @foreach($project as $key)
            <tr>
              <td>{{$key->title}}</td>
              <td>Bootcamp</td>
              <td>- Siswa</td>
              <td><a href="{{url('contributor/project/submit/'.$key->section_id)}}" class="btn btn-green">Selengkapnya</a></td>
            </tr>
            @endforeach

          </table>
        </div>

        <div class="row">
          <div class="col-sm-6 col-xs-12 text-right">
              {{ $project->links() }}   
          </div>
        </div>

      </div>
    </div>

  </div>
@endsection()