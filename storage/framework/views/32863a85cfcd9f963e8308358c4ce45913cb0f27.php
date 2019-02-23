<?php $__env->startSection('content'); ?>

<style>
  li.active{
    background-color: #2BA8E2;
    color: white;
  }
</style>
<section class="member-main pt-25 pb-25" style="">
  <div class="container">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <ul class="nav">
            <li class="<?php echo e(request()->is('member/profile/edit') ? 'active' : ''); ?>"><a href="<?php echo e(url('member/profile/edit')); ?>">Profil</a></li>
            <li class="<?php echo e(request()->is('member/change-password') ? 'active' : ''); ?>"><a href="<?php echo e(url('member/change-password')); ?>">Akun</a></li>
            <li class="<?php echo e(request()->is('member/riwayat') ? 'active' : ''); ?>"><a href="<?php echo e(url('member/riwayat')); ?>">Riwayat Pembelian</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9">
            <?php echo $__env->yieldContent('member-content'); ?>
    </div>
  </div>



</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>