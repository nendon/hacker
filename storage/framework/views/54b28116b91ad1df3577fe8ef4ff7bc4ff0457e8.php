<?php $__env->startSection('title','Kursus Online Jaringan dan Server | Cilsy Fiolution'); ?>
<?php $__env->startSection('description', 'Satu-satunya Kursus Online Jaringan & Server yang dipandu sampai bisa. Bergabung sekarang dengan 2000++ pendaftar lainnya. Daftar. Interaktif. Bisa konsultasi dengan Trainer Profesional via chat dan remote teamviewer. Fleksibel. Belajar secara online kapanpun dimanapun sesuka hati'); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('web.blocks.main-banner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.bootcamp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.tutorial', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.guide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.testimoni', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('web.blocks.faq', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>