<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main -->
    <main>

      <!-- Section Header -->
      <section class="header" style="background: url(<?php echo e(asset('img/bg-head.jpg')); ?>);background-size: cover;padding-bottom: 80px">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <h6 class="mb-5">Training to Become a <?php echo e($bc->slug); ?> / Couse Part 1</h6>
              <h2 class="mb-4"><?php echo e($course->title); ?></h2>
              <h6>
                <?php echo e($course->deskripsi); ?>

              </h6>
              <br>
              <button class="btn btn-second btn-lg mb-2">Mulai belajar</button>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Content -->
      <section class="container-fluid lesson">
          <div class="row">
            <div class="col-sm-8 col-xs-12">
              <ul class="durationlesson">
                <li style="color:blue;">Target Bootcamp <?php echo e($target->target); ?> Hari</li>
                <li style="color:red;">Deadline <?php echo e($deadline); ?>  Hari</li>
                <li><?php echo e($project->video); ?> Video</li>
                <li><?php echo e($project->project); ?> Project</li>
              </ul>
            </div>
            <div class="col-sm-3 col-xs-10" style="margin-top:10px;">
                <div class="progress">
                <?php 
                $courseprog = number_format($project->hasil/($project->video + $project->project)*100);
                ?>
                    <div class="progress-bar" role="progressbar" style="width:<?php echo e($courseprog); ?>%" aria-valuenow="<?php echo e($courseprog); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="col-sm-1 col-xs-2">
              <?php echo e($courseprog); ?>%
            </div>
          </div>
      </section>

      <section class="mt-5">

        <!-- Container -->
        <div class="container">
          
          <!-- Content Timeline -->
          <ul class="timelines">
            <?php
            if(!$tutor->expired_at){
            $expired = DB::table('bootcamp_member')->where('bootcamp_id', $bc->id)->where('member_id',Auth::guard('members')->user()->id )
                      ->select(DB::raw('DATE_ADD( start_at, INTERVAL target day) as exp'))->first();

            $exp = DB::table('bootcamp_member')->where('bootcamp_id',$bc->id)->where('member_id', Auth::guard('members')->user()->id)->update([
                    'expired_at' => $expired->exp,
                  ]);
            }
             $i = 1;
             $a =1;
          foreach ($stn as $key => $section): 
            $valid = DB::table('section')
                   ->join('video_section', 'section.id','video_section.section_id')
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
          ?>
             
            <li>
              <div class="timelines-number"><?php echo $i; ?></div>
              <div class="timelines-content">
                <div class="row box p-0">
                  <div class="col-xs-12">
                    <h6>Lesson <?php echo $i; ?></h6> <?php $i++;?> 
      
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <h4><?php echo e($section->title); ?></h4>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                          1 Jam 20 Menit
                        </div>
                        <div class="col-md-2 col-sm-5 col-xs-5 mt-3">
                            <div class="progress">
                            <?php ?>
                              <div class="progress-bar" role="progressbar" style="width: <?php echo e($persen); ?>%" aria-valuenow="<?php echo e($persen); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            <?php ?>  
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-1 p-0 pt-1">
                        <?php echo e($persen); ?>%
                        </div>
                    </div>
      
                    <p>
                     <?php echo e($section->deskripsi); ?>

                    </p>
      
                    <br>

                    <div class="collapse" id="<?php echo e($section->id); ?>">

                      <ul class="lesson-detail">
                        <?php
                      foreach ($section->video_section as $key => $vs): ?>
                        <li>
                            <h4><i class="fas fa-play-circle"></i><?php echo e($vs->title); ?></h4>
                            <div class="row">
                              <div class="col-xs-10">
                                <?php echo e($vs->deskripsi_video); ?>  
                              </div>
                              <div class="col-sm-1 col-xs-2 p-0">
                                <?php echo e($vs->durasi); ?>

                              </div>
                              <div class="col-xs-1 p-0">
                              <?php
                              
                              $cek = DB::table('section')->join('video_section', 'section.id', 'video_section.section_id')
                              ->leftjoin('history', 'video_section.id', 'history.video_id')
                              ->where('video_section.id', $vs->id)->get();
                                foreach ($cek as $key => $cek): 
                                    if($cek->hist){?>
                                    <i class="fa fa-check-circle"></i>
                                  <?php 
                                    }else{ ?>
                                    <i class="fa fa-circle"></i>
                                    <?php    } 
                                endforeach; ?>
                              </div>
                            </div>
                        </li>
                      <?php endforeach; ?>
                      </ul>

                    </div>
                  </div>
                  <?php
                 
                   $n = $valid->posisi;
                   $sect = $valid->section;

                   ?>
                    
                               
                    <div class="col-xs-12 px-5 py-3 bg-grey">
                        <a class="collap" id="<?php echo "collapse-".$a ?>" data-toggle="collapse" href="#<?php echo e($section->id); ?>" role="button"><span>Lihat Detail Lesson <i class="fa fa-chevron-down"></i></span></a>
                        <?php 
                        if($valid->project == $valid->hasil)    {   ?> 
                        <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/videoPage/'.$section->id)); ?>" class="btn btn-primary float-right">Selesai Belajar</a>
                        <?php }else{
                        
                          if($valid->posisi == '1'){ ?>
                         <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/videoPage/'.$section->id)); ?>" class="btn btn-primary float-right">Mulai Belajar</a>
                          <?php }else{
                            $n = $valid->posisi-1;
                            $sect = $valid->section-1;
                            
                            $lihat = DB::table('section')
                                    ->join('video_section', 'section.id','video_section.section_id')
                                    ->leftjoin('project_section', 'section.id', 'project_section.section_id')
                                    ->leftjoin('project_user', function($join){
                                    $join->on('project_section.id', '=', 'project_user.project_section_id')
                                    ->where('project_user.member_id', '=', Auth::guard('members')->user()->id);})
                                    ->leftjoin('history', function($join){
                                      $join->on('video_section.id', '=', 'history.video_id')
                                      ->where('history.member_id', '=', Auth::guard('members')->user()->id);})
                                    ->where('section.id', $sect)->where('section.position', $n)
                                    ->select('section.id as section', DB::raw('count( DISTINCT video_section.id) + count(distinct project_section.id) as project'), DB::raw('count(DISTINCT project_user.id)+ count(distinct history.id) as hasil'))
                                    ->groupby('section.id')
                                    ->first();
                                  
                            if($lihat->project == $lihat->hasil){ 
                              if(!$exp){
                              ?>
                              <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/videoPage/'.$section->id)); ?>" class="btn btn-primary float-right">Mulai Belajar</a>
                            <?php 
                              }else{ ?>
                              <a href="<?php echo e(url('bootcamp/'.$bc->slug.'/videoPage/'.$section->id)); ?>" class="btn btn-primary float-right">Retake</a>
                           <?php     
                              }
                          }else{ ?>
                        <a disabled class="btn btn-primary float-right disable">Belum Terbuka</a>

                         
                            <?php }
                        }
                        
                        }
                         ?>
                    </div>
                      

                  </div>
                </div>
            </li>
            <?php $a++;?>
            <?php endforeach; ?>

          </ul>
        </div>

      </section>

    </main>


    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-2.2.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script>
    $('.collap').click(function(e){
      var datatarget =  $(this).attr("href");
      var idtarget =  $(this).attr("id");
      $(datatarget).on('shown.bs.collapse', function() {
        $('#'+idtarget).html('Sembunyikan Detail Lesson <i class="fa fa-chevron-up"></i>'); 
      });

      $(datatarget).on('hidden.bs.collapse', function() {
        $('#'+idtarget).html('Lihat Detail Lesson <i class="fa fa-chevron-down"></i>'); 
      });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>