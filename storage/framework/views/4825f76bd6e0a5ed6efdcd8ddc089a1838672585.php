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
        <div class="row padder-md">
            <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".create-backup"><i class="fa fa-database"></i> Create Backup</button>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-xs table-responsive">
                <thead>
                    <tr>
                        <th style="width:35%">Latest Backups</th>
                        <th style="width:20%">File Size</th>
                        <th class="text-center" style="width:20%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($files as $file): ?>
                    <tr>
                        <td><span class="text-ellipsis"><?php echo e($file->getFilename()); ?></span></td>
                        <td><span class="text-ellipsis"><?php echo e($file->getSize()); ?> Bytes</span></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".restore-<?php echo e(str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))); ?>"><i class="fa fa-history"></i> Restore</button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-<?php echo e(str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))); ?>"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <!--  Restore Backup -->
                    <div class="modal fade restore-<?php echo e(str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Restore a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@restoreBackup']]); ?>

                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12 text-center">
                                                    <label class="text-center">Do you want to restore this backup?</label>
                                                    <input type="hidden" class="form-control" name="backup_name" value="<?php echo e($file->getRealpath()); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    <?php echo Form::submit('Restore Database', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                    <!--  Delete Backup -->
                    <div class="modal fade delete-<?php echo e(str_replace(":","-", preg_replace('/\s+/', '', chop($file->getFilename(), ".zip")))); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Delete a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@deleteBackup']]); ?>

                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12 text-center">
                                                    <label class="text-center">Do you want to delete this backup?</label>
                                                    <input type="hidden" class="form-control" name="backup_name" value="<?php echo e($file->getRealpath()); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                    <?php echo Form::submit('Delete Database', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer bg-light lt text-center">
        <ul class="pagination">
        </ul>
    </div>
</div>
<!--  Create Backup -->
<div class="modal fade create-backup" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info dk">
                <h4 class="font-thin text-center">Create a Backup <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::open(['method'=>'POST', 'action'=>['Admin\BackupsController@createBackup']]); ?>

                            <div class="input-group m-b col-md-12 text-center">
                                <label class="text-center">Do you want to make a backup manually?</label>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light lt">
                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                <?php echo Form::submit('Backup Database', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div><!-- /. modal dialog -->
</div><!-- /. modal-->

