<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
	<?php echo $__env->make('templates.lab.home-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('aside'); ?>
	<?php echo $__env->make('templates.lab.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<?php echo $__env->make('templates.lab.home-blocks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('templates.main.statistics', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('templates.admin.individual-activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>