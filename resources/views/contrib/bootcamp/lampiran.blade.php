@extends('contrib.app')
@section('title','')
@section('breadcumbs')
@section('content')
<link href="{{asset('template/kontributor/css/dropify.min.css')}}" rel="stylesheet">


<!-- Main -->
    <main>

      <!-- Container -->
      <div class="container tabs-course">

        <div class="box header mt-5">
          <div class="row">
            <div class="col-sm-4 col-xs-12">
              <img :src="getCover()" class="img-rounded img-responsive" alt="">
            </div>
            <div class="col-sm-8 col-xs-12">
              <h4>Bootcamp 
                <?php if ($bootcamp->status == 0): ?>
                <small class="c-yellow">Draft</small>
                <?php else: ?>
                <small class="c-green">Published</small>
                <?php endif;?>
              </h4>
              <h2>{{$bootcamp->title}}</h2>
            </div>
          </div>
        </div>

        <!-- Nav Tabs -->
        @include('contrib.bootcamp.nav')

        <div class="tab-content mt-5" id="pills-tabContent">
        
        <!-- Tab Course Lampiran -->
            <div class="tab-pane fade active in" id="pills-lampiran" role="tabpanel" aria-labelledby="pills-lampiran-tab">
              <!-- row Title -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Lampiran <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right pull-xs-left" id="Lampiran-show">+ Tambah Lampiran</button>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4" id="rowLampiran">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-4">Tambah Lampiran</h5>
                  </div>
                </div>
                <div class="form-group">
                  Nama
                  <input class="form-control" type="text" name="nama" id="nama" placeholder="" >
                </div>
                <div class="form-group">
                  Deskripsi
                  <input class="form-control" type="text" name="deskr" id="deskr" placeholder="" >
                </div>
                <div class="form-group">
                  File
                  <input class="form-control dropify" type="file" id="file">
                </div>
                <div class="row p-4">
                  <button class="btn btn-green pull-right" onclick="saveLampiran({{$bootcamp->id}})">+ Simpan</button> 
                  <button class="btn btn-secondary pull-right mx-4" id="Lampiran-hide">+ Batalkan</button>
                </div>
              </div>
              @if($files != null)
              @foreach($files as $file)
              <div class="box my-4">
                <div class="row">
                  <div class="col-xs-12">
                    <i class="fa fa-download"></i> {{ $file->nama}}
                    <a class="pull-right collapsed" id="collapse" data-toggle="collapse" href="#collapseLampiran{{$file->id}}" role="button"></a>
                  </div>
                </div>
                <div class="collapse" id="collapseLampiran{{$file->id}}">
                  <div class="box bg-grey mt-4">
                    <h5>Edit Lampiran</h5>
                    <input type="hidden" name="lamp_id" value="{{ $file->id }}">
                    <input type="hidden" name="boot_id" value="{{ $bootcamp->id }}">
                    <div class="form-group">
                      Judul
                      <input class="form-control bg-grey" type="text" name="nama" id="namaold{{ $file->id }}" value="{{$file->nama}}" >
                    </div>
                    <div class="form-group">
                      Deskripsi
                      <input class="form-control bg-grey" type="text" name="deskr" id="deskrold{{ $file->id }}" value="{{$file->deskripsi}}" >
                    </div>
                    <div class="form-group">
                      File
                      <input class="form-control bg-grey dropify" data-default-file="{{asset($file->file)}}" type="file" name="file" id="fileold{{ $file->id }}" value="{{$file->file}}">
                    </div>
                  </div>
                  <div class="row p-4">
                    <button class="btn pull-right"><i class="fa fa-ellipsis-v"></i></button>
                    <button class="btn btn-green pull-right  mx-2" onclick="updateLampiran({{ $file->id}}, {{$bootcamp->id}})">+ Simpan</button> 
                    <button class="btn btn-secondary pull-right mx-2">+ Batalkan</button>
                  </div>
                </div>
              </div>
              @endforeach
              @endif
            </div>
        </div>


    </div>

  </main>
  <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/dropify.min.js')}}"></script>
  <script>
      $('#Lampiran-show').click(function(){
        $('#rowLampiran').slideDown(500);
      });
      $('#Lampiran-hide').click(function(){
          $('#rowLampiran').slideUp(500);
      })
      function saveLampiran(bootcamp_id) {
        var nama = $('#nama').val();
        var deskr = $('#deskr').val();
        var file_data = $('#file').prop("files")[0];
        dataform = new FormData();
        dataform.append( 'file', file_data);
        dataform.append( 'nama', nama);
        dataform.append( 'deskr', deskr);
        dataform.append( 'boot_id', bootcamp_id);
    
        if (dataform == '') {
          alert('Harap Isi form !')
        }else {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type    :"POST",
              url     :'{{ url("contributor/bootcamp/saveLampiran") }}',
              data    : dataform,
              dataType : 'json',
              contentType: false,
              processData: false,
              beforeSend: function(){
                   swal({
                    title: "Membuat Lampiran",
                    text: "Mohon Tunggu sebentar, Lampiran sedang dibuat ",
                    imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                // Show image container
              },
              success:function(data){
                if (data.success == false) {
                   window.location.href = '{{ url("contributor/login") }}';
                }else if (data.success == true) {
                  $('#nama').val('');
                  swal({
                    title: "Lampiran Berhasil Dibuat !",
                    showConfirmButton: true,
                    timer: 3000
                  },
                  function(){ 
                    location.reload("{{url("contributor/bootcamp/$bootcamp->slug#pills-lampiran")}}");
                  }
                  );
                }
              }
          });
        }
      }

function updateLampiran(lamp_id, bootcamp_id) {
       var nama = $('#namaold'+lamp_id).val();
        var deskr = $('#deskrold'+lamp_id).val();
        var file_data = $('#fileold'+lamp_id).prop("files")[0];
        dataform = new FormData();
        dataform.append( 'image', file_data);
        dataform.append( 'nama', nama);
        dataform.append( 'deskr', deskr);
        dataform.append( 'lamp_id', lamp_id);
        dataform.append( 'boot_id', bootcamp_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'{{ url("contributor/bootcamp/updateLampiran") }}',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Membuat Lampiran",
                  text: "Mohon Tunggu sebentar, Lampiran sedang update ",
                  imageUrl: "{{ asset('template/web/img/loading.gif') }}",
                  showConfirmButton: false,
                  allowOutsideClick: false
              });
              // Show image container
            },
            success:function(data){
              if (data.success == false) {
                 window.location.href = '{{ url("contributor/login") }}';
              }else if (data.success == true) {
                $('#nama').val('');
                swal({
                  title: "Lampiran Berhasil Diubah!",
                  showConfirmButton: true,
                  timer: 3000
                },
                function(){ 
                  location.reload();
                }
                );
              }
            }
        });
      }
      </script>
@endsection()
