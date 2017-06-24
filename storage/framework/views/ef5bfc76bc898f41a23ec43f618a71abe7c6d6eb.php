<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header-appointments'); ?>
	<?php echo $__env->make('templates.pharmacy.header-inventory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header-appointments'); ?>
	<?php echo $__env->make('templates.pharmacy.main-header-inventory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php if(Auth::user()->hasRole('administrator')): ?>
	<?php $__env->startSection('aside'); ?>
		<?php echo $__env->make('templates.admin.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $__env->stopSection(); ?>
<?php elseif(Auth::user()->hasRole('pharmacy')): ?>
	<?php $__env->startSection('aside'); ?>
		<?php echo $__env->make('templates.pharmacy.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('doctor-appointments-body'); ?>
	<?php echo $__env->make('templates.pharmacy.inventory-body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>