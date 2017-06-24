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
  <div class="panel-heading">
    <span class="font-bold">Automated Reports</span><span class="text-muted"> <small>(Sent Midnight Everyday)</small></span>
    <button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target=".add-email"><li class="fa fa-plus"></li> Add Email</button>
  </div>
  <div class="panel-body">
    <?php foreach($reports as $report): ?>
    <?php echo Form::open(['method'=>'PUT','action'=>['Admin\ReportsController@updateReports', $report->id ]]); ?>

    <?php echo e(Form::hidden('approved', false)); ?>

    <div class="form-group">
      <div class="checkbox col-sm-offset-1">
        <label class="i-checks">
          <input name="status" type="checkbox" value="<?php echo e($report->status); ?>" <?php if($report->status): ?> checked <?php endif; ?>>
          <i></i>
          <?php echo e($report->description); ?>

        </label>
        <button type="submit" class="btn btn-xs btn-info pull-right">Update Report</button>
      </div>
      <div class="padder-lg col-sm-offset-1">
        <?php foreach($report->users as $user): ?>
        <label class="label label-info bg-light"> <?php echo e($user->email); ?> <a data-toggle="modal" data-target=".remove-email-<?php echo e($user->id); ?><?php echo e($report->id); ?>"><i class="fa fa-times"></i></a></label>
      <div class="modal fade remove-email-<?php echo e($user->id); ?><?php echo e($report->id); ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info dk">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="blue bigger text-center">
                Remove Email</h4>
              </div>
              <div class="modal-body">
                <div class="row text-center">
                  <div class="col-xs-12 col-sm-12">
                    <p>Are you sure you want to <b>remove</b> <?php echo e($user->full_name); ?>: <?php echo e($user->email); ?> from the automated report?</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer bg-light bg">
                <?php echo Form::open(); ?>

                <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                <?php echo Form::close(); ?>

                <?php echo Form::open(['method'=>'POST','action'=>['Admin\ReportsController@removeEmail']]); ?>

                <input type="hidden" name="report_id" value="<?php echo e($report->id); ?>"/>
                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>"/>
                <?php echo Form::submit('Remove Email', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                <?php echo Form::close(); ?>

              </div>
            </div>
          </div><!-- /. modal dialog --><br>
        </div>
        <!-- remove email-->


        <?php endforeach; ?>
        </div>
      </div>
      <?php echo Form::close(); ?>

      <div class="line line-dashed b-b line-lg"></div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Add email-->
  <div class="modal fade add-email" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info dk">
          <h4 class="font-thin text-center">Add an Email<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <?php echo Form::open(['method'=>'POST', 'action'=>['Admin\ReportsController@addEmail']]); ?>

              <div class="form-group col-md-12">
                <div class="input-group m-b col-md-12">
                  <select name="user_id" class="form-control text-capitalize m-b" value="<?php echo e(Request::old('user_id')); ?>" required>
                    <option value="">Select a User...</option>
                    <?php foreach($users as $user): ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->full_name); ?> (<?php echo e($user->staff_id); ?>) - <?php echo e($user->email); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="input-group m-b col-md-12">
                  <select name="report_id" class="form-control text-capitalize m-b" value="<?php echo e(Request::old('report_id')); ?>" required>
                    <option value="">Select User Role...</option>
                    <?php foreach($reports as $report): ?>
                    <option value="<?php echo e($report->id); ?>"><?php echo e($report->description); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light lt">
          <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
          <?php echo Form::submit('Add Email', ['class' => 'btn btn-success btn-sm pull-right']); ?>

          <?php echo Form::close(); ?>

        </div>
      </div>
    </div><!-- /. modal dialog -->
  </div><!-- /. modal-->
