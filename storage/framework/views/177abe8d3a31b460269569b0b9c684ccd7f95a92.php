
    <!-- will be used to show any messages -->
    <?php if(Session::has('success')): ?>
    <div class="alert alert-success">
      <strong>Well done!</strong> <?php echo e(Session::get('success')); ?>.
    </div>
    <?php endif; ?>
    <?php if(Session::has('info')): ?>
    <div class="alert alert-info">
        <strong>Heads up!</strong> <?php echo e(Session::get('info')); ?>.
    </div>
    <?php endif; ?>
    <?php if(Session::has('warning')): ?>
    <div class="alert alert-warning">
        <strong>Warning!</strong> <?php echo e(Session::get('warning')); ?>.
    </div>
    <?php endif; ?>
    <?php if(Session::has('danger')): ?>
   <div class="alert alert-danger">
       <strong>Oh snap!</strong> <?php echo e(Session::get('danger')); ?>.
   </div>
    <?php endif; ?>
