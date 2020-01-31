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
                <?php endif;?></h4>
              <h2>{{$bootcamp->title}}</h2>
            </div>
          </div>
        </div>

        <!-- Nav Tabs -->
        @include('contrib.bootcamp.nav')

        <!-- Tab Harga -->
            <div class="tab-pane fade active in" id="pills-harga" role="tabpanel" aria-labelledby="pills-harga-tab">
              <!-- row Title  -->
              <div class="box">
                <div class="row">
                  <div class="col-xs-12 p-4">
                    <h4 class="text-inline">Harga <i class="far fa-question-circle"></i></h4>
                    <button class="btn btn-green pull-right">Lihat Skema Harga dan Pembagian</button>
                  </div>
                </div>
              </div>

              <!-- row Content -->
              <div class="box mt-4">
                <div class="row">
                  <div class="col-xs-12">
                    <h5 class="mb-5">Harga</h5>
                    <input type="hidden" name="boot_id" value="{{ $bootcamp->id }}">
                    <h6>Harga Bootcamp</h6>
                    <div class="form-group">
                      <div class="col-sm-2 col-xs-5">  
                        <select class="form-control" name="matauang" id="matauang">
                          <option value="idr">IDR</option>
                          <option value="dollar">$</option>
                        </select>
                      </div>
                      <div class="col-sm-4 col-xs-7">
                        <input class="form-control" type="text" name="harga" id="harga" placeholder="{{ $bootcamp->price}}">
                      </div>
                    </div>

                    <button class="btn btn-green pull-right mt-4" onclick="saveHarga({{ $bootcamp->id}})">Set Harga</button>
                  </div>
                </div>
              </div>
            </div>
        </div>


    </div>

  </main>

   <script  >
     function saveHarga(bootcamp_id) {
      var harga = $('#harga').val();
      
      dataform = new FormData();
      dataform.append( 'harga', harga);
      dataform.append( 'boot_id', bootcamp_id);
  
      if (harga == '') {
        alert('Harap Isi form !')
      }else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type    :"POST",
            url     :'{{ url("contributor/bootcamp/saveHarga") }}',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Menambahkan harga",
                  text: "Mohon Tunggu sebentar, harga sedang ditambahkan ",
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
                $('#harga').val('');
                swal({
                  title: "harga Berhasil ditambahkan !",
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
    }
  </script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('template/kontributor/js/dropify.min.js')}}"></script>
@endsection()
