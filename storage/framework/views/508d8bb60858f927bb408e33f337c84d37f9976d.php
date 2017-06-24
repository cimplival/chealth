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
        <?php echo Form::open(array('route' => 'search-dispensations', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control focus-input" type="text" placeholder="Search Dispensations" autocomplete="off" title="Search Dispensations" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-responsive">
            
            <thead>
                <tr>
                    <th style="width:15%">Med ID.</th>
                    <th style="width:25%">Patient Name</th>
                    <th style="width:25%">Name of Drug</th>
                    <th style="width:15%">Status</th>
                    <th style="width:10%">Paid</th>
                    <th class="text-center" style="width:10%">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dispensations->reverse() as $dispensation): ?>
                <tr>
                    <td>
                        <?php echo e($dispensation->patient->med_id); ?>

                    </td>
                    <td>
                        <?php echo e($dispensation->patient->first_name); ?> <?php echo e($dispensation->patient->middle_name); ?> <?php echo e($dispensation->patient->last_name); ?>

                    </td>
                    <td>
                        <?php echo e($dispensation->inventories->drug_name); ?> <?php echo e($dispensation->inventories->drug_id); ?> <?php echo e($dispensation->inventories->formulation); ?>

                    </td>
                    <td>
                        <?php if($dispensation->status==0): ?>
                        <span class="text-danger">Not Dispensed</span>
                        <?php else: ?>
                        <i class="fa fa-check text-success"></i>  Dispensed
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($dispensation->paid==0): ?>
                            <span class="text-danger">Not Paid</span>
                        <?php else: ?>
                            <i class="fa fa-check text-success"></i> Paid
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if($dispensation->paid==1 && ($dispensation->status)==0): ?>
                            <button class="btn btn-xs btn-info col-md-12" data-toggle="modal" data-target=".dispense-<?php echo e($dispensation->id); ?>"><i class="fa fa-check"></i> Dispense</button>
                        <?php else: ?>
                            <button class="btn btn-xs btn-default col-md-12" data-toggle="modal" data-target=".dispense-<?php echo e($dispensation->id); ?>"><i class="fa fa-eye"></i> View Dispensation</button>
                        <?php endif; ?>
                    </td>
                </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade dispense-<?php echo e($dispensation->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                        <?php if(($dispensation->paid)==1): ?>
                                            Dispense Drug
                                        <?php else: ?>
                                            View Dispensation
                                        <?php endif; ?>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <?php echo Form::open(['method'=>'PUT','action'=>['Pharmacy\DispensationController@dispenseDrug', $dispensation->id]]); ?>

                                                <div class="col-md-10 col-md-offset-1">
                                                    <label><strong>Medication ID:</strong> <i><?php echo e($dispensation->patient->med_id); ?></i></label><br>
                                                    <label><strong>Patient Name:</strong> <i><?php echo e($dispensation->patient->first_name); ?> <?php echo e($dispensation->patient->middle_name); ?> <?php echo e($dispensation->patient->last_name); ?></i></label><br><hr>
                                                    <label><strong>Name of Drug:</strong> <i><?php echo e($dispensation->inventories->drug_name); ?> (<?php echo e($dispensation->inventories->drug_id); ?>)</i></label><br>
                                                    <label><strong>To be Dispensed:</strong> <i><?php echo e($dispensation->quantity_consumed); ?> <?php echo e($dispensation->inventories->formulation); ?></i></label><br>
                                                    <label><strong>Medication Format:</strong> <i><strong><?php echo e($dispensation->medication->quantity_consumed); ?></strong> quantity x <strong><?php echo e($dispensation->medication->times_a_day); ?></strong> times a day x <strong><?php echo e($dispensation->medication->no_of_days); ?></strong> days</i></label><br>
                                                    <label><strong>Description:</strong> <i>
                                                    <?php if($dispensation->medication->description): ?>
                                                        <?php echo e($dispensation->medication->description); ?>

                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?></i></label><br><hr>
                                                    <label><strong>From Date:</strong> <i><?php echo e(\Carbon\Carbon::parse($dispensation->medication->from_date)->format('l\\, jS F Y')); ?></i></label><br>
                                                    <label><strong>To Date:</strong> <i><?php echo e(\Carbon\Carbon::parse($dispensation->medication->to_date)->format('l\\, jS F Y')); ?></i></label><br>
                                                    <hr>
                                                    <label><strong>Prescribed by:</strong> <i><?php echo e($dispensation->user->full_name); ?></i></label><br>
                                                    <label><strong>Created on:</strong> <i><?php echo e(Carbon\Carbon::parse($dispensation->created_at)->toDayDateTimeString()); ?></i></label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php if(($dispensation->paid)==1 && ($dispensation->status==0)): ?>
                                            <?php echo Form::submit('Dispense Drug', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php endif; ?>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Edit Modal -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <ul class="pagination">
                                    <?php echo e($dispensations->links()); ?>

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
                                    Dispensations Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Dispensations Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyDispensations']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Dispensations Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyDispensations']]); ?>

                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Dispensations Reports</label>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllDispensations']]); ?>

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