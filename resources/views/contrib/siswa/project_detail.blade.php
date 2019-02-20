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
  </div>

  <div class="row">
    <div class="col-sm-4 col-xs-12 mt-4">
      <div class="box pr-0">
        <h5>Nama Siswa</h5>
        <div class="list-group">
            @foreach($list as $lists)
            <a href="{{url('contributor/project/submit/'.$lists->project_section_id.'/detail/'.$lists->id)}}" class="list-group-item {{ request()->is('contributor/project/submit/'.$lists->project_section_id.'/detail/'.$lists->id) ? 'active' : '' }}">
                <img src="img/user.png" class="img-table" alt=""> {{$lists->member->username}}</a>
            @endforeach
        </div>
      </div>
    </div>

    <div class="col-sm-8 col-xs-12 mt-4">
      <div class="box">
        <div class="pull-right">
          <a href="#"><i class="fa fa-times-circle"></i></a>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <h5>Nama Projek:</h5>
            <b>{{ucwords($section->title)}}</b>
          </div>
          <div class="col-xs-8">
            <h5>Deskripsi Projek :</h5>
            {{$section->deskripsi_project}}
          </div>
        </div>

        <hr>

        <div>
          <h5>Instruksi Projek</h5>
          <p class="read-more">{{$section->instruksi}}</p>
        </div>

        <hr>

        <div>
          <h5>komentar</h5>
          <p>{{$user->komentar_user}}</p>
        </div>

        <br>

        <div>
          <h5>Lampiran Project</h5>
          <a href="{{asset($user->file)}}" class="btn btn-green" download><i class="fa fa-file-alt" style="color: #00000080!important;"></i> {{$user->file}} <i class="fa fa-download"></i></a>
        </div>

        <br>

        <div>
          <h5>Tambahkan komentar anda</h5>
          <textarea class="form-control" name="komentar" id="komentar" cols="30" rows="4" placeholder="Tulis komentar atau review Anda, beritahu siswa anda"></textarea>
        </div>
        
        <div class="text-right mt-2">
          <button class="btn btn-green" onclick="saveProject({{ $user->id}})"><i class="fa fa-paper-plane"></i> Kirim</button>
        </div>

        <div class="row mt-4">
          <div class="col-xs-6 px-4">
            <button class="btn btn-white w-100 py-4" onclick="accProject({{$user->id}}, 1)">Tidak Lulus</button>
          </div>
          <div class="col-xs-6 px-4">
            <button class="btn btn-green w-100 py-4" onclick="accProject({{$user->id}}, 2)">Lulus</button>
          </div>
        </div>
      </div>
    </div>

  </div>
<script>

function saveProject(project_id) {
      var body = $('#komentar').val();
      dataform = new FormData();
      dataform.append( 'body', body);
      dataform.append( 'project_id', project_id);
  
      if (body == '') {
        alert('Harap Isi form !')
      }else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'{{ url("/bootcamp/contrib/saveProject") }}',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Memuat Project",
                  text: "Mohon Tunggu sebentar file anda sedang dikirim",
                  imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                  showConfirmButton: false,
                  allowOutsideClick: false
              });
              // Show image container
            },
            success:function(data){
              if (data.success == false) {
                 window.location.href = '{{ url("member/signin") }}';
              }else if (data.success == true) {
                $('#komentar').val('');
                $('#file').val('');
                swal({
                  title: "Komentar berhasil terkirim!",
                  showConfirmButton: true,
                  timer: 3000
                });
              }
            }
        });
      }
    }
    function accProject(pid, id){
        dataform = new FormData();
        dataform.append('id', pid);
        dataform.append('status', id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'{{ url("/contributor/project/accproject") }}',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            success:function(data){
                if(data.status == 1){
                    swal({
                        title: "Project Tidak di acc",
                        showConfirmButton: true,
                        timer: 3000
                      });
                } else if(data.status == 2)
                {
                    swal({
                        title: "Project Telah di ACC",
                        showConfirmButton: true,
                        timer: 3000
                      });
                }
                
            }
        });
    }
</script>
@endsection()