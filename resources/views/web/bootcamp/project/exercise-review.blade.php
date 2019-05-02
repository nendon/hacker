@extends('web.app')
@section('title','')
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
            <li class="nav-item">
              <a class="nav-link" id="pills-file-praktek-tab" data-toggle="pill" href="#pills-file-praktek" role="tab" aria-controls="pills-file-praktek" aria-selected="false">File Praktek</a>
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
              $adaexe = DB::table('exercise')
                 ->where('section_id', $section->id)
                 ->first();
            if($adaexe){
              $valid = DB::table('section')
              ->join('video_section', 'section.id','video_section.section_id')
              ->leftjoin('exercise', 'section.id', 'exercise.section_id')
              ->leftjoin('quiz_user', function($join){
                $join->on('exercise.id', '=', 'quiz_user.exercise_id')
                ->where('quiz_user.member_id', '=', Auth::guard('members')->user()->id)
                ->where('quiz_user.status',1);})
              ->leftjoin('project_section', 'section.id', 'project_section.section_id')
              ->leftjoin('project_user', function($join){
               $join->on('project_section.id', '=', 'project_user.project_section_id')
               ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
               ->where('project_user.status',2);})
              ->leftjoin('history', function($join){
                 $join->on('video_section.id', '=', 'history.video_id')
                 ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
              ->where('section.id', $section->id)
              ->select('section.id as section','section.position as posisi', DB::raw('count( DISTINCT video_section.id) + count(distinct exercise.id) as project'), DB::raw('count(DISTINCT quiz_user.id) + count(distinct history.id) as hasil'))
              ->groupby('section.id', 'section.position')
              ->first();
              
            }else{
              $valid = DB::table('section')
              ->join('video_section', 'section.id','video_section.section_id')
              ->leftjoin('exercise', 'section.id', 'exercise.section_id')
              ->leftjoin('quiz_user', function($join){
                $join->on('exercise.id', '=', 'quiz_user.exercise_id')
                ->where('quiz_user.member_id', '=', Auth::guard('members')->user()->id)
                ->where('quiz_user.status',1);})
              ->leftjoin('project_section', 'section.id', 'project_section.section_id')
              ->leftjoin('project_user', function($join){
               $join->on('project_section.id', '=', 'project_user.project_section_id')
               ->where('project_user.member_id', '=', Auth::guard('members')->user()->id)
               ->where('project_user.status',2);})
              ->leftjoin('history', function($join){
                 $join->on('video_section.id', '=', 'history.video_id')
                 ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
              ->where('section.id', $section->id)
              ->select('section.id as section','section.position as posisi', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
              ->groupby('section.id', 'section.position')
              ->first();
            }
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
                  $excr = DB::table('exercise')
                  ->where('section_id',$section->id)
                  ->first();
                  if($excr){
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
                <?php endforeach; }?>
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
                <?php endforeach; } ?>
                </ul>
              </div>
              <?php }else{
                 $n = $valid->posisi-1;
                 $sect = $valid->section-1;
                 
                 $adaproject = DB::table('project_section')
                 ->where('section_id', $sect)
                 ->first();
                 if(!$adaproject){
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
                  
                  ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct exercise.id) as project'), DB::raw('count(DISTINCT quiz_user.id)+ count(distinct history.id) as hasil'))
                  ->groupby('section.id')
                  ->first();
                 }else{
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
                  
                  ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
                  ->groupby('section.id')
                  ->first();
                 }
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
                   $exer = DB::table('exercise')
                   ->where('section_id',$section->id)
                   ->first();
                 if ($exer){
                  foreach ($section->exercise as $key => $exercis): ?>
                   <li>
                   <a href="{{ url('bootcamp/'.$bc->slug.'/exercise/'.$exercis->section_id) }}">
                     <div class="sub-materi row">
                       <div class="col-xs-10 px-0">
                         <i class="fas fa-clipboard-list"></i>  {{$exercis->title}}
                       </div>
                       <div class="col-xs-2 px-0 text-right">
                       <?php 
                           $cek = DB::table('quiz_user')
                           ->where('exercise_id', $exercis->id)
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

          <!-- Tab File Praktek -->
          <div class="tab-pane fade" id="pills-file-praktek" role="tabpanel" aria-labelledby="pills-file-praktek-tab">
            <a href="file/bioskop_dataset.csv" download>
              <div class="row box m-4  px-1">
              
               
                @foreach($lampiran as $key => $lampiran)
                <a href="{{$lampiran->file}}"> 
                <div class="col-xs-12">
                <i class="fa fa-download"></i>{{$lampiran->nama}}
                </div>
                </a>
                @endforeach
              </div>
            </a>
          </div>
        </div>

      </div>

      <!-- Content -->
      <div class="container-fluid p-0">
        <div class="row m-0 p-0"  id="page-content-wrapper">

          <div class="project-content project-view col-xs-12 p-0">
            <div class="header">
              <div class="col-xs-11 pl-5">
                {{$bc->title}} <br>
                <small>{{$course->title}} : Exercise {{$exc->title}}</small>
              </div>
              <div class="col-xs-1 px-4">
                <button type="button" class="plyr__control btn btn-outline-primary px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
              </div>
            </div>
            
            <div class="row px-5 pt-4">
              <div class="col-xs-12">
                  <style>
                      /* Tambahan Css */
                      .c-red{
                        color: red!important;
                      }
                      ul.exercise-review{
                        list-style: none;
                        list-style-position: inside;
                        padding: 0 20px;
                        padding-left: 30px;
                      }
                      ul.exercise-review li{
                        border: 1px solid #eee;
                        padding: 10px 15px;
                        padding-left: 30px;
                        margin: 10px 0;
                        font-size: 16px;
                      }
                      ul.exercise-review li:before{
                        color: #1fb6ff;
                        content: "\f058";
                        font-weight: bold;
                        font-family: "Font Awesome 5 Free";
                        display: inline-block;
                        width: 1em;
                        position: absolute;
                        margin-left: -23px;
                      }
                      ul.exercise-review li.wrong:before{
                        color: red;
                        content: "\f057";
                        font-weight: bold;
                        font-family: "Font Awesome 5 Free";
                        display: inline-block;
                        width: 1em;
                        position: absolute;
                        margin-left: -23px;
                      }
                      ul.exercise-review li h4{
                        font-weight: normal;
                        margin: 0 0 .5em;
                      }
                    </style>

                  <div class="text-center">
                 
                 
                 
                    <h3 class="c-blue">Exercise {{$exc->title}}</h3>
                    <h5><i class="fa fa-check-circle c-blue"></i> {{$nilai}}/{{$tanya}} Pertanyaan</h5>
                    <!-- Wrong
                    <h5><i class="fa fa-times-circle c-red"></i> 2/2 Pertanyaan</h5> 
                    -->
                    @if($nilai >= $exc->min_nilai)
                    <b>Anda Lulus!</b>
                    <?php
                     DB::table('quiz_user')
                    ->where('exercise_id',$exc->id)
                    ->where('member_id', Auth::guard('members')->user()->id)
                    ->where('id', $jawab->id)
                    ->update([
                    'status' => 1,
                    'nilai' => $nilai]);  ?>
                    @else
                    <b>Anda Tidak Lulus!</b>
                    <?php
                     DB::table('quiz_user')
                    ->where('exercise_id',$exc->id)
                    ->where('member_id', Auth::guard('members')->user()->id)
                    ->where('id', $jawab->id)
                    ->update([
                    'status' => 2,
                    'nilai' => $nilai]);  ?>
                    @endif
                  </div>

                  <br>

                  <div class="card">
                    <div class="card-header text-center">
                      <h5>Exercise Review</h5>
                    </div>
                    <div class="card-body">
                      <ul class="exercise-review">
                      @foreach( $detail as $key =>$detail)
                      @if($detail->ketentuan == 1)
                        <li>
                          <p>
                          <b>
                           Pertanyaan :</b> {{$detail->soal}}:
                           
                          </p>

                          <p class="text-muted">
                          <b>
                          @if($detail->status != 1)
                            Salah @else Benar @endif ! Anda menjawab :</b> {{$detail->jawab}} 
                          </p>

                          <p class="text-muted">
                          <b>
                          Keterangan :</b> {{$detail->alasan}}
                          
                          </p>
                        </li>
                      @else
                      <li class="wrong">
                          <p>
                          <b>
                          Pertanyaan :</b> {{$detail->soal}}:
                          </p>

                          <p class="text-muted">
                          <b>
                          @if($detail->status != 1)
                          Salah  @else Benar @endif ! Anda menjawab :</b> {{$detail->jawab}} 
                          </p>

                          <p class="text-muted">
                          <b>
                          Keterangan :</b> {{$detail->alasan}}
                          </p>
                        </li>
                      @endif
                      @endforeach
                      </ul>
                    </div>
                  </div>

              </div>
            </div> 
          </div>

        </div>
      </div>
      <div class="text-right">
      <?php $id = $sction->id +1?>
      @if($nilai >= $exc->min_nilai)
      <button class="btn btn-primary my-4" id="next"><a style="color:white;" href="{{url($lanjut)}}">Lanjutkan Materi</a></button>
      @else
      <button class="btn btn-warning my-4" id="next"><a style="color:white;" href="{{url('/bootcamp/'.$bc->slug.'/exercise/'.$sction->id)}}">Coba Kembali</a></button>
      @endif
      </div>
    </section>




    <!-- JavaScript -->
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
    </script>
@endsection()