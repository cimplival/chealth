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
        <div class="pull-left">
            <a class="btn btn-default" data-toggle="modal" data-target=".all-reports"><i class="fa fa-file-pdf-o"></i> Reports</a>
        </div>
        <?php echo Form::open(array('route' => 'search-lab', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Lab Requests" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width:25%">Patient</th>
                        <th style="width:20%">Lab Name</th>
                        <th style="width:25%">Lab Notes</th>
                        <th style="width:15%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($labs as $lab_request): ?>
                    <tr>
                        <td><?php echo e($lab_request->patient->first_name); ?> <?php echo e($lab_request->patient->middle_name); ?> <?php echo e($lab_request->patient->last_name); ?></td>
                        <td><?php echo e(str_limit($lab_request->lab_name, $limit = 15, $end = '...')); ?></td>
                        <td>
                            <?php echo e(str_limit($lab_request->lab_notes, $limit = 15, $end = '...')); ?>

                        </td>
                        <td>
                            <?php if($lab_request->status==0): ?>
                            <span class="text-danger">Accounts</span>
                            <?php elseif($lab_request->status==1): ?>
                            Laboratory
                            <?php else: ?> 
                            Completed
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs col-md-12
                            <?php if($lab_request->status==1): ?> btn-info <?php else: ?>
                            btn-default
                            <?php endif; ?> " data-toggle="modal" data-target=".view_lab_request-<?php echo e($lab_request->id); ?>"><i class="fa fa-eye"></i> 
                            <?php if($lab_request->status==0 ||$lab_request->status==2): ?> 
                            View 
                            <?php else: ?>
                            Confirm
                            <?php endif; ?></button>
                        </td>
                    </tr>
                    <!--  Add Confirm Request -->
                    <div class="modal fade view_lab_request-<?php echo e($lab_request->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Lab Request <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="col-md-10 col-md-offset-1">
                                                <label><strong>Patient Name: </strong> <i><?php echo e(\App\Patient::where('id', $lab_request->on_patient)->value('first_name')); ?> <?php echo e(\App\Patient::where('id', $lab_request->on_patient)->value('middle_name')); ?> <?php echo e(\App\Patient::where('id', $lab_request->on_patient)->value('last_name')); ?> (<?php echo e(\App\Patient::where('id', $lab_request->on_patient)->value('med_id')); ?>)</i></label><br>
                                                <label><strong>Doctor Requested:</strong> <i><?php echo e(\App\User::where('id', $lab_request->from_user)->value('full_name')); ?></i></label><hr>
                                                <label><strong>Lab Name:</strong> <i><?php echo e($lab_request->lab_name); ?></i></label><br>
                                                <label><strong>Lab Notes:</strong> <i><?php echo e($lab_request->lab_notes); ?></i></label><br>
                                                <label><strong>Lab Status:</strong> <i><?php if($lab_request->status==0): ?>
                                                    <span class="text-danger">Accounts</span>
                                                    <?php elseif($lab_request->status==1): ?>
                                                    <span class="text-danger">Lab</span>
                                                    <?php else: ?> 
                                                    Completed
                                                    <?php endif; ?></i></label><br>
                                                    <label><strong>Lab Document:</strong> <?php echo e($lab_request->lab_document); ?></label><br>
                                                    <label><strong>Created on:</strong> <i><?php echo e(\Carbon\Carbon::parse($lab_request->created_at)->format('l\\, jS F Y')); ?></i></label><br>
                                                    <label><strong>Checked out:</strong> <i><?php echo e(\Carbon\Carbon::parse($lab_request->updated_at)->format('l\\, jS F Y')); ?></i></label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php if($lab_request->status==1): ?>
                                        <?php echo Form::open(['method'=>'PUT','action'=>['Lab\LabController@updateLab',$lab_request->id]]); ?>

                                        <?php echo Form::submit('Confirm Done', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer bg-light lt">
            <div class="text-center">
                <ul class="pagination">
                    <?php echo e($labs->links()); ?>

                </ul>
            </div>
        </div>
    </div>
    
<!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Lab Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Lab Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyLabs']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Lab Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyLabs']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Lab Reports</label>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllLabs']]); ?>

                                            <button class="btn btn-md btn-info col-md-4 pull-right">Export All Reports <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>