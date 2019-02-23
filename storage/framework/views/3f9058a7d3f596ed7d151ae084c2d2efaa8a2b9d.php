<?php $__env->startSection('title','Ubah Password'); ?>
<?php $__env->startSection('member-content'); ?>
<style>
  .btn-simpan{
    background-color: #2BA8E2;
    border-radius: 3px;
    color: white;
    cursor: pointer;
    display: inline-block;
    font-size: 1em;
    padding: 10px 15px;
  }
</style>
<div>
  <h3>Akun</h3>
  
  <p>
    Kelola akun Anda disini
  </p>
  
  <hr>
</div>
<?php echo $__env->make('web.include.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<form class="form-group" action="<?php echo e(url('member/edit/akun')); ?>" method="post">
  <?php echo e(csrf_field()); ?>

  <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
    <label class="control-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $member->email)); ?>">
      <?php if($errors->has('email')): ?> <p class="help-block"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
  </div>
  <div class="form-group <?php if($errors->has('username')): ?> has-error <?php endif; ?>">
    <label class="control-label">Username</label>
      <input type="text" class="form-control" name="username" value="<?php echo e(old('username',$member->username)); ?>">
      <?php if($errors->has('username')): ?> <p class="help-block"><?php echo e($errors->first('username')); ?></p> <?php endif; ?>
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-simpan">Simpan</button>
  </div>
</form>
<form action="<?php echo e(url('member/change-password')); ?>" method="post">
  <?php echo e(csrf_field()); ?>

  <div class="form-group <?php if($errors->has('current_password')): ?> has-error <?php endif; ?>">
    <label class=" control-label">Password Lama</label>
      <input type="password" class="form-control" name="current_password">
      <?php if($errors->has('current_password')): ?> <p class="help-block"><?php echo e($errors->first('current_password')); ?></p> <?php endif; ?>
  </div>
  <div class="form-group  <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
    <label class="control-label">Password Baru</label>
      <input type="password" class="form-control" name="password">
      <?php if($errors->has('password')): ?> <p class="help-block"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
  </div>
  <div class="form-group  <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">
    <label class="control-label">Konfirmasi Password</label>
      <input type="password" class="form-control"  name="password_confirmation">
      <?php if($errors->has('password_confirmation')): ?> <p class="help-block"><?php echo e($errors->first('password_confirmation')); ?></p> <?php endif; ?>
  </div>

  <div class="form-group">
      <button type="submit" class="btn btn-simpan">Simpan</button>
  </div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.members.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>