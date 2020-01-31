<?php $__env->startSection('content'); ?>

<title>Coupon - Cilsy</title>


<!-- JQuery DataTable Css -->
<link href="<?php echo e(asset('template/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')); ?>" rel="stylesheet">

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Coupon
                <?php
                // $access = PERMISSION_CHECK('create');
                // if($access == true){?>

                <?php //} ?>
                <ol class="breadcrumb breadcrumb-col-pink pull-right">
                    <li><a href="<?php echo e(url('system/dashboard')); ?>">Dashboard</a></li>
                    <li class="active">Coupon</li>
                </ol>
                <!-- <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small> -->
            </h2>

        </div>



        <!-- Result Table -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LIST
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <!-- <form action="<?php echo e(url('master/district/doprint')); ?>" method="post" target="_blank">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="by" value="">
                            <input type="hidden" name="keyword" value="">
                            <button type="submit" class="btn bg-brown waves-effect">Print</button>
                        </form> -->
                        <a href="<?php echo e(url('system/coupon/create')); ?>" class="btn bg-red waves-effect pull-right">Create</a>
                    </ul>
                </div>
                <div class="body">
                    <!-- will be used to show any messages -->


                    <?php echo $__env->make('admin.include.alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Enable</th>
                                    <th>Code</th>
                                    <th>Limit Coupon</th>
                                    <th>Minimum Checkout</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Percent Off</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="result">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->id); ?></td>
                                    <td>
                                        <?php if ($row->enable == 0){ ?>
                                            <div class="label label-danger">No</div>
                                        <?php }else if ($row->enable == 1){ ?>
                                            <div class="label label-success">Yes</div>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo e($row->code); ?></td>
                                    <td><?php echo e($row->limit_coupon); ?></td>
                                    <td><?php echo e($row->minimum_checkout); ?></td>
                                    <td><?php echo e($row->type); ?></td>
                                    <td><?php echo e($row->value); ?></td>
                                    <td><?php echo e($row->percent_off); ?></td>
                                    <td>
                                        <form id="<?php echo e($row->id); ?>" action="<?php echo e(url('system/coupon/'.$row->id)); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="_method" value="DELETE">
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <a href="<?php echo e(url('system/coupon/'.$row->id)); ?>/edit" class="btn bg-pink waves-effect"><i class="material-icons">mode_edit</i></a>
                                                <button type="button" class="btn bg-pink waves-effect" onclick="if (confirm('Are you sure?')) { $('#<?php echo e($row->id); ?>').submit() }"><i class="material-icons">delete</i></button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>ID</th>
                                  <th>Enable</th>
                                  <th>Title</th>
                                  <th>Url</th>
                                  <th>Meta Desc</th>
                                  <th>Tags</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                  <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Result Table -->
</div>
</section>


<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')); ?>"></script>
<!-- <script src="<?php echo e(asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')); ?>"></script> -->
<!-- <script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js')); ?>"></script>

<!-- Custom Js -->
<script src="<?php echo e(asset('template/admin/js/admin.js')); ?>"></script>
<script src="<?php echo e(asset('template/admin/js/pages/tables/jquery-datatable.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>