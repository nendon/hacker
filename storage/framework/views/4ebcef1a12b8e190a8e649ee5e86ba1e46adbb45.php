<?php $__env->startPush('css'); ?>


<?php $__env->stopPush(); ?>

<!-- BEGIN CONTRIBUTORS PROFILE HEADER-->
<section class="contributor-profile-header pt-25 pb-25 mb-25">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
          <img src="<?php echo e(asset('template/kontributor/img/icon/contributor-profesional.png')); ?>" alt="" class="img-responsive img-center" width="150">
      </div>
      <div class="col-md-9 middle-wrap">
        <!-- <div class=""> -->
          <div class="inner">
            <strong><?php echo e($contributors->username); ?></strong>
            <p class="help-block"><?php echo e($contributors->pekerjaan); ?></p>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</section><!-- ./END CONTRIBUTORS PROFILE HEADER -->

<?php $__env->startPush('js'); ?>
<!-- <script type="text/javascript">
  $(document).ready(function () {
    var h = $('.middle-wrap').height();
    $('.middle-wrap').height();
  });
</script> -->


<?php $__env->stopPush(); ?>
