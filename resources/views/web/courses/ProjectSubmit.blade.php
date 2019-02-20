@extends('web.app')
@section('title',$project->title)
@section('content')

    <!-- Section Content -->
    <section id="wrapper">
      
      <!-- Nav Sidebar -->
      <div id="sidebar-wrapper">

        <div class="tabs-video">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item active">
              <a class="nav-link" id="pills-materi-tab" data-toggle="pill" href="#pills-materi" role="tab" aria-controls="pills-materi" aria-selected="true">Materi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-diskusi-tab" data-toggle="pill" href="#pills-diskusi" role="tab" aria-controls="pills-diskusi" aria-selected="false">Diskusi</a>
            </li>
            <div class="tabs-close">
              <a class="btn btn-menu c-blue" onclick="sidebarShow()">
                <i class="fa fa-times"></i>
              </a>
            </div>
          </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
          <!-- Tab Materi -->
          <div class="tab-pane fade active in" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
          <?php
             $a = 1;
             foreach ($stn as $key => $section): ?>
              <div class="video-materi">
                <a class="collap" id="<?php echo "materi-".$a ?>" data-toggle="collapse" href="#{{$section->id}}" role="button">
                 <div class="number-circle"><?php echo $a ;?></div>
                  <div class="title">
                     {{$section->title}}
                    <h6><span class="fa fa-clock"></span> 40:48</h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>    
              </div>
              <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$vsection->id) }}">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                          {{$materi->durasi}}
                          <i class="fa fa-circle ml-2"></i>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  foreach ($section->project_section as $key => $project): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$project->title}}           
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                      </div>
                    </div>
                  </a >
                </li>
                <?php endforeach; ?>
                </ul>
              </div>
              <?php $a++;?>
                  <?php endforeach; ?>
          </div>

          <!-- Tab Diskusi-->
          <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
            <div class="row box m-4">
              <div class="col-xs-12">
                <h6>Buat Pertanyaan</h6>
                <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30" rows="10"></textarea>
                <br>
                <button class="btn btn-primary mb-2">Upload Gambar</button>
                <button class="btn btn-primary mb-2">Tambah Pertanyaan</button>
              </div>

              <hr class="mb-5">

              <div class="col-xs-12">
                <hr>
                <span class="text-muted">Saat ini belum ada diskusi</span>
              </div>

            </div>
          </div>
        </div>

      </div>

      <!-- Content -->
      <div class="container-fluid p-0">
        <div class="row m-0 p-0"  id="page-content-wrapper">

          <div class="project-content col-xs-12 p-0">
            <div class="header">
              <div class="col-xs-11 pl-5">
                Become a {{$bc->slug}} <br>
                <small>{{$vsection->title}}</small>
              </div>
              <div class="col-xs-1 px-4">
                <button type="button" class="plyr__control btn btn-outline-primary px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
              </div>
            </div>
            
            <div class="row px-5 pt-4">
              {{--  <div class="w-100 px-5 py-4">
                  <i class="fa fa-check-circle c-blue"></i> Selamat Anda telah lolos dalam Final Projek Course Linux Fundamental <a href="{{ url('Bootcamp/ProjectView') }}" class="btn btn-outline-primary">Lihat Hasil Preview</a>
              </div>  --}}
              <div class="col-xs-12">
                  <h4>{{$project->title}}</h4>

                  <h4>Couse {{$vsection->title}}: Final Projek</h4>
                  
                  <input type="file" id="file" name="file">
                  
                  <h5>Komentar</h5>
                  <textarea class="form-control" name="komentar" id="komentar" cols="100" rows="2"></textarea>
                  
                  <button class="btn btn-primary my-4" onclick="saveProject({{ $project->section_id}})">Submit Projek</button>
                  
              </div>
            </div> 
          </div>

        </div>
      </div>

    </section>
    
    <script>
      
    //function Menu sidebar    
    function sidebarShow(){
      if($("#wrapper").hasClass("toggled")){
        $("#wrapper").removeClass('toggled');
      }else{
        $("#wrapper").addClass('toggled');
      }
    }


    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-down').addClass('fa-chevron-up');        
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget+' i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
      });
    });

    //fungsi untuk save project
    function saveProject(project_id) {
      var body = $('#komentar').val();
      var file_data = $('#file').prop("files")[0];
      dataform = new FormData();
      dataform.append( 'file', file_data);
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
            url     :'{{ url("/bootcamp/upload/saveProject") }}',
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
                  title: "Tugas berhasil terkirim!, Silahkan tunggu hasil dari kami",
                  showConfirmButton: true,
                  timer: 3000
                });
              }
            }
        });
      }
    }
    </script>
@endsection()