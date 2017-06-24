<?php if(Session::has('info')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('success')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('error')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Sign in below</div>
    <div class="panel-body">
      <?php echo Form::open(array(
      'url'     => '/',
      'action'  => 'route("home")',
      'method'  => 'POST',
      'role'    => 'form'
      )); ?>

      <div class="form-group">
        <input class="form-control username focus" placeholder="Enter Username" type="text" name="user_name" autocomplete="off" required>
      </div>
      <div class="form-group">
        <input class="form-control password" placeholder="Password" type="password" name="password" autocomplete="off" required>
      </div>
      <div class="checkbox">
        <label class="i-checks">
          <input type="checkbox" name="remember"><i></i> Remember me
        </label>
      </div>

      <div class="form-group">
        <button type="submit" class="btn m-b-xs btn-success btn-addon btn-md pull-right">
        <i class="fa fa-lock"></i>Sign in</button>
      </div><br><br>
      <div class="pull-right">
      <?php echo Form::close(); ?>

      <a href="<?php echo e(url('/password/reset')); ?>"><small class="text-muted text-xs">Forgot your Password?</small></a>
      </div>
    </div>
  </div>
</div>
