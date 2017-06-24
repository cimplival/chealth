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
        <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".create-ward"><i class="fa fa-building"></i> Create a Ward</button>
        <?php echo Form::open(array('route' => 'search-wards', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" autocomplete="off" placeholder="Search Wards" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-xs table-responsive">
                <thead>
                    <tr>
                        <th style="width:15%">Ward Name</th>
                        <th style="width:25%">Ward Notes</th>
                        <th style="width:15%">Ward Status</th>
                        <th style="width:20%">Created Date</th>
                        <th class="text-center" style="width:25%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($wards->reverse() as $ward): ?>
                    <tr>
                        <td><?php echo e($ward->ward_name); ?></td>
                        <td><?php echo e(str_limit($ward->ward_notes, $limit = 30, $end = '...')); ?></td>
                        <td>
                            <?php if($ward->ward_status==0): ?>
                            Closed
                            <?php elseif($ward->ward_status==1): ?>
                            Open
                            <?php else: ?> 
                            Full Capacity
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(Carbon\Carbon::parse($ward->created_at)->toFormattedDateString()); ?> </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".view-ward<?php echo e($ward->id); ?>"><i class="fa fa-eye"></i> View</button>
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit<?php echo e($ward->id); ?>"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete<?php echo e($ward->id); ?>"><i class="fa fa-trash"></i> Trash</button>
                        </td>
                    </tr>
                    <!--  View Ward -->
                    <div class="modal fade view-ward<?php echo e($ward->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">View Ward <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-10 col-md-offset-1">
                                            <span class="font-bold">Ward Name:</span> <?php echo e($ward->ward_name); ?> <br>
                                            <span class="font-bold">Ward Capacity:</span> <?php echo e($ward->ward_capacity); ?> <br>
                                            <span class="font-bold">Ward Notes:</span><?php echo e($ward->ward_notes); ?>  <br>
                                            <span class="font-bold"> Ward Status:</span> <?php if($ward->ward_status==0): ?>
                            Closed
                            <?php elseif($ward->ward_status==1): ?>
                            Open
                            <?php else: ?> 
                            Full Capacity
                            <?php endif; ?><br>
                                            <span class="font-bold">Created Date:</span> <?php echo e(Carbon\Carbon::parse($ward->created_at)->toDayDateTimeString()); ?> <br>
                                            <span class="font-bold">Updated Date:</span> <?php echo e(Carbon\Carbon::parse($ward->updated_at)->toDayDateTimeString()); ?> <br>
                                            <span class="font-bold">Created by:</span> <?php echo e($ward->user->full_name); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                    <!-- View Ward -->
                    <!-- Edit Ward -->
                    <div class="modal fade edit<?php echo e($ward->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        Edit Ward</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php echo Form::open(['method'=>'PUT','action'=>['Nurse\WardController@updateWard', $ward->id]]); ?>

                                            <div class="form-group col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="ward_name" placeholder="Ward_name" value="<?php echo e($ward->ward_name); ?>" autocomplete="off" required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="ward_capacity" placeholder="Ward capacity" value="<?php echo e($ward->ward_capacity); ?>" autocomplete="off" required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <textarea type="text" class="form-control" name="ward_notes"><?php echo e($ward->ward_notes); ?></textarea>
                                                </div>
                                                <?php if($ward->ward_status==1): ?>
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Ward Status:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="ward_status" value="1" checked>
                                                            <i></i>
                                                            Open
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="ward_status" value="0">
                                                            <i></i>
                                                            Closed
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php else: ?>
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Ward Status:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="ward_status" value="1">
                                                            <i></i>
                                                            Open
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="ward_status" value="0" checked>
                                                            <i></i>
                                                            Closed
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="hidden" class="form-control" name="from_user" placeholder="Updated By"
                                                    value="<?php echo e($ward->from_user); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php echo Form::submit('Update Ward', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Edit Ward -->
                        <!-- Delete Ward -->
                        <div class="modal fade delete<?php echo e($ward->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content text-center">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger">
                                            Delete Ward</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p>Do you want to <b>permanently</b> delete this ward?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <?php echo Form::open(); ?>

                                            <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                            <?php echo Form::close(); ?>

                                            <?php echo Form::open(['method'=>'DELETE','action'=>['Nurse\WardController@deleteWard',$ward->id]]); ?>

                                            <?php echo Form::submit('Delete Ward', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Delete Ward -->
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer bg-light lt text-center">
                <ul class="pagination">
                    <?php echo e($wards->links()); ?>

                </ul>
            </div>
        </div>

        <!--  Create a Ward -->
        <div class="modal fade create-ward" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info dk">
                        <h4 class="font-thin text-center">Create a Ward <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::open(['method'=>'POST', 'action'=>['Nurse\WardController@createWard']]); ?>

                                <div class="form-group col-md-12">
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" class="form-control" name="ward_name" placeholder="Ward Name" value="<?php echo e(Request::old('ward_name')); ?>" autocomplete="off" required>
                                    </div>
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" class="form-control" name="ward_capacity" placeholder="Ward Capacity" value="<?php echo e(Request::old('ward_capacity')); ?>" autocomplete="off" required>
                                    </div>
                                    <div class="input-group m-b col-md-12">
                                        <textarea class="form-control" name="ward_notes" placeholder="Ward Notes" value="<?php echo e(Request::old('ward_notes')); ?>" autocomplete="off" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>
                                            Ward Status:
                                        </label>
                                        <div class="radio">
                                            <label class="i-checks">
                                                <input type="radio" name="ward_status" value="1" checked>
                                                <i></i>
                                                Open
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label class="i-checks">
                                                <input type="radio" name="ward_status" value="0">
                                                <i></i>
                                                Closed
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light lt">
                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                        <?php echo Form::submit('Create Ward', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div><!-- /. modal dialog -->
        </div><!-- /. modal-->
        <!-- Create a Ward -->


