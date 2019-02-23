<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('breadcumbs'); ?>
<div id="navigation">
		<ul class="breadcrumb">
				<li><a href="<?php echo e(url('contributor/dashboard')); ?>">Dashboard</a></li>
        <li><a href="<?php echo e(url('contributor/income')); ?>">Kelola pendapatan</a></li>
        <li>Info Rekening</li>
		</ul>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
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
		<div class="box-white">
	    <div class="form-title">
	      <h3>Edit Rekening</h3>
	    </div>
	     <form class="form-horizontal form-contributor" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				<input type="hidden" name="method" value="PUT">
				<div class="form-group">
	        <label class="col-sm-2 control-label">Bank</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name= "bank" placeholder="Contoh: Mandiri" value="<?php echo e($row->bank); ?>">
	        </div>
	      </div>

	      <div class="form-group">
	        <label class="col-sm-2 control-label">No Rekening</label>
	        <div class="col-sm-10">
	        <input type="text" class="form-control" name= "noreg" placeholder="Contoh: 151 90002 982"value="<?php echo e($row->account_no); ?>">
	        </div>
	      </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Penerima</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name= "name" placeholder="Contoh: Andryana" value="<?php echo e($row->holder); ?>">
            </div>
          </div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10 text-right">
	          <a href="<?php echo e(url('contributor/income')); ?>" class="btn btn-danger">Batal</a>
	          <button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>