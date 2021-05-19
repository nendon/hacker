<?php $__env->startSection('title',''); ?>
<link href="<?php echo e(asset('template/kontributor/summernote/summernote.css')); ?>" rel="stylesheet">
<?php $__env->startSection('breadcumbs'); ?>

<div id="navigation">
		<div class="container">
		<ul class="breadcrumb">
						<li><a href="<?php echo e(url('contributor/dashboard')); ?>">Dashboard</a></li>
            <li><a href="<?php echo e(url('contributor/lessons')); ?>">Kelola Tutorial</a></li>
            <li><a href="<?php echo e(url('contributor/lessons/'.$row->id.'/view')); ?>">View Tutorial</a></li>
            <li>Edit tutorial</li>
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
	    <div class="form-title">
	      <h3>Edit Tutorial</h3>
	    </div>
	    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

            <input type="hidden" name="method" value="PUT">
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Judul</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" placeholder="Contoh:Tutorial Administrasi Server dengan ubuntu 12.04" name="title" value="<?php echo e($row->title); ?>">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Deskripsi Singkat</label>
						<div class="col-sm-10">
							<textarea type="text"  required class="form-control" placeholder="deskripsi singkat mengenai tutorial" name="desk_singkat" value="<?php echo e($row->deskripsi_singkat); ?>"></textarea>
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Pilih Kategori</label>
	        <div class="col-sm-10">
	          <select class="form-control" name="category_id">
	            <option value="">-</option>
							<?php foreach ($categories as $key => $value): ?>

		                            <option value="<?php echo e($value->id); ?>" <?php if($value->id==$row->category_id){echo 'selected="selected"';}?>><?php echo e($value->title); ?></option>
							<?php endforeach; ?>
	          </select>
	        </div>
	      </div>
				<div class="form-group">
	        <label class="col-sm-2 control-label">Harga</label>
	        <div class="col-sm-10">
	          <input type="text"  required class="form-control" placeholder="minimum : 10000" name="price" value="<?php echo e($row->price); ?>">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Audiens</label>
						<div class="col-sm-10">
							<input type="text"  required class="form-control" placeholder="Newbie" name="audien" value="<?php echo e($row->audiens); ?>">
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Upload gambar</label>
	        <div class="col-sm-10">
	          <input type="file" name="image" class="form-control">
              <input type="hidden" name="image_text" value="<?php echo e($row->image); ?>" class="form-control">
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Goal Tutorial</label>
						<div class="col-sm-10">
							<textarea id="goal" name="goal" value="<?php echo e($row->goal); ?>"><?php echo e($row->goal); ?></textarea>
						</div>
				</div>
	      <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
							<textarea id="summernote" name="description" value="<?php echo e($row->description); ?>"></textarea>
	        </div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">Requirement</label>
						<div class="col-sm-10">
								<textarea id="textedit" name="requirement" value="<?php echo e($row->requirement); ?>"></textarea>
						</div>
					</div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10 text-right">
	          <a href="<?php echo e(url('contributor/lessons')); ?>" class="btn btn-danger">Batal</a>
					<button type="submit" class="btn btn-info">Submit</button>
	        </div>
	      </div>
	    </form>
		</div>
  </div>
</div>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo e(asset('template/kontributor/summernote/summernote.js')); ?>"></script>
<script>
	$('#summernote').summernote('code', '<?php echo $row->description; ?>');
	$('#textedit').summernote('code', '<?php echo $row->requirement; ?>');
	$('#goal').summernote('code', '<?php echo $row->goal_tutorial; ?>');
	$('#summernote').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,                  // set focus to editable area after initializing summernote 
	});
	$('#textedit').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
	$('#summergoal').summernote({
		height: 500,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true                  // set focus to editable area after initializing summernote
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('contrib.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>