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

        <!-- Tab Publish -->
        <div class="tab-pane fade active in" id="pills-publish" role="tabpanel" aria-labelledby="pills-publish-tab">
        <!-- Title  -->
        <div class="box">
            <div class="row">
              <div class="col-xs-12 p-4">
                <h4 class="text-inline">Publish <i class="far fa-question-circle"></i></h4>
              </div>
            </div>
          </div>

          <div class="box my-4">
            <div class="row">
              <div class="col-xs-12">
                <input type="hidden" name="boot_id" value="{{ $bootcamp->id }}">
                <h5 class="mb-4">Publish</h5>
                <?php if ($bootcamp->status == 0): ?>
                <h6 class="text-inline">Bootcamp belum dipublish</h6>
                <input type="hidden" name="status" id="status" value="1">
                <button class="btn btn-green" onclick="confirmPublish({{ $bootcamp->id}})">Publish</button>
                <?php else: ?>
               <h6 class="text-inline">Bootcamp sudah dipublish</h6>
                <button class="btn btn-green" disabled>Published</button>
                <?php endif;?>
                
              </div>
            </div>
          </div>
        </div>
    </div>


</div>

</main>
  <script  >
     function confirmPublish(bootcamp_id) {
      var status = $('#status').val();
      
      dataform = new FormData();
      dataform.append( 'status', status);
      dataform.append( 'boot_id', bootcamp_id);
  
      swal({
          title: "Bootcamp akan di Publish",
          text: "Apakah anda yakin?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type    :"POST",
            url     :'{{ url("contributor/bootcamp/confirmPublish") }}',
            data    : dataform,
            dataType : 'json',
            contentType: false,
            processData: false,
            beforeSend: function(){
                 swal({
                  title: "Mempublish",
                  text: "Mohon Tunggu sebentar, Bootcamp sedang dipublish ",
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
                $('#status').val('');
                swal({
                  title: "Bootcamp Berhasil dipublish !",
                  showConfirmButton: true,
                  timer: 3000
                },
                function(){ 
                  location.reload();
                }
                );
              }
            }
        });         // submitting the form when user press yes
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
        
      
    }
   
  </script>

<script type="text/javascript" src="{{asset('template/kontributor/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/kontributor/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('template/kontributor/js/dropify.min.js')}}"></script>
@endsection()
