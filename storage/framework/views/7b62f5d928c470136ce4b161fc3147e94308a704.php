<?php $__env->startSection('title', $members->full_name); ?>
<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('template/web/css/landing.css')); ?>" rel="stylesheet">
<style>
        .btn-tag {
            display: inline-block;
            position: relative;
            margin: 5px 10px 5px 0px;
            background-color: white;
            color:black;
            padding:10px 25px;
            border-radius:50px;
          }
</style>
<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-12 col-sm-12">
                    <?php if($members->avatar != null): ?>
                    <img class="img-circle img-responsive" src="<?php echo e($members->avatar); ?>" alt="avatar" style="height: 150px; width: 150px;">
                    <?php else: ?>
                    <img class="img-circle img-responsive" src="<?php echo e(asset(profil())); ?>" alt="avatar" style="height: 150px; width: 150px;">
                    <?php endif; ?>
            </div>
            <div class="col-md-10">
                <h2><?php echo e(ucwords($members->full_name)); ?></h2>
                <h4><?php echo e(ucwords($members->role)); ?> di <?php echo e(ucwords($members->instansi)); ?></h4>
                <p><i class="fa fa-map-marker" style="font-size:20px;color:white"></i> Bandung, Jawa Barat</p>
                <p><?php echo e(substr($members->bio, '0', 800)); ?></p>
                
                <?php $__currentLoopData = explode(',', $members->keahlian); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <div class="btn-tag">
                        <?php echo e($info); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
    </div>
</section>
<div class="container">
  <?php if(Auth::guard('members')->user()->id != $members->id): ?>
    <?php if($members->public == 0 ): ?>
      <div class="row">
        <h4>Profil member ini tidak publik</h4>
      </div>
    <?php else: ?>
          <div class="row">
              <h4>Tutorial yang <?php echo e($members->full_name); ?> ikuti</h4>
              <?php
        if(!count($lessons) == 0) {
                  $i = 1;
                  foreach ($lessons as $key => $lesson): ?>
                      <?php if ($i <= 4) {?>
                        <div class="col-md-3">
                          <a href="<?php echo e(url('kelas/v3/'.$lesson->slug)); ?>" style="text-decoration: none;">
                            <div class="card">
                              <?php if (!empty($lesson->image)) {?>
                                <img src="<?php echo e(asset($lesson->image)); ?>" alt="" class="img-responsive">
                              <?php } else {?>
                                <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                              <?php }?>
                              <div class="caption">
                                <p><?php echo e($lesson->title); ?></p>
                              </div>
                              <div class="footer">
                                <p>Total <?php echo Helper::getTotalVideo($lesson->lesson_id);?> Video</p>
                              </div>
                            </div>
                          </a>
                        </div>
                    <?php } ?>
                    <?php $i++;?>

                <?php endforeach; 
                }else{ ?>
                <div class="alert alert-danger" role="alert">
                Belum ada tutorial yang anda ikuti 
                </div>

                <?php } ?>
      </div>
    <?php endif; ?>
    <?php else: ?>
    <div class="row">
        <h4>Tutorial yang <?php echo e($members->full_name); ?> ikuti</h4>
        <?php
   if(!count($lessons) == 0) {
            $i = 1;
            foreach ($lessons as $key => $lesson): ?>
                <?php if ($i <= 4) {?>
                  <div class="col-md-3">
                    <a href="<?php echo e(url('kelas/v3/'.$lesson->slug)); ?>" style="text-decoration: none;">
                      <div class="card">
                        <?php if (!empty($lesson->image)) {?>
                          <img src="<?php echo e(asset($lesson->image)); ?>" alt="" class="img-responsive">
                        <?php } else {?>
                          <img src="<?php echo e(asset('template/web/img/no-image-available.png')); ?>" alt="" class="img-responsive">
                        <?php }?>
                        <div class="caption">
                          <p><?php echo e($lesson->title); ?></p>
                        </div>
                        <div class="footer">
                          <p>Total <?php echo Helper::getTotalVideo($lesson->id);?> Video</p>
                        </div>
                      </div>
                    </a>
                  </div>
              <?php } ?>
              <?php $i++;?>

          <?php endforeach; 
          }else{ ?>
           <div class="alert alert-danger" role="alert">
           Belum ada tutorial yang anda ikuti 
           </div>

          <?php } ?>
</div>
    <?php endif; ?>
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>