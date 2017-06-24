<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
	<?php echo $__env->make('templates.admin.activities-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('aside'); ?>
	<?php if(Auth::user()->hasRole('administrator')): ?>
		<?php echo $__env->make('templates.admin.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('accountant')): ?>
		<?php echo $__env->make('templates.accounts.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('receptionist') && !Auth::user()->hasRole('doctor')): ?>
		<?php echo $__env->make('templates.reception.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('triage')): ?>
		<?php echo $__env->make('templates.triage.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('doctor')): ?>
		<?php echo $__env->make('templates.doctor.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('pharmacy')): ?>
		<?php echo $__env->make('templates.pharmacy.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('nurse')): ?>
		<?php echo $__env->make('templates.nurse.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php elseif(Auth::user()->hasRole('laboratorist')): ?>
		<?php echo $__env->make('templates.lab.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<?php echo $__env->make('templates.admin.activities-body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>