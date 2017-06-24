<!-- 

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/password/reset')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" name="token" value="<?php echo e($token); ?>">

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(isset($email) ? $email : old('email')); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> -->




<?php $__env->startSection('header'); ?>
<?php echo $__env->make('templates.sub-sections.nav.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-header'); ?>
<?php echo $__env->make('templates.sub-sections.nav.main-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sign-in'); ?>


<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Reset Password</div>
    <div class="panel-body">
      <form role="form" method="POST" action="<?php echo e(url('/password/reset')); ?>"><?php echo e(csrf_field()); ?>

          <input type="hidden" name="token" value="<?php echo e($token); ?>">
          <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?> focus">
            <input class="form-control username focus" type="email" name="email" autocomplete="off" value="<?php echo e(old('email')); ?>" placeholder="Enter email" required>
            <?php if($errors->has('email')): ?>
            <span class="help-block text-danger text-center">
                <small><strong><?php echo e($errors->first('email')); ?></strong></small>
            </span>
            <?php endif; ?>
        </div>

        <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
            <input class="form-control password" placeholder="Password" type="password" name="password" autocomplete="off" required>
            <?php if($errors->has('password')): ?>
            <span class="help-block">
                <small><strong><?php echo e($errors->first('password')); ?></strong></small>
            </span>
            <?php endif; ?>
        </div>

        <div class="form-group <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
            <input class="form-control password" placeholder="Password Confirmation" type="password" name="password_confirmation" autocomplete="off" required>
            <?php if($errors->has('password_confirmation')): ?>
            <span class="help-block">
                <small><strong><?php echo e($errors->first('password_confirmation')); ?></strong></small>
            </span>
            <?php endif; ?>
        </div>

        <div class="form-group text-center">
            <a type="submit" href="<?php echo e(url('/')); ?>" class="btn m-b-xs btn-default btn-addon btn-md pull-left">
                <i class="fa fa-lock"></i>Sign in</a>
            <button type="submit" class="btn m-b-xs btn-primary btn-addon btn-md pull-right">
                <i class="fa fa-refresh"></i>Reset Password</button>
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