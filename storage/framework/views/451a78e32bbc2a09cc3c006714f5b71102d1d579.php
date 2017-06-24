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
        <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".create-bed"><i class="fa fa-bed"></i> Create a Bed</button>
        <?php echo Form::open(array('route' => 'search-beds', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Beds" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="table-responsive">
        <table class="table table-hover table-xs table-responsive">
            <thead>
                <tr>
                    <th style="width:10%">Bed No.</th>
                    <th style="width:15%">Ward Name</th>
                    <th style="width:20%">Bed Notes</th>
                    <th style="width:15%">Bed Status</th>
                    <th style="width:15%">Created Date</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($beds->reverse() as $bed): ?>
                <tr>
                    <td><?php echo e($bed->bed_no); ?></td>
                    <td><?php echo e(str_limit($bed->ward->ward_name, $limit = 10, $end = '...')); ?></td>
                    <td><?php echo e(str_limit($bed->bed_notes, $limit = 20, $end = '...')); ?></td>
                    <td>
                    <?php if($bed->bed_status==0): ?>
                        Not Occupied
                    <?php else: ?>
                        Occupied
                    <?php endif; ?>
                    </td>
                    <td><?php echo e(Carbon\Carbon::parse($bed->created_at)->toFormattedDateString()); ?></td>
                    <td class="center">
                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".view-bed<?php echo e($bed->id); ?>"><i class="fa fa-search"></i> View</button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit<?php echo e($bed->id); ?>"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete<?php echo e($bed->id); ?>"><i class="fa fa-trash"></i> Trash</button>
                    </td>
                </tr>
                 <!--  View Bed -->
                    <div class="modal fade view-bed<?php echo e($bed->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">View Bed <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-10 col-md-offset-1">
                                            <span class="font-bold">Bed No. :</span> <?php echo e($bed->bed_no); ?> <br>
                                            <span class="font-bold">Ward Name:</span> <?php echo e($bed->ward->ward_name); ?> <br>
                                            <span class="font-bold">Bed Notes:</span><?php echo e($bed->bed_notes); ?>  <br>
                                           <span class="font-bold">Bed Status:</span> <?php if(($bed->bed_status)==1): ?>
                                                            Enabled
                                                        <?php else: ?>
                                                            Disabled
                                                        <?php endif; ?><br>
                                            <span class="font-bold">Created Date:</span> <?php echo e(Carbon\Carbon::parse($bed->created_at)->toDayDateTimeString()); ?> <br>
                                            <span class="font-bold">Updated Date:</span> <?php echo e(Carbon\Carbon::parse($bed->updated_at)->toDayDateTimeString()); ?> <br>
                                            <span class="font-bold">Created by:</span> <?php echo e($bed->users->full_name); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div><!-- /. modal-->
                <!-- View Bed -->
                <!-- Edit Bed -->
                        <div class="modal fade edit<?php echo e($bed->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                        Edit Bed</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php echo Form::open(['method'=>'PUT','action'=>['Nurse\BedController@updateBed', $bed->id]]); ?>

                                            <div class="form-group col-md-10 col-md-offset-1">
                                                <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="bed_no" placeholder="Bed No." value="<?php echo e($bed->bed_no); ?>" required>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <select class="form-control m-b" name="ward_no" value="<?php echo e($bed->ward_no); ?>" required>
                                                            <?php foreach($wards as $ward): ?>
                                                                <option value="<?php echo e($ward->id); ?>"><?php echo e($ward->ward_name); ?></option>
                                                            <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                        <textarea type="text" class="form-control" name="bed_notes" placeholder="Bed Notes"><?php echo e($bed->bed_notes); ?></textarea>
                                                </div>
                                                <?php if($bed->bed_status==1): ?>
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Bed Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="bed_status" value="1" checked>
                                                                <i></i>
                                                                Occupied
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="bed_status" value="0">
                                                                <i></i>
                                                                Not Occupied
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Bed Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="bed_status" value="1">
                                                                <i></i>
                                                                Occupied
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="bed_status" value="0" checked>
                                                                <i></i>
                                                                Not Occupied
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="hidden" class="form-control" name="from_user" placeholder="Updated By"
                                                        value="<?php echo e($bed->from_user); ?>">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php echo Form::submit('Update Bed', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                    <!-- Edit Bed -->
                    <!-- Delete Bed -->
                    <div class="modal fade delete<?php echo e($bed->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content text-center">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                Delete Bed</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Do you want to <b>permanently</b> delete this bed?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <?php echo Form::open(); ?>

                                <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                <?php echo Form::close(); ?>

                                <?php echo Form::open(['method'=>'DELETE','action'=>['Nurse\BedController@deleteBed',$ward->id]]); ?>

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
    <div class="text-center">
        <ul class="pagination">
            <?php echo e($beds->links()); ?>

        </ul>
    </div>
</div>
<!--  Create a Bed -->
    <div class="modal fade create-bed" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info dk">
                    <h4 class="font-thin text-center">Create a Bed <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::open(['method'=>'POST', 'action'=>['Nurse\BedController@createBed']]); ?>

                            <div class="form-group col-md-12">
                                <div class="input-group m-b col-md-12">
                                    <select name="ward_no" class="form-control m-b" required>
                                        <option value="">Select a Ward...</option>
                                        <?php foreach($wards as $ward): ?>
                                            <option value="<?php echo e($ward->id); ?>"><?php echo e($ward->ward_name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>       
                                <div class="input-group m-b col-md-12">
                                    <input type="text" class="form-control" name="bed_no" placeholder="Bed Number" required>
                                </div>
                                <div class="input-group m-b col-md-12">
                                    <textarea class="form-control" name="bed_notes" placeholder="Bed Notes" required></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>
                                        Bed Status:
                                    </label>
                                    <div class="radio">
                                        <label class="i-checks">
                                            <input type="radio" name="bed_status" value="1" checked>
                                                <i></i>
                                                    Enabled
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="i-checks">
                                            <input type="radio" name="bed_status" value="0">
                                                <i></i>
                                                    Disabled
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light lt">
                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                    <?php echo Form::submit('Create Bed', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div><!-- /. modal dialog -->
    </div><!-- /. modal-->
<!-- Create a Ward -->