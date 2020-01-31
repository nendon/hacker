<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
    <div class="container">
		<ul class="breadcrumb">
				<li><a href="<?php echo e(url('contributor')); ?>">Dashboard</a></li>
        <li>Informasi Akun</li>
    </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="box-white">
        <?php if($errors->all()): ?>
         <div class="alert\ alert-danger">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
             <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php echo $error."</br>";?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php endif; ?>
         <?php if(Session::has('success')): ?>
             <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                 <?php echo e(Session::get('success')); ?>

             </div>
         <?php endif; ?>

        <?php if(Session::has('success-delete')): ?>
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo e(Session::get('success-delete')); ?>

          </div>
        <?php endif; ?>
        <?php if(Session::has('no-delete')): ?>
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
              <?php echo e(Session::get('no-delete')); ?>

          </div>
        <?php endif; ?>

        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
          <li class="active"><a href="<?php echo e(url('contributor/account/informasi')); ?>">Informasi Akun</a></li>
          <li class=""><a href="<?php echo e(url('contributor/account/profile')); ?>">Halaman Kontributor</a></li>
        </ul>

        <div class="tab-content" >
        <div class="col-md-12" >
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?php echo e($contrib->email); ?>" disabled>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password Lama</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="old_password" disabled>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password Baru</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="new_password" disabled> 
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Konfirmasi Password Baru</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="new_confirm" disabled>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo e(url('contributor/account/informasi/'.$contrib->id.'/edit')); ?>" class="btn btn-info">Edit</a>
          </div>
        </div>
      </form>
        </div>
        
          </div>
        </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>