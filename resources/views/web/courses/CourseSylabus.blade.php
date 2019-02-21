@extends('web.app')
@section('title','Silabus')
@section('content')
<!doctype html>
<html lang="en">
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    
    <!-- Font OpenSans Reguler -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('css/timelines-vertical.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

<style>
.inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile + label {
  background-color: #2BA8E2;
  border-radius: 3px;
  color: white;
  cursor: pointer;
  display: inline-block;
  font-size: 1em;
  padding: 10px 15px;
}
.inputfile + label span {
  padding-left: 10px;
}
.inputfile:focus + label, .content .inputfile + label:hover {
  background-color: #5f36b3;
}

.inputfile-2 {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile-2 + label {
  background-color: #2BA8E2;
  border-radius: 3px;
  color: white;
  cursor: pointer;
  display: inline-block;
  font-size: 1em;
  padding: 10px 15px;
}
.inputfile-2 + label span {
  padding-left: 10px;
}
.inputfile-2:focus + label, .content .inputfile-2 + label:hover {
  background-color: #5f36b3;
}
</style>
    <title>Cilsy</title>
  </head>

  <body>
    
    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header" style="background-image: url({{asset('img/bg-head.jpg')}});">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h6 class="mb-5">Dashboard/Track</h6>
              <h2 class="mb-4">{{$bc->title}}</h2>
              <h6>{{$bc->deskripsi}}
              </h6>
              <br>
              <!-- <button class="btn btn-secondarys btn-lg mb-5">Mulai belajar</button> -->
              <a href="{{ url('bootcamp/'.$bc->slug.'/courseLesson/'.$mulai->id) }}" class="btn btn-primary mb-4">Mulai Belajar</a>

            </div>
          </div>
        </div>
      </section>

      <!-- Section Content -->
      <section class="container-fluid tabs-sylabus">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item active">
            <a class="nav-link" id="pills-kurikulum-tab" data-toggle="pill" href="#pills-kurikulum" role="tab" aria-controls="pills-kurikulum" aria-selected="true">Kurikulum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">Course Overview</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="pills-learning-tab" data-toggle="pill" href="#pills-learning" role="tab" aria-controls="pills-learning" aria-selected="false">File Praktek</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-diskusi-tab" data-toggle="pill" href="#pills-diskusi" role="tab" aria-controls="pills-diskusi" aria-selected="false">Diskusi</a>
          </li>
        </ul>
      </section>

      <section class="mt-5">
        <div class="container">

          <div class="tab-content tab-content-video-page" id="pills-tabContent">

            <!-- Tab Kurikulum -->
            <div class="tab-pane fade active in" id="pills-kurikulum" role="tabpanel" aria-labelledby="pills-kurikulum-tab">
              <ul class="timelines">
                <?php
                     $i = 1;
                     foreach ($cs as $key => $courses): 
                      ?>

                  <li>           
                      <div class="timelines-number"><?php echo $i; ?></div>
                      <div class="timelines-content">
                        <div class="row row-eq-height box p-0">
                          
                          <?php if (!empty($courses->cover_course)) {?>
                          <div class="col-sm-4 col-xs-12 p-0" style="background: url({{ asset($courses->cover_course) }});background-size:cover;min-height: 250px"></div>
                            <!-- for image content use style background for full size of column -->
                          <?php } else {?>
                          <div class="col-sm-4 col-xs-12 p-0" style="background: url({{ asset('template/web/img/no-image-available.png') }});background-size:cover;min-height: 250px"></div>
                          <?php }?> 
                          
                          <div class="col-sm-8 col-xs-12">

                            <div class="row mt-3">
                              <div class="col-xs-6">
                                <h5>Course Part <?php echo $i; ?></h5> <?php $i++;?>
                              </div>
                              <div class="col-xs-5 mt-4">
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                              </div>
                              <div class="col-xs-1 p-0 pt-2">
                                0%
                              </div>
                            </div>
                              
                            <br>

                            <h4>{{$courses->title}}</h4>
                            <h6>
                              {{$courses->deskripsi}}
                            </h6>

                            <br>
                            
                            <small class="text-muted">{{$course->estimasi}} Jam </small> &nbsp;&nbsp;&nbsp; <small class="text-muted">Deadline 2 Hari</small>
                                
                            <br><br>

                            <a href="{{ url('bootcamp/'.$bc->slug.'/courseLesson/'.$courses->id) }}" class="btn btn-primary mb-4">Mulai Belajar</a>
                          </div>
                        </div>
                      </div>
                          
                          <?php endforeach; ?>
                  </li>
                  </ul>
            </div>
  
            <!-- Tab Course Overview -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
            </div>

            <!-- Tab File Praktek -->
            <div class="tab-pane fade" id="pills-learning" role="tabpanel" aria-labelledby="pills-learning-tab">
            </div>

            <!-- Tab Diskusi -->
            <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
              <div class="row box">
                <div class="col-xs-12">
                  <h6>Buat Pertanyaan</h6>
                  <form id="form-comment" class="mb-25" enctype="multipart/form-data" method="POST">
                        @csrf
                        {{ method_field('POST') }}
                        <input type="hidden" name="bootcamp_id" value="{{ $bc->id }}">
                        <input type="hidden" name="parent_id" value="0"> 
                        <div class="form-group">
                          <textarea style="white-space: pre-line" rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                        </div>
                       
                        <input class="inputfile" type="file" name="image" id="file" data-multiple-caption="{count} files selected" multiple="multiple"/>
                        <label for="file"><i class="fa fa-upload"></i><span>Upload File</span></label>
                       
                      <button type="button" class="btn btn-primary upload-image" onclick="doComment({{ $bc->id}}, 0)">Tambah Pertanyaan</button> 
                      
                      </form><!--./ Comment Form -->
               
                </div>
                <!-- Comments Lists -->
                <div id="comments-lists">
                    <p>Memuat Pertanyaan . . .</p>
                </div>
                <!--./ Comments Lists -->


              </div>
            </div>

          </div>

        </div>
      </section>

    </main>

   
    <script>
    $('#collapse').click(function(){ 
        $(this).text(function(i,old){
            return old=='+ Tampilkan Lebih Banyak' ?  '- Tampilkan Lebih Sedikit' : '+ Tampilkan Lebih Banyak';
        });
    });
    $('#pills-kurikulum-tab').on('click', function(e){
      $('.header').css("background-image", "url(img/bg-head.jpg)");
    });
    $('#pills-diskusi-tab').on('click', function(e){
      var img = $('.header').css("background-image", "url(img/bg-head2.jpg)");
    });

    $(document).on('ready',function () {
    getComments();
  });

    function getComments() {
      $.ajax({
          type    :'GET',
          url     :'{{ url("bootcamp/coments/getComments/".$bc->id) }}',
          success:function(data){
            if (data == '') {
              $('#comments-lists').html('Tidak Ada Pertanyaan');
            }else {
              $('#comments-lists').html(data);
            }
          }
      });
    }

    function doComment(bootcamp_id, parent_id) {
    var body = $('#textbody'+parent_id).val();
    var file_data = $('#file').prop("files")[0];
    dataform = new FormData();
    dataform.append( 'image', file_data);
    dataform.append( 'body', body);
    dataform.append( 'bootcamp_id', bootcamp_id);
    dataform.append( 'parent_id', parent_id);

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
          url     :'{{ url("/bootcamp/coments/doComment") }}',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
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
              $('#textbody'+parent_id).val('');
              $('.inputfile').each(function() {
                var $input	 = $(this),
                    $label	 = $input.next('label'),
                    labelVal = $label.html();
                    $label.find('span').html('Upload Image');
              });
              swal({
                title: "Pertanyaan berhasil terkirim!",
                showConfirmButton: true,
                timer: 3000
              });
              
              getComments();
            }
          }
      });
    }
  }
  function replyComment(bootcamp_id, parent_id) {
    var body = $('#textbody'+parent_id).val();
    var file_data = $('#file-2').prop("files")[0];
    dataform = new FormData();
    dataform.append( 'image', file_data);
    dataform.append( 'body', body);
    dataform.append( 'bootcamp_id', bootcamp_id);
    dataform.append( 'parent_id', parent_id);

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
          url     :'{{ url("/bootcamp/coments/doComment") }}',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
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
              $('#textbody'+parent_id).val('');
              $('.inputfile').each(function() {
                var $input	 = $(this),
                    $label	 = $input.next('label'),
                    labelVal = $label.html();
                    $label.find('span').html('Upload Image');
              });
              swal({
                title: "Pertanyaan berhasil terkirim!",
                showConfirmButton: true,
                timer: 3000
              });
              
              getComments();
            }
          }
      });
    }
  }
  function loadcontent(){
        $(".content-reload").load(window.location.href + " .content-reload");
        console.log('reload');
    }

    setInterval(function(){
      getComments();
    }, 20000);
    </script>
@endsection()