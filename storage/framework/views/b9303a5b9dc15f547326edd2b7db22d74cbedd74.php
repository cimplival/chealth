<?php $__env->startSection('header'); ?>
<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
<?php echo $__env->make('templates.main.change-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php if(Auth::user()->hasRole('administrator')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.admin.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('accountant')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.accounts.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('doctor')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.doctor.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('nurse')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.nurse.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('pharmacy')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.pharmacy.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('receptionist')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.reception.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('triage')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.triage.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php if(Auth::user()->hasRole('laboratory')): ?>
<?php $__env->startSection('aside'); ?>
<?php echo $__env->make('templates.lab.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('body'); ?>
<?php if(Session::has('info')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('success')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading font-bold"></div>
		<div class="panel-body">
			<form role="form" method="POST" action="<?php echo e(url('change-password')); ?>"><?php echo e(csrf_field()); ?>

				<div class="form-group <?php echo e($errors->has('old_password') ? ' has-error' : ''); ?>">
					<input class="form-control password focus" placeholder="Original Password" type="password" name="old_password" autocomplete="off" required>
					<?php if($errors->has('old_password')): ?>
					<span class="help-block">
						<small><strong><?php echo e($errors->first('old_password')); ?></strong></small>
					</span>
					<?php endif; ?>
				</div>

				<div class="form-group <?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
					<input class="form-control password" placeholder="New Password" type="password" name="new_password" autocomplete="off" required>
					<?php if($errors->has('new_password')): ?>
					<span class="help-block">
						<small><strong><?php echo e($errors->first('new_password')); ?></strong></small>
					</span>
					<?php endif; ?>
				</div>

				<div class="form-group <?php echo e($errors->has('confirm_password') ? ' has-error' : ''); ?>">
					<input class="form-control password" placeholder="Confirm New Password" type="password" name="confirm_password" autocomplete="off" required>
					<?php if($errors->has('confirm_password')): ?>
					<span class="help-block">
						<small><strong><?php echo e($errors->first('confirm_password')); ?></strong></small>
					</span>
					<?php endif; ?>
				</div>

				<div class="form-group text-center">
					<button type="submit" class="btn m-b-xs btn-sm btn-info pull-right">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>