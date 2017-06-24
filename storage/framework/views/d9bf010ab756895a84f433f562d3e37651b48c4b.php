<?php $__env->startSection('header'); ?>
  <?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
  <?php echo $__env->make('templates.sub-sections.nav.main-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sign-in'); ?>
<?php if(session('status')): ?>
<div class="alert alert-success">
  <?php echo e(session('status')); ?>

</div>
<?php endif; ?>

  <div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Forgot My Password</div>
    <div class="panel-body">
      <form role="form" method="POST" action="<?php echo e(url('/password/email')); ?>"><?php echo e(csrf_field()); ?>

      <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?> focus">
        <input class="form-control username focus" type="email" name="email" autocomplete="off" value="<?php echo e(old('email')); ?>" placeholder="Enter email" required>
        <?php if($errors->has('email')): ?>
          <span class="help-block text-danger text-center">
            <small><strong><?php echo e($errors->first('email')); ?></strong></small>
          </span>
          <?php endif; ?>
      </div>

      <div class="form-group text-center">
        <a type="submit" href="<?php echo e(url('/')); ?>" class="btn m-b-xs btn-default btn-addon btn-md pull-left"><i class="fa fa-lock"></i>Sign in</a>
        <button type="submit" class="btn m-b-xs btn-primary btn-addon btn-md pull-right">
        <i class="fa fa-envelope"></i>Send a reset link</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('medical-stats'); ?>
  <?php echo $__env->make('templates.sub-sections.body.medical-stats', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('templates.sub-sections.footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <?php echo $__env->make('templates.main.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.main.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>