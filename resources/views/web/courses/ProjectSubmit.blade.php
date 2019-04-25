@extends('web.app')
@section('title', $project->title)
@section('content')
@if($hist->target != $hist->hasil)
<script>
$(function(){
  swal({
        title: "Kamu belum menonton semua video! jangan lupa selesaikan",
        showConfirmButton: true,
        timer: 10000
      });
  });
</script> 
@endif
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


        <div class="tab-content tab-content-video-page" id="pills-tabContent">
          <!-- Tab Materi -->
          <div class="tab-pane fade active in" id="pills-materi" role="tabpanel" aria-labelledby="pills-materi-tab">
          <?php
             $a = 1;
             foreach ($stn as $key => $section): 
              $valid = DB::table('section')
              ->join('video_section', 'section.id','video_section.section_id')
              ->leftjoin('exercise', 'section.id', 'exercise.section_id')
              ->leftjoin('quiz_user', function($join){
                $join->on('exercise.id', '=', 'quiz_user.exercise_id')
                ->where('quiz_user.member_id', '=', Auth::guard('members')->user()->id);})
              ->leftjoin('project_section', 'section.id', 'project_section.section_id')
              ->leftjoin('project_user', function($join){
               $join->on('project_section.id', '=', 'project_user.project_section_id')
               ->where('project_user.member_id', '=', Auth::guard('members')->user()->id);})
              ->leftjoin('history', function($join){
                 $join->on('video_section.id', '=', 'history.video_id')
                 ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
              ->where('section.id', $section->id)
              ->select('section.id as section','section.position as posisi', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
              ->groupby('section.id', 'section.position')
              ->first();
             $persen = number_format($valid->hasil / $valid->project*100); 
             
             $n = $valid->posisi;
             $sect = $valid->section;

             ?>
             
              <div class="video-materi">
                <a class="collap" id="<?php echo "materi-".$a ?>" data-toggle="collapse" href="#{{$section->id}}" role="button">
               
                 <div class="number-circle"><?php echo $a ;?></div>
                  <div class="title">
                     {{$section->title}}
                    <h6><span class="fa fa-clock"></span>
                      <!-- menambahkan fungsi untuk memanggil total menit section -->
                      <?php 
                          $totalmenit = DB::table('video_section')
                          ->where('section_id', $section->id)
                          ->select(DB::raw('sum(durasi) as total'))
                          ->first();

                          echo gmdate("H:i:s", $totalmenit->total);
                      ?>
                    </h6>
                  </div>
                  <i class="icon-collap fa fa-chevron-down"></i>
                </a>
              </div>
              <?php if($valid->project == $valid->hasil)    {   ?>
              <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li> 
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <!-- mengubah col-xs-10 jadi 8 -->
                        <div class="col-xs-8 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <!-- mengubah col-xs-2 jadi 0 -->
                        <div class="col-xs-0 px-0 text-right">
                          <!-- {{$materi->durasi}} -->
                           <!-- menambahkan fungsi untuk mengubah durasi menit ke format waktu -->
                           <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  $exc = DB::table('exercise')
                  ->where('section_id',$section->id)
                  ->first();
                  if($exc){
                    foreach ($section->exercise as $key => $exercises): ?>
                    <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id) }}">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-clipboard-list"></i>  {{$exercises->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                        <?php 
                           $cek = DB::table('exercise')
                           ->join('quiz_user', 'exercise.id', 'quiz_user.exercise_id')
                           ->where('exercise.id', $exercises->id)
                           ->where('quiz_user.status', 1)
                           ->where('quiz_user.member_id', '=', Auth::guard('members')->user()->id)
                           ->first();
                            if($cek){        
                            ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                            <?php }else{ ?>
                            <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a >
                  </li>
                  <?php endforeach; 
                  }else{
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                         $cek = DB::table('project_section')
                         ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                         ->where('project_section.id', $projects->id)
                         ->where('project_user.status', 2)
                         ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                         ->first();
                          if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php 
                  endforeach;
                  } ?>
                </ul>
              </div>
              <?php }else{
                        
              if($valid->posisi == '1'){ ?>
              <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                            <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                  $exercise = DB::table('exercise')
                  ->where('section_id',$section->id)
                  ->first();
                  if ($exercise){
                    foreach ($section->exercise as $key => $exercises): ?>
                    <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id) }}">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-clipboard-list"></i>  {{$exercises->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                        <?php 
                            $cek = DB::table('quiz_user')
                            ->where('exercise_id', $exercises->id)
                            ->where('member_id', '=', Auth::guard('members')->user()->id)
                            ->where('status', 1)
                            ->first();
                            if($cek){        
                            ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i> 
                            <?php }else{ ?>
                            <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a >
                  </li>
                <?php 
                  endforeach; 
                  }
                  else{
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                          ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                          ->where('project_section.id', $projects->id)
                          ->where('project_user.status', 2)
                          ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                          ->first();
                          if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php 
                  endforeach; 
                  }
                ?>
                </ul>
              </div>
              <?php }else{
                 $n = $valid->posisi-1;
                 $sect = $valid->section-1;
                 $lihat = DB::table('section')
                  ->join('video_section', 'section.id','video_section.section_id')
                  ->leftjoin('exercise', 'section.id', 'exercise.section_id')
                  ->leftjoin('quiz_user', function($join){
                  $join->on('exercise.id', '=', 'quiz_user.exercise_id')
                  ->where('quiz_user.member_id', '=', Auth::guard('members')->user()->id)
                  ->where('quiz_user.status', '1');})
                  ->leftjoin('project_section', 'section.id', 'project_section.section_id')
                  ->leftjoin('project_user', function($join){
                    $join->on('project_section.id', '=', 'project_user.project_section_id')
                    ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                    ->where('project_user.status', '2');})
                  ->leftjoin('history', function($join){
                    $join->on('video_section.id', '=', 'history.video_id')
                    ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                  ->where('section.id', $sect)->where('section.position', $n)
                  ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct exercise.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT quiz_user.id)+ count(distinct project_user.id)+ count(distinct history.id) as hasil'))
                  ->groupby('section.id')
                  ->first();
              if($lihat->project == $lihat->hasil){ ?>
               <div class="collapse submateri" id="{{$section->id}}">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a href="{{ url('bootcamp/'.$bc->slug.'/videoPage/'.$materi->section_id)}}"
                        data-url="{{$materi->file_video}}"
                        data-title="{{$materi->title}}"
                        data-video_id="{{$materi->id}}"
                        data-section_id="{{$materi->section_id}}"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> {{$materi->title}}
                        </div>
                        <div class="col-xs-2 px-0 text-right">
                            <?php 
                              echo gmdate("H:i:s", $materi->durasi);
                            ?>
                          <?php 
                          $history = DB::table('video_section')
                          ->join('history', 'video_section.id', 'history.video_id')->where('video_section.id', $materi->id)->where('history.member_id', '=', Auth::guard('members')->user()->id)->first();
                          if($history){        
                          ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </li>
                  <?php $i++;?>
                  <?php endforeach; ?>
                  <?php
                   $exercise = DB::table('exercise')
                   ->where('section_id',$section->id)
                   ->first();
                 if ($exercise){
                   foreach ($section->exercise as $key => $exercises): ?>
                   <li>
                   <a href="{{ url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id) }}">
                     <div class="sub-materi row">
                       <div class="col-xs-10 px-0">
                         <i class="fas fa-clipboard-list"></i>  {{$exercises->title}}
                       </div>
                       <div class="col-xs-2 px-0 text-right">
                       <?php 
                           $cek = DB::table('quiz_user')
                           ->where('exercise_id', $exercises->id)
                           ->where('member_id', '=', Auth::guard('members')->user()->id)
                           ->where('status', 1)
                           ->first();
                           if($cek){        
                           ?>
                          <i class="fa fa-check-circle ml-2 c-blue"></i> 
                           <?php }else{ ?>
                            <i class="fa fa-circle ml-2"></i> 
                         <?php } ?>
                       </div>
                     </div>
                   </a >
                 </li>
                 <?php 
                   endforeach; 
                   }
                   else{
                  foreach ($section->project_section as $key => $projects): ?>
                  <li>
                  <a href="{{ url('bootcamp/'.$bc->slug.'/projectSubmit/'.$section->id) }}">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  {{$projects->title}}
                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                                  ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                                  ->where('project_section.id', $projects->id)
                                  ->where('project_user.status', 2)
                                  ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
                                  ->first();
                        
                                  if($cek){        
                          ?>
                        <i class="fa fa-check-circle ml-2 c-blue"></i>
                          <?php }else{ ?>
                          <i class="fa fa-circle ml-2"></i>
                        <?php } ?>
                      </div>
                    </div>
                  </a >
                </li>
                <?php 
                  endforeach; 
                  }
                ?>
                </ul>
               </div>
              <?php }else{ ?>
                <a disabled class="btn btn-primary float-right disable">Terkunci</a>
              <?php } 
              }
            }?>           
              <?php $a++;?>
                  <?php endforeach; ?>
          </div>

          <!-- Tab Diskusi-->
          <div class="tab-pane fade" id="pills-diskusi" role="tabpanel" aria-labelledby="pills-diskusi-tab">
              <div class="row box m-4">
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

                <hr class="mb-5">

                <div class="col-xs-12">
                <div id="comments-lists">
                    <p>Memuat Pertanyaan . . .</p>
                </div>
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
                {{$bc->title}} <br>
                <small>{{$course->title}}</small>
              </div>
              <div class="col-xs-1 px-4">
                <button type="button" class="plyr__control btn btn-outline-primary px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
              </div>
            </div>
            
            <div id="cek_review" class="row px-5 pt-4">
            @if($projectUser)
              @if($projectUser->status == 2)
              <div class="w-100 px-5 py-4">
                  <i class="fa fa-check-circle c-blue"><b> Selamat Anda Lolos dalam project lessons {{$sec->title}}</b></i>  <a href="{{ url('bootcamp/projectView/'.$sec->id) }}" class="btn btn-outline-primary">Lihat Hasil Preview</a>
              </div> 
              @elseif($projectUser->status == 0)
              <div class="w-100 px-5 py-4">
                  <i class="fa fa-circle ml-2"></i><b> Project anda sedang di review oleh Instruktur dan Team Project Review</b> 
              </div> 
              @else
              <div class="w-100 px-5 py-4">
                  <i class="fa fa-check-circle c-red"><b> Maaf anda belum berhasil dalam project lessons {{$sec->title}}. Mohon upload ulang project agar bisa melanjutkan</b></i>  <a href="{{ url('bootcamp/projectView/'.$sec->id) }}" class="btn btn-outline-primary">Lihat Hasil Preview</a>
              </div> 
              @endif
            @endif
              <div class="col-xs-12">
                  <h3>{{$project->title}}</h3>

                  <h4><b>Instruksi: <br/></b><br/></h4>
                  <h5 style="color:#2ba8e2"> {{$project->instruksi}} </h5>
                  <br/>
                  <p>Project yang anda submit akan langsung di Review oleh Instruktur dan Team Project Viewer yang sudah kompeten dan memiliki skill yang baik. <br/>
                  Pastikan anda mengerjakan project dengan sesuai permintaan karena jika tidak Anda tidak akan bisa melanjutkan ke Course selanjutnya. </p>
                  Ketentuan <br/>
                  <p>1. Kirimkan tugas ini dalam bentuk dokumen apapun (Word, Excel, PDF, Gambar, dll) <br/>
                  2. Archive dokumen tersebut ke dalam zip/rar. Tim penilai akan mengulas tugas Anda dalam tempo maksimal 2(dua) hari kerja <br/>(terkecuali Sabtu, Minggu, dan haru libur nasional). <br/>
                  3. Cukup satu kali saja mengumpulkan tugas, tidak perlu berkali kali. Tindakan demikian hanya akan memperlama proses penilaian. </p>
                  Siap untuk mengirim? <br/>
                  Jika anda memiliki kesulitan atau masalah tentang projek atau status projek anda yang disubmit anda bisa menghubungi kami melalui supportprojek@cilsy.id <br/>
                  <br/>
                  @if($projectUser)
                    @if($projectUser->status == "1")
                    <div>
                    <input type="file" id="files" name="files">
                    
                    <h5>Komentar</h5>
                    <textarea class="form-control" name="komentar" id="komentar" cols="100" rows="2"></textarea>
                    
                    <button class="btn btn-primary my-4" onclick="saveProject({{ $project->id}})">Submit Projek</button>
                    </div>
                    @endif
                  @else
                  <div>
                  <input type="file" id="files" name="files">
                  
                  <h5>Komentar</h5>
                  <textarea class="form-control" name="komentar" id="komentar" cols="100" rows="2"></textarea>
                  
                  <button class="btn btn-primary my-4" onclick="saveProject({{ $project->id}})">Submit Projek</button>
                  </div>
                  @endif
              </div>
            </div> 
          </div>

        </div>
      </div>

    </section>
    <script>

      $(function(){
          $('#footer').addClass('hide')
          getComments();
          $('#{{$sec->id}}').collapse();
        });
      
      
   
      
  
    </script>
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
      var file_data = $('#files').prop("files")[0];
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
              $("#cek_review").load(location.href+ ' #cek_review');
              
            }
        });
      }
    }

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
  
    </script>
@endsection()