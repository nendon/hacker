<?php $__env->startSection('title','Daftar | '); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
<?php $__env->startSection('content'); ?>
<div id="sign-container">
    <div class="tab-btn-container">
        <a href="<?php echo e(url('contributor/register')); ?>" id="tab-1">Daftar</a>
        <a href="<?php echo e(url('contributor/login')); ?>" id="tab-2" style="background-color: #ededed">Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content">
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success">
                    <strong>Sukses !</strong> <?php echo e(Session::get('success')); ?>.
                </div>
            <?php endif; ?>
          <?php if(count($errors) > 0): ?>
              <div class="alert alert-danger">
                  <ul>
                      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><?php echo e($error); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
              </div>
          <?php endif; ?>

            <form action="<?php echo e(url('contributor/register')); ?>" method="post">
              <?php echo e(csrf_field()); ?>

                <div class="form-group <?php if($errors->has('username')): ?> has-error <?php endif; ?>">
                    <input type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" placeholder="Username">
                    <?php if($errors->has('username')): ?> <p class="help-block"><?php echo e($errors->first('username')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email">
                    <?php if($errors->has('email')): ?> <p class="help-block"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <?php if($errors->has('password')): ?> <p class="help-block"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('password_confirmation')): ?> has-error <?php endif; ?>">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                    <?php if($errors->has('password_confirmation')): ?> <p class="help-block"><?php echo e($errors->first('password_confirmation')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="checkbox" class="" value="syarat" required=""><b>Saya Setuju dengan semua persyaratan layanan</b>
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
            </form>
        </div>
        <div id="tab-2-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="#"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form> -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#tgl_lahir').datepicker({
    });
});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('contrib.home.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>