<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
    <div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('contributor')); ?>">Dashboard</a></li>
        <li>Kelola Halaman</li>
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
                 <h4> <i class="icon fa fa-check"></i> Alert!</h4>
                 <?php echo e(Session::get('success')); ?>

             </div>
         <?php endif; ?>

        <?php if(Session::has('success-delete')): ?>
          <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
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
          <li class=""><a href="<?php echo e(url('contributor/account/informasi')); ?>">Informasi Akun</a></li>
          <li class="active"><a href="<?php echo e(url('contributor/account/profile')); ?>">Halaman Kontributor</a></li>
        </ul>

        <div class="tab-content" >

        <!-- left column -->
      <form class="form-horizontal" role="form">
      <div class="col-md-3">
        <div class="text-center">
        <?php if(Helper::contrib('avatar') != null): ?>
          <img src="<?php echo e($contrib->avatar); ?>" class="avatar img-circle" alt="avatar" style="height: 150px; width: 150px;">
        <?php else: ?>
          <img src="<?php echo e(asset(profilcon())); ?>" class="avatar img-circle" alt="avatar" style="height: 150px; width: 150px;">
        <?php endif; ?>
          <h6>Upload a different photo...</h6>
          
          <input type="file" class="form-control" name="avatar" disabled>
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">   
        
          <div class="form-group">
            <label class="col-lg-3 control-label">Username :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo e($contrib->username); ?>" name="username" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo e($contrib->first_name); ?>" name="first_name" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo e($contrib->last_name); ?>" name="last_name" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Pekerjaan :</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo e($contrib->pekerjaan); ?>" name="pekerjaan" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tempat Lahir:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo e($contrib->tempat_lahir); ?>" name="tempat_lahir" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Tanggal Lahir:</label>
            <div class="col-lg-8">
              <div class="input-group date">
              <input type="text" class="form-control" value="<?php echo e($contrib->tanggal_lahir); ?>" name="tanggal_lahir" disabled="">
              <div class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Bio:</label>
            <div class="col-md-8">
              <textarea class="form-control" value="" name="bio" id="" cols="30" rows="10" disabled=""><?php echo e($contrib->deskripsi); ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2 pull-right">
              <a href="<?php echo e(url('contributor/account/profile/'.$contrib->id.'/edit')); ?>" class="btn btn-info">Edit</a>
            </div>
          </div>
      </div>
      </form>
      
          </div>
        </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>