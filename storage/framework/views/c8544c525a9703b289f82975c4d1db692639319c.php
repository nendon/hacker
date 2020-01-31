<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('web.blocks.contrib-profile-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.contrib-profile-body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>