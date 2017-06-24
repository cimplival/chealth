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
      Notifications
    </div>
    <div class="panel-body">
        <?php foreach($notifications as $notification): ?>
        <?php echo Form::open(['method'=>'PUT','action'=>['Admin\NotificationsController@updateNotifications', $notification->id ]]); ?>

        <?php echo e(Form::hidden('approved', false)); ?>

        <div class="form-group">
          <div class="checkbox col-sm-offset-1">
              <label class="i-checks">
                <input name="status" type="checkbox" value="<?php echo e($notification->status); ?>" <?php if($notification->status): ?> checked <?php endif; ?>>
                <i></i>
                <?php echo e($notification->notification_name); ?>

              </label>
              <button type="submit" class="btn btn-xs btn-info pull-right">Update Notification</button>
            </div>
        </div>
        <?php echo Form::close(); ?>

        <div class="line line-dashed b-b line-lg"></div>
        <?php endforeach; ?>
    </div>
  </div>