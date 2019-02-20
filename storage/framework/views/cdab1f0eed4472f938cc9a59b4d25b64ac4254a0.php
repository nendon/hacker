<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Daftar Kategori
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tambah Kategori
                            </h2>
                            <div class="header-dropdown m-r--5">
                                <a href="<?php echo e(action('KategoriController@create')); ?>" class="btn btn-primary waves-effect">Tambah Kategori</a>
                            </div>
                        </div>
                        <div class="body">
                            <?php if(Session::has('success-create')): ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                                    <?php echo e(Session::get('success-create')); ?>

                                </div>
                            <?php endif; ?>


                            <?php if(Session::has('success-delete')): ?>
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                                    <?php echo e(Session::get('success-delete')); ?>

                                </div>
                            <?php endif; ?>
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Kategori</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Kategori</th>
                                    <th>Icon</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kategoris): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($kategoris->id); ?></td>
                                    <td><?php echo e($kategoris->title); ?></td>
                                    <td><i class="material-icons"><?php echo e($kategoris->image); ?></i></td>
                                    <td><?= nl2br($kategoris->description);?></td>
                                    <td>
                                        <form id="<?php echo e($kategoris->id); ?>" action="<?php echo e(url('system/cat/'.$kategoris->id)); ?>" method="post">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a href="<?php echo e(url('system/cat/'.$kategoris->id.'/edit')); ?>" class="btn btn-info btn-xs"><i class="material-icons">remove_red_eye
                                                </i></a>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="checkdelete(<?php echo e($kategoris->id); ?>)"><i class="material-icons">close</i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>