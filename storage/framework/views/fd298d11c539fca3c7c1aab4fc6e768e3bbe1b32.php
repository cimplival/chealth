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
        <?php echo Form::open(array('route' => 'search-inpatient', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Inpatient" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="table-responsive">
        <table class="table table-hover table-xs table-responsive">
            <thead>
                <tr>
                    <th style="width:25%">Patient</th>
                    <th style="width:20%">Bed</th>
                    <th style="width:15%">Status</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach($inpatients as $inpatient): ?>
                <tr>   
                    <td>
                        <?php echo e($inpatient->patient->first_name); ?> <?php echo e($inpatient->patient->middle_name); ?> <?php echo e($inpatient->patient->last_name); ?> (<?php echo e($inpatient->patient->med_id); ?>)
                    </td>
                    <td>
                        <?php echo e($inpatient->ward->ward_name); ?> Bed No: <?php echo e($inpatient->bed->bed_no); ?>

                    </td>
                    <td>
                        <?php if($inpatient->status==0): ?>
                        <span class="label label-info">Admitted</span>
                        <?php else: ?>
                        <span class="label label-success">Discharged</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".discharge-<?php echo e($inpatient->id); ?>"><i class="fa fa-check"></i></button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-<?php echo e($inpatient->id); ?>"><i class="fa fa-eye"></i>
                        </button>
                        <!-- <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-<?php echo e($inpatient->id); ?>"><i class="fa fa-trash"></i>
                        </button> -->
                    </td>
                </tr>

                <!-- Delete Inpatient -->
                        <div class="modal fade delete-<?php echo e($inpatient->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Delete Inpatient</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <p>Are you sure you want to <b>permanently</b> delete this Inpatient Record?</p>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light bg">
                                            <?php echo Form::open(); ?>

                                            <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                            <?php echo Form::close(); ?>

                                            <?php echo Form::open(['method'=>'DELETE','action'=>['Nurse\InpatientController@deleteInpatient',$inpatient->id]]); ?>

                                            <?php echo Form::submit('Delete Inpatient', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div>
                            <!-- Delete Inpatient -->

                <!-- Discharge Inpatient -->
                <div class="modal fade discharge-<?php echo e($inpatient->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                 Discharge Inpatient</h4>
                             </div>
                             <div class="modal-body">
                             <div class="row">
                                <div class="col-md-11 col-md-offset-1 text-center">
                                        <p>Are you sure you want to discharge the Patient?</p>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">No, Go Back</button>
                                <?php echo Form::open(['method'=>'PUT','action'=>['Nurse\InpatientController@dischargePatient', $inpatient->id]]); ?>

                                <?php echo Form::submit('Yes, Discharge', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div><!-- /. modal dialog -->
                </div><!-- /. modal-->

                <!-- View Inpatient -->
                <div class="modal fade view-<?php echo e($inpatient->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Inpatient</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-3 col-md-offset-1 text-right font-bold">
                                            Patient: <br>
                                            Bed: <br>
                                            Status: <br>
                                            Created by: <br>
                                            Date:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo e($inpatient->patient->first_name); ?> <?php echo e($inpatient->patient->middle_name); ?> <?php echo e($inpatient->patient->last_name); ?> (<?php echo e($inpatient->patient->med_id); ?>)<br>
                                            <?php echo e($inpatient->ward->ward_name); ?> Bed No: <?php echo e($inpatient->bed->bed_no); ?><br>
                                            <?php if($inpatient->status==0): ?>
                                            <span class="label label-info">Admitted</span>
                                            <?php else: ?>
                                            <span class="label label-success">Discharged</span>
                                            <?php endif; ?><br>
                                            <?php echo e($inpatient->user->full_name); ?><br>
                                            <?php echo e(Carbon\Carbon::parse($inpatient->created_at)->formatLocalized('%A %d %B %Y')); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light bg">
                                    <?php echo Form::open(); ?>

                                    <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <ul class="pagination">
                <?php echo e($inpatients->links()); ?>

            </ul>
        </div>
    </div>

<!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Inpatient Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Inpatient Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyInpatient']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Inpatient Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyInpatient']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Inpatient Reports</label>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllInpatient']]); ?>

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