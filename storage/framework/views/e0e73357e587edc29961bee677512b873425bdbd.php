<?php if(count($examinations)===0): ?>
<h5>Sorry, you don't have any pending examinations.</h5>
<?php else: ?>
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
        <?php echo Form::open(array('route' => 'search-vitals', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Vitals" name="search" class="form-control search-input" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover table-sm table-responsive">
            <thead>
                <tr>
                    <th style="width:15%">Med ID.</th>
                    <th style="width:25%">Patient</th>
                    <th style="width:15%">Service</th>
                    <th style="width:15%">Time</th>
                    <th class="text-center" style="width:15%">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($examinations->reverse() as $examination): ?>
                <tr>
                    <td>
                        <?php echo e($examination->patient->med_id); ?>

                    </td>
                    <td>
                        <?php echo e($examination->patient->first_name); ?> <?php echo e($examination->patient->middle_name); ?> <?php echo e($examination->patient->last_name); ?>

                    </td>
                    <td>
                        <?php echo e($examination->service->service_name); ?>

                    </td>
                    <td>
                        <?php echo e(Carbon\Carbon::parse($examination->created_at)->diffForHumans()); ?>

                    </td>
                    <td class="text-center">
                        <?php if($examination->status==0 || $examination->status==3): ?>
                            <button class="btn btn-xs btn-info text-center col-md-12" data-toggle="modal" data-target=".consult-<?php echo e($examination->id); ?>">Consult</button>
                        <?php else: ?>
                            <button class="btn btn-xs btn-default text-center col-md-12" data-toggle="modal" data-target=".view-<?php echo e($examination->id); ?>"><i class="fa fa-eye"></i> View</button>
                        <?php endif; ?>
                               <!--  <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".examination-<?php echo e($examination->id); ?>">Trash <i class="fa fa-trash"></i></button> -->
                    </td>
                </tr>
                <div class="modal fade view-<?php echo e($examination->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                Examination</h4>
                            </div>
                            <div class="modal-body">
                                        <div class="row m-b">
                                            <div class="col-md-5 col-md-offset-1 text-right font-bold">
                                                Medication ID: <br>
                                                Name of Patient: <br>
                                                Type of Service: <br>
                                                Status: <br>
                                                Created at: 
                                            </div>
                                            <div class="col-md-5">
                                                <?php echo e($examination->patient->med_id); ?><br>
                                                <?php echo e($examination->patient->first_name); ?> <?php echo e($examination->patient->middle_name); ?> <?php echo e($examination->patient->last_name); ?><br>
                                                <?php echo e($examination->service->service_name); ?><br>
                                                <?php if($examination->status==0): ?>
                                                    Not Consulted
                                                <?php elseif($examination->status==1): ?>
                                                    Examination
                                                <?php elseif($examination->status==2): ?>
                                                    Lab
                                                <?php elseif($examination->status==3): ?>
                                                    From Lab
                                                <?php else: ?>
                                                    Consulted
                                                <?php endif; ?><br>
                                                <?php echo e(\Carbon\Carbon::parse($examination->created_at)->toFormattedDateString()); ?><br>
                                            </div>
                                        </div>
                                    </div>
                            <div class="modal-footer bg-light lt">
                                <?php echo Form::open(); ?>

                                <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                <div class="modal fade examination-<?php echo e($examination->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                Confirm to cancel examination</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-10 col-md-offset-1 text-center">
                                        <p>Are you sure you want to <strong>permanently</strong> cancel this examination?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <?php echo Form::open(); ?>

                                <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                <?php echo Form::close(); ?>

                                <?php echo Form::open(['method'=>'DELETE','action'=>['Doctor\DoctorController@cancelAppointment',$examination->id]]); ?>

                                <?php echo Form::submit('Cancel examination', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Consult Modal -->
                        <div class="modal fade consult-<?php echo e($examination->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                Confirm Consultation</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-10 col-md-offset-1 text-center">
                                        <p>Are you sure you want to consult <strong><?php echo e($examination->patient->first_name); ?> <?php echo e($examination->patient->middle_name); ?> <?php echo e($examination->patient->last_name); ?></strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <?php echo Form::open(); ?>

                                <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                <?php echo Form::close(); ?>

                                <?php echo Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$examination->id]]); ?>

                                <?php echo Form::submit('Consult Patient', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Consult Modal -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="panel-footer bg-light lt text-center">
                <ul class="pagination">
                    <?php echo e($examinations->links()); ?>

                </ul>
            </div>
        </div>
        <?php endif; ?>

        <!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Doctor Examinations Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Doctor Examinations Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyDoctorExaminations']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Doctor Examinations Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyDoctorExaminations']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Doctor Examinations Reports</label>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllDoctorExaminations']]); ?>

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