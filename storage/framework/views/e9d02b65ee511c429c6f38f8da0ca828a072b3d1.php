<?php $__env->startSection('title','Cilsy Fiolution | Login Contributor'); ?>
<?php $__env->startSection('content'); ?>
<div id="sign-container">
    <div class="tab-btn-container">
      <a href="<?php echo e(url('contributor/register')); ?>" id="tab-1" style="background-color: #ededed">Daftar</a>
      <a href="<?php echo e(url('contributor/login')); ?>" id="tab-2" >Masuk</a>
    </div>

    <div class="tab-content">
        <div id="tab-1-content" style="display: none;">
            <!-- <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap :</label>
                    <input type="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Konfirmasi Password :</label>
                    <input type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">DAFTAR</button>
            </form> -->
        </div>
        <div id="tab-2-content" >

            <?php if(Session::has('success')): ?>
              <div class="alert alert-success">
                <strong>Well done!</strong> <?php echo e(Session::get('success')); ?>.
              </div>
            <?php endif; ?>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <form action="<?php echo e(url('contributor/login')); ?>" method="post">
              <?php echo e(csrf_field()); ?>

                <?php if(isset($_GET['next'])): ?>
                <input type="hidden" name="next" value="<?php echo e($_GET['next']); ?>">
                <?php endif; ?>
                <div class="form-group <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
                    <label for="exampleInputPassword1">Email :</label>
                    <input type="email" class="form-control" name="email">
                    <?php if($errors->has('email')): ?> <p class="help-block"><?php echo e($errors->first('email')); ?></p> <?php endif; ?>
                </div>
                <div class="form-group <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
                    <label for="exampleInputFile">Password :</label>
                    <input type="password" class="form-control" name="password">
                    <?php if($errors->has('password')): ?> <p class="help-block"><?php echo e($errors->first('password')); ?></p> <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">MASUK</button>
                <div>
                    <a href="<?php echo e(url('contributor/password/reset')); ?>"><p style="text-align: center;margin-top: 15px;">Lupa Password ?</p></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('contrib.home.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>