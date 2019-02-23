<?php $__env->startSection('content'); ?>
    <section class="content">
    <div class="container-fluid">
        <!-- #END# Vertical Layout -->
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Bootcamp Sub Kategori
                        </h2>
                    <div class="body">
                        <?php if($errors->all()): ?>
                            <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $error . "</br>"; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(url('system/bootcampsubcat/'.$bsc->id)); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="_method" value="PUT">
                            <!-- input type="hidden" name="enable" value="1"> -->
                            <div class="form-line">
                                <select class="form-control show-tick" name="bcid">
                                    <option value="">-- Please Select Sub Kategori --</option>
                                    <?php $__currentLoopData = $bcid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcids): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bcids->id); ?>"><?php echo e($bcids->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Title</label>
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control" value="<?php echo e($bsc->title); ?>">
                                    
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <h2 class="card-inside-title">Deskripsi</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="4" name="deskripsi" class="form-control no-resize" value="" placeholder="Please type what you want..."><?php echo e($bsc->deskripsi); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>