<?php $__env->startSection('title','Belajar Course '.$course->title.' - '.$bc->title); ?>
<?php $__env->startSection('content'); ?>

    <section id="wrapper">

      <!-- THE PLAYLIST -->
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
              ->select('section.id as section','section.position as posisi', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) + count(distinct exercise.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct quiz_user.id) + count(distinct history.id) as hasil'))
              ->groupby('section.id', 'section.position')
              ->first();
             $persen = number_format($valid->hasil / $valid->project*100); 
             
             $n = $valid->posisi;
             $sect = $valid->section;

             ?>
             
              <div class="video-materi">
                <a class="collap" id="<?php echo "materi-".$a ?>" data-toggle="collapse" href="#<?php echo e($section->id); ?>" role="button">
               
                 <div class="number-circle"><?php echo $a ;?></div>
                  <div class="title">
                     <?php echo e($section->title); ?>

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
              <div class="collapse submateri" id="<?php echo e($section->id); ?>">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a
                        data-url="<?php echo e($materi->file_video); ?>"
                        data-title="<?php echo e($materi->title); ?>"
                        data-video_id="<?php echo e($materi->id); ?>"
                        data-section_id="<?php echo e($materi->section_id); ?>"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <!-- mengubah col-xs-10 jadi 8 -->
                        <div class="col-xs-8 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> <?php echo e($materi->title); ?>

                        </div>
                        <!-- mengubah col-xs-2 jadi 0 -->
                        <div class="col-xs-0 px-0 text-right">
                          <!-- yang ini kak -->
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
                    <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id)); ?>">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-clipboard-list"></i>  <?php echo e($exercises->title); ?>

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
                    foreach ($section->project_section as $key => $project): ?>
                  <li>
                  <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/projectSubmit/'.$project->section_id)); ?>">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  <?php echo e($project->title); ?>

                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                         $cek = DB::table('project_section')
                         ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                         ->where('project_section.id', $project->id)
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
                        
              if($valid->posisi == '1'){ ?>
              <div class="collapse submateri" id="<?php echo e($section->id); ?>">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a
                        data-url="<?php echo e($materi->file_video); ?>"
                        data-title="<?php echo e($materi->title); ?>"
                        data-video_id="<?php echo e($materi->id); ?>"
                        data-section_id="<?php echo e($materi->section_id); ?>"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> <?php echo e($materi->title); ?>

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
                    <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id)); ?>">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-clipboard-list"></i>  <?php echo e($exercises->title); ?>

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

                  foreach ($section->project_section as $key => $project): ?>
                  <li>
                  <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/projectSubmit/'.$project->section_id)); ?>">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  <?php echo e($project->title); ?>

                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                          ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                          ->where('project_section.id', $project->id)
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
              <?php  }else{
                 $n = $valid->posisi-1;
                 $sect = $valid->section-1;
                 $adaproject = DB::table('project_section')
                 ->where('section_id', $sect)
                 ->first();
                 if($adaproject){
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
               <div class="collapse submateri" id="<?php echo e($section->id); ?>">
                <ul>
                <?php
                 $i = 1;
                 foreach ($section->video_section as $key => $materi): ?>
                  <li>
                    <a
                        data-url="<?php echo e($materi->file_video); ?>"
                        data-title="<?php echo e($materi->title); ?>"
                        data-video_id="<?php echo e($materi->id); ?>"
                        data-section_id="<?php echo e($materi->section_id); ?>"
                        onclick="changeVideo(this), saveHistory(this)"
                    >
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-play-circle"></i><?php echo " $i."; ?> <?php echo e($materi->title); ?>

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
                  $cise = DB::table('exercise')
                    ->where('section_id',$section->id)
                    ->first();
                  if ($cise){
                    foreach ($section->exercise as $key => $exercises): ?>
                    <li>
                    <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/exercise/'.$exercises->section_id)); ?>">
                      <div class="sub-materi row">
                        <div class="col-xs-10 px-0">
                          <i class="fas fa-clipboard-list"></i>  <?php echo e($exercises->title); ?>

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
                  foreach ($section->project_section as $key => $project): ?>
                  <li>
                  <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/projectSubmit/'.$project->section_id)); ?>">
                    <div class="sub-materi row">
                      <div class="col-xs-10 px-0">
                        <i class="fas fa-clipboard-list"></i>  <?php echo e($project->title); ?>

                      </div>
                      <div class="col-xs-2 px-0 text-right">
                      <?php 
                          $cek = DB::table('project_section')
                                  ->join('project_user', 'project_section.id', 'project_user.project_section_id')
                                  ->where('project_section.id', $project->id)
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
                        <?php echo csrf_field(); ?> 
                        <?php echo e(method_field('POST')); ?>

                        <input type="hidden" name="bootcamp_id" value="<?php echo e($bc->id); ?>">
                        <input type="hidden" name="parent_id" value="0"> 
                        <div class="form-group">
                          <textarea style="white-space: pre-line" rows="8" cols="80" class="form-control" name="body" id="textbody0"></textarea>
                        </div>
                       
                        <input class="inputfile" type="file" name="image" id="file" data-multiple-caption="{count} files selected" multiple="multiple"/>
                        <label for="file"><i class="fa fa-upload"></i><span>Upload File</span></label>
                       
                      <button type="button" class="btn btn-primary upload-image" onclick="doComment(<?php echo e($bc->id); ?>, 0)">Tambah Pertanyaan</button> 
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

      <div class="container-fluid p-0">
        <div class="row m-0 p-0"  id="page-content-wrapper" >

            <div class="col-xs-12 p-0">

            <!-- THE VIDEO PLAYER -->
              <video id="player" playsinline controls>
                <source id="jalan" src="" type="video/mp4">
              </video>

              <div class="player-end">
                <div class="align-items-center">
                  <div class="col-xs-12 text-center">
                    <?php 
                      $count = 0;
                      $next = DB::table('video_section')
                      ->where('section_id',$vmateri->section_id)
                      ->where('id', $vmateri->id)
                      ->get();
                      foreach ($next as $key => $value) :
                      if ($count == 1) {
                        echo "<h6>Berikutnya $value->title</h6>";
                      }else{
                        echo "<h5>$value->title</h5>";
                      }
                      if ($count==1)break; 
                      $count++;
                     

                      
                      ?>
                     
                      
                    <a
                        data-url="<?php echo e($vmateri->file_video); ?>"
                        data-title="<?php echo e($vmateri->title); ?>"
                        data-video_id="<?php echo e($vmateri->id); ?>"
                        data-section_id="<?php echo e($vmateri->section_id); ?>"
                        onClick="tesVideo(this), saveHistory(this)"
                        class="btn btn-next link-next"
                    >Lanjutkan</a>

                      <?php 
                      
                    endforeach;
                  ?>
                  </div>
                </div>
              </div>

            </div>

        </div>
      </div>

    </section>


    <!-- JavaScript -->
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-2.2.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/plyr.min.js')); ?>"></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
      <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

    <script>
    var id = <?php echo e($vmateri->id); ?>;
    $(document).on('ready',function () {
      getComments();

      $('#<?php echo e($vmateri->section_id); ?>').collapse();

      $(".submateri a").each(function() {
        if($(this).data('video_id') == id){
          $(this).addClass("active");
        }
      })
    });
    //vmateri bisa disimpen disni gateh ? harusnya mah bisa ya 
    let video_id = "<?php echo e($vmateri->id); ?>";
    let section_id = "<?php echo e($vmateri->section_id); ?>";

      //function Menu sidebar
      function sidebarShow(){
        if($("#wrapper").hasClass("toggled")){
          $("#wrapper").removeClass('toggled');
        }else{
          $("#wrapper").addClass('toggled');
        }
      }
     

      const controls = `<div class="video-header">
        <div class="col-xs-8">
          <?php echo e($bc->title); ?> <br>
        </div>
        <div class="col-xs-3 p-0">
          <a href="<?php echo e(url('/bootcamp/'.$bc->slug.'/courseSylabus')); ?>">
            <i class="fa fa-chevron-left"></i> Course Part <?php echo e($course->position); ?> <?php echo e($course->title); ?>

          </a>
        </div>
        <div class="col-xs-1 p-0">
          <button type="button" class="btn btn-menu px-4" onClick="sidebarShow()"><i class="fa fa-bars"></i></button>
        </div>
      </div>
      <div class="plyr__controls">
        <button type="button" class="plyr__control" aria-label="Play, {title}" data-plyr="play">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-pause"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-play"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Pause</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Play</span>
        </button>
        <div class="plyr__progress">
            <input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" aria-label="Seek">
            <progress class="plyr__progress__buffer" min="0" max="100" value="0">% buffered</progress>
            <span role="tooltip" class="plyr__tooltip">00:00</span>
        </div>
        <div class="plyr__time plyr__time--current" aria-label="Current time">00:00</div>
        <div class="plyr__time plyr__time--duration" aria-label="Duration">00:00</div>
        <button type="button" class="plyr__control" aria-label="Mute" data-plyr="mute">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-muted"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-volume"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Unmute</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Mute</span>
        </button>
        <div class="plyr__volume">
            <input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1" autocomplete="off" aria-label="Volume">
        </div>
        <button type="button" class="plyr__control" data-plyr="captions">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-captions-on"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-captions-off"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Disable captions</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Enable captions</span>
        </button>
        <button type="button" class="plyr__control" data-plyr="fullscreen">
            <svg class="icon--pressed" role="presentation"><use xlink:href="#plyr-exit-fullscreen"></use></svg>
            <svg class="icon--not-pressed" role="presentation"><use xlink:href="#plyr-enter-fullscreen"></use></svg>
            <span class="label--pressed plyr__tooltip" role="tooltip">Exit fullscreen</span>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Enter fullscreen</span>
        </button>
              
               
        <a
            data-url="<?php echo e($vmateri->file_video); ?>"
            data-title="<?php echo e($vmateri->title); ?>"
            data-video_id="<?php echo e($vmateri->id); ?>"
            data-section_id="<?php echo e($vmateri->section_id); ?>"
            onClick="tesVideo(this), saveHistory(this)"
            class="btn btn-next link-next"
        >
            Lanjutkan <i class="fa fa-step-forward"></i>
            <span class="label--not-pressed plyr__tooltip" role="tooltip">Lanjutkan Course</span>
        </a>
                 
    </div>
    `;

    var player = new Plyr('#player', {
      "debug": false,
      controls,
      keyboard:{
        global: true
      },
      resetOnEnd: true,
    });

    player.source = {
      type: 'video',
      title: 'Elephant Dream',
      sources: [{
        src: '<?php echo e(asset($vmateri->file_video)); ?>',
        type: 'video/mp4',
      }]
    };

    //show overlay when video has ended
    player.on('ended', function(){
        $('.player-end').css('display', 'block');
    });

    //hide overlay when video play again
    player.on('playing',function(){
        $('.player-end').css('display', 'none');
    });

   // function for button `Lanjutkan` when video has ended
    function changeVideo(attr){
      const defaultUrl = 'https://dev.cilsy.id';
      const url = $(attr).data('url');
      const title = $(attr).data('title');
      $('.player-end').css('display', 'none');
      player.source = {
        type: 'video',
        title: title,
        sources: [{
          src: defaultUrl+url,
          type: 'video/mp4',
        }]
      };
      video_id = $(attr).data('video_id');
      section_id =  $(attr).data('section_id');

    }

    function tesVideo(attr){
    
      const defaultUrl = 'https://dev.cilsy.id';
      $('.player-end').css('display', 'none');
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
            url: '<?php echo e(url("/bootcamp/getNextLink/")); ?>',
            method: 'POST',
            dataType: 'JSON',
            data: {video_id: video_id,
                    section_id: section_id},
            success: function(result){
              if(result.end == true){
                window.location.href = defaultUrl+result.url;
              }else{
                player.source = {
                type: 'video',
                title: result.title,
                sources: [{
                  src: defaultUrl+result.url,
                  type: 'video/mp4',
                  }]
                };
                
                video_id = result.videoid;
                section_id = result.section;
                console.log("url : "+defaultUrl+result.url);
                console.log("max : "+result.max);
                console.log("video_id sesudah : "+$(attr).data('video_id'));   
                console.log("section sesudah : "+$(attr).data('section_id'));   
               saveHist(video_id, section_id); 
              }  
            },
            error: function(data) {
                console.log("data: " + JSON.stringify(data));
            }
        })
      }
    
    function getComments() {
      $.ajax({
          type    :'GET',
          url     :'<?php echo e(url("bootcamp/coments/getComments/".$bc->id)); ?>',
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
          url     :'<?php echo e(url("/bootcamp/coments/doComment")); ?>',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
                imageUrl: "<?php echo e(asset('template/web/img/loading.gif')); ?>",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            // Show image container
          },
          success:function(data){
            if (data.success == false) {
               window.location.href = '<?php echo e(url("member/signin")); ?>';
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
          url     :'<?php echo e(url("/bootcamp/coments/doComment")); ?>',
          data    : dataform,
          dataType : 'json',
          contentType: false,
          processData: false,
          beforeSend: function(){
               swal({
                title: "Memuat Pertanyaan",
                text: "Mohon Tunggu sebentar Pertanyaan anda sedang dimuat",
                imageUrl: "<?php echo e(asset('template/web/img/loading.gif')); ?>",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            // Show image container
          },
          success:function(data){
            if (data.success == false) {
               window.location.href = '<?php echo e(url("member/signin")); ?>';
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
 
    function saveHistory(attr) {
     
      let data = {
        video_id: $(attr).data('video_id'),
        section_id: $(attr).data('section_id')
      }; 

      // set base url for global usage
      let loc = window.location;
      let baseUrl = loc.protocol + "//" + loc.hostname + (loc.port? ":"+loc.port : "") + "/bootcamp/";

      // use ajax to access save query
      $.ajax({
        type: "GET",
        url: baseUrl + '<?php echo e($bc->slug); ?>' +"/saveHistory",
        data: data
      });

      $( "#pills-materi" ).load(window.location.href + " #pills-materi" , () => {
        var id_collapse = $(attr).data('section_id');
        $('#'+id_collapse).collapse();

        id =  $(attr).data('video_id');
        $(".submateri a").each(function() {
          console.log('id ke : '+$(this).data('video_id'));
          if($(this).data('video_id') == id){
            $(this).addClass("active");
          }else{
            $(this).removeClass("active");
          }
        })
      })
    }

    function saveHist(video_id, section_id ) {
     
      let data = {
        video_id: video_id,
        section_id: section_id
      };

      // set base url for global usage
      let loc = window.location;
      let baseUrl = loc.protocol + "//" + loc.hostname + (loc.port? ":"+loc.port : "") + "/bootcamp/";

      // use ajax to access save query
      $.ajax({
        type: "GET",
        url: baseUrl + '<?php echo e($bc->slug); ?>' +"/saveHistory",
        data: data
      });
      $( "#pills-materi" ).load(window.location.href + " #pills-materi" , () => {
        // ini section id nya bner kan? iyaaa bener dapet dari saat change
        // var id_collapse = $(section_id).data('section_id');
        $('#'+section_id).collapse();

        // id =  $(attr).data('video_id');
        $(".submateri a").each(function() {
          console.log('id ke : '+$(this).data('video_id'));
          if($(this).data('video_id') == video_id){
            $(this).addClass("active");
            console.log('^active');
          }else{
            $(this).removeClass("active");
          }
        })
      })
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.apps', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>