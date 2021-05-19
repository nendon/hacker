
<?php if(Session::has('success')): ?>
  <div class="alert alert-success">
    <strong>Selamat!</strong> <?php echo e(Session::get('success')); ?>.
  </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
  <div class="alert alert-danger">
    <strong>Error!</strong> <?php echo e(Session::get('error')); ?>.
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
