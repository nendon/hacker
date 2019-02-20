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
          <div class="col-sm-6 col-xs-12">
            <b>Halaman 1 dari 5</b>
          </div>

          <div class="col-sm-6 col-xs-12 text-right">
            <nav aria-label="Page navigation">
              <ul class="pagination m-0">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                  </a>
                </li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>

      </div>
    </div>

  </div>
@endsection()