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
        <?php echo Form::open(array('route' => 'search-appointment', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Appointments" name="search" class="form-control" type="text" autocomplete="off" required>
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
                        <th style="width:40%">Patient</th>
                        <th style="width:20%">Service</th>
                        <th style="width:25%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($appointments as $appointment): ?>
                    <tr>
                        <td>
                            <?php echo e($appointment->patient->first_name); ?> <?php echo e($appointment->patient->middle_name); ?> <?php echo e($appointment->patient->last_name); ?> (<?php echo e($appointment->patient->med_id); ?>)
                        </td>
                        <td>
                            <?php echo e($appointment->service->service_name); ?>

                        </td>
                        <td>
                            <?php if($appointment->status==0): ?>
                            Scheduled
                            <?php elseif($appointment->status==1): ?>
                            Accounts
                            <?php elseif($appointment->status==2): ?>
                            Triage
                            <?php elseif($appointment->status==3): ?>
                            Medical Certificate
                            <?php elseif($appointment->status==4): ?>
                            Examination
                            <?php elseif($appointment->status==5): ?>
                            Lab
                            <?php elseif($appointment->status==6): ?>
                            Pharmacy
                            <?php elseif($appointment->status==7): ?>
                            Inpatient
                            <?php elseif($appointment->status==8): ?>
                            <i class="fa fa-check text-success"></i> Discharged
                            <?php elseif($appointment->status==9): ?>
                            Accounts (Pharmacy)
                            <?php elseif($appointment->status==10): ?>
                            Accounts (Lab)
                            <?php elseif($appointment->status==11): ?>
                            Accounts (Medical Certificate)
                            <?php elseif($appointment->status==12): ?>
                            Accounts (Patient Admission)
                            <?php endif; ?>
                        </td>
                        <td class="text-right">
                            <?php if(($appointment->status)==0): ?>
                            <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".checkin-appointment-<?php echo e($appointment->id); ?>"><i class="fa fa-check"></i></button>
                            <?php endif; ?>
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-appointment-<?php echo e($appointment->id); ?>"><i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".edit-<?php echo e($appointment->id); ?>"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".appointment-<?php echo e($appointment->id); ?>"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Checkin Appointment -->
                    <div class="modal fade checkin-appointment-<?php echo e($appointment->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <?php echo Form::open(['method'=>'POST', 'url'=>'checkin-appointment', 'action'=>['Reception\AppointmentsController@checkInPatient']]); ?>

                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                     Check in for Appointment</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-10 col-md-offset-1 text-center">
                                            <input type="hidden" name="appointment_id" value="<?php echo e($appointment->id); ?>">
                                            Would you like to check in <b><?php echo e($appointment->patient->first_name); ?> <?php echo e($appointment->patient->middle_name); ?> <?php echo e($appointment->patient->last_name); ?></b> for the scheduled appointment?
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light bg">
                                    <button class="btn btn-sm btn-default pull-left">Go Back</button>
                                    <button type="submit" class="btn btn-sm btn-success pull-right">Checkin Patient</button>
                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    <!-- View Appointment -->
                    <div class="modal fade view-appointment-<?php echo e($appointment->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        View Appointment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-b">
                                            <div class="col-md-5 col-md-offset-1 text-right font-bold">
                                                Medication ID: <br>
                                                Name of Patient: <br>
                                                Type of Service: <br>
                                                Scheduled: <br>
                                                Appointment Status: <br>
                                                Created by: <br>
                                                Created on: 
                                            </div>
                                            <div class="col-md-5">
                                                <?php echo e($appointment->patient->med_id); ?> <br>
                                                <?php echo e($appointment->patient->first_name); ?> <?php echo e($appointment->patient->middle_name); ?> <?php echo e($appointment->patient->last_name); ?> <br>
                                                <?php if($appointment->service_id!=0): ?>
                                                <?php echo e($appointment->service->service_name); ?>

                                                <?php else: ?>
                                                Insurance 
                                                <?php endif; ?> <br>
                                                <?php if($appointment->status==0): ?>
                                                Yes
                                                <?php else: ?>
                                                No 
                                                <?php endif; ?> <br>
                                                <?php if($appointment->status==0): ?>
                                                Scheduled
                                                <?php elseif($appointment->status==1): ?>
                                                Accounts
                                                <?php elseif($appointment->status==2): ?>
                                                Triage
                                                <?php elseif($appointment->status==3): ?>
                                                Medical Certificate
                                                <?php elseif($appointment->status==4): ?>
                                                Examination
                                                <?php elseif($appointment->status==5): ?>
                                                Lab
                                                <?php elseif($appointment->status==6): ?>
                                                Pharmacy
                                                <?php elseif($appointment->status==7): ?>
                                                Inpatient
                                                <?php elseif($appointment->status==8): ?>
                                                <i class="fa fa-check text-success"></i> Discharged
                                                <?php elseif($appointment->status==9): ?>
                                                Accounts (Pharmacy)
                                                <?php elseif($appointment->status==10): ?>
                                                Accounts (Lab)
                                                <?php elseif($appointment->status==11): ?>
                                                Accounts (Medical Certificate)
                                                <?php endif; ?><br>
                                                <?php echo e($appointment->user->full_name); ?> <br>
                                                <?php echo e(Carbon\Carbon::parse($appointment->created_at)->toDayDateTimeString()); ?>

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
                        <!-- Cancel Appointment -->
                        <div class="modal fade appointment-<?php echo e($appointment->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Cancel Appointment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-center">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p>Are you sure you want to <b>permanently</b> cancel this appointment?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light bg">
                                            <?php echo Form::open(); ?>

                                            <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                            <?php echo Form::close(); ?>

                                            <?php echo Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$appointment->id]]); ?>

                                            <?php echo Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div>
                            <!-- Edit Appointment -->
                            <div class="modal fade edit-<?php echo e($appointment->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="blue bigger text-center">
                                                Edit Appointment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <?php echo Form::open(['method'=>'PUT','action'=>['Reception\AppointmentsController@updateAppointment', $appointment->id]]); ?>

                                                    <div class="form-group col-md-10 col-md-offset-1">
                                                        <label>
                                                            Change Appointment Service:
                                                        </label><br><br>
                                                        <select class="form-control" name="service_id">
                                                            <?php foreach($services as $service): ?>
                                                            <option value="<?php echo e($service->id); ?>"><?php echo e($service->service_name); ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                <?php echo Form::submit('Edit Appointment', ['class' => 'btn btn-success btn-sm pull-right']); ?>

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
                        <?php echo e($appointments->links()); ?>

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
                                    Appointments Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Appointments Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyAppointments']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Appointments Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyAppointments']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Appointments Reports</label>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllAppointments']]); ?>

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