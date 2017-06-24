<?php $__env->startSection('header'); ?>
<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
<?php echo $__env->make('templates.reception.registration-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php if(Auth::user()->hasRole('administrator')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.admin.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('receptionist')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.reception.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('body'); ?>
<?php echo $__env->make('templates.reception.new-appointment-body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>