<?php if(Session::has('info')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('success')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="panel panel-default">
    <div class="panel-heading font-bold">
      General Settings
    </div>
    <div class="panel-body">
      <?php echo Form::open(['method'=>'PUT','action'=>['Admin\SettingsController@updateSettings', 1]]); ?>

        <div class="form-group">
          <label class="col-sm-2 control-label">Name of Institution</label>
          <div class="col-sm-10">
            <input name="name_of_institution" class="form-control" type="text" value="<?php echo e($settings->name_of_institution); ?>">
            <span class="help-block m-b-none text-italic"><small>Name of the Institution that owns a license to use this software.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tagline</label>
          <div class="col-sm-10">
            <input name="tagline" class="form-control" type="text" value="<?php echo e($settings->tagline); ?>">
            <span class="help-block m-b-none text-italic"><small>Tagline of the Institution that owns a license to use this software.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email address</label>
          <div class="col-sm-10">
            <input name="email_address" class="form-control" type="email" value="<?php echo e($settings->email_address); ?>" >
            <span class="help-block m-b-none text-italic"><small>Email address of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-10">
            <input name="phone_no" class="form-control" type="phone" value="<?php echo e($settings->phone_no); ?>" >
            <span class="help-block m-b-none text-italic"><small>Main Phone no. of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Currency</label>
          <div class="col-sm-10">
            <input name="currency" class="form-control" type="phone" value="<?php echo e($settings->currency); ?>" >
            <span class="help-block m-b-none text-italic"><small>Currency</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Postal Address</label>
          <div class="col-sm-10">
            <input name="postal_address" class="form-control" type="text" value="<?php echo e($settings->postal_address); ?>" >
            <span class="help-block m-b-none text-italic"><small>Postal address of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Location</label>
          <div class="col-sm-10">
            <input name="location" class="form-control" type="text" value="<?php echo e($settings->location); ?>" >
            <span class="help-block m-b-none text-italic"><small>Location of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Website</label>
          <div class="col-sm-10">
            <input name="website" class="form-control" type="text" value="<?php echo e($settings->website); ?>" >
            <span class="help-block m-b-none text-italic"><small>Website of the Institution.</small></span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-8">
            <button type="submit" class="btn btn-success btn-sm pull-right">Save General Settings</button>
          </div>
        </div>
      <?php echo Form::close(); ?>

    </div>
  </div>