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
        <?php echo Form::open(array('route' => 'search-insurance-plans', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" autocomplete="off" placeholder="Search Insurance Plans" required>
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
                        <th style="width:15%">Provider</th>
                        <th style="width:14%">Med ID.</th>
                        <th style="width:20%">Patient</th>
                        <th style="width:15%">Identifier</th>
                        <th style="width:10%">Confirmed</th>
                        <th style="width:25%" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($insurances->reverse() as $insurance): ?>
                    <tr>
                        <td>
                            <?php echo e(str_limit($insurance->provider->name, $limit = 12, $end = '...')); ?>

                        </td>
                        <td>
                            <?php echo e($insurance->patient->med_id); ?>

                        </td>
                        <td>

                            <?php echo e(str_limit($insurance->patient->first_name." ".$insurance->patient->middle_name." ".$insurance->patient->last_name , $limit = 22, $end = '...')); ?>

                        </td>
                        <td>
                            <?php echo e($insurance->insurance_identifier); ?>

                        </td>
                        <td class="text-center"><?php if($insurance->confirmed==0): ?>
                            No
                            <?php else: ?>
                            Yes
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($insurance->confirmed==0): ?>
                            <a class="btn btn-xs btn-info" data-toggle="modal" data-target=".confirm-insurance-<?php echo e($insurance->id); ?>"><i class="fa fa-confirm"></i> Confirm</a>
                            <?php endif; ?>
                            <a class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit-insurance-<?php echo e($insurance->id); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-insurance-<?php echo e($insurance->id); ?>">Trash <i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- Confirm Insurance -->
                    <div class="modal fade confirm-insurance-<?php echo e($insurance->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                    Confirm Insurance Plan</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\InsuranceController@confirmInsurancePlan', $insurance->id]]); ?>

                                            <div class="form-group col-md-12 text-center">
                                                Confirm Insurance plan for this patient?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php echo Form::submit('Confirm Insurance', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Confirm Insurance -->
                        <!-- Edit Insurance -->
                        <div class="modal fade edit-insurance-<?php echo e($insurance->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Edit Insurance Payment Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\InsuranceController@updateInsurance', $insurance->id]]); ?>

                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" name="insurance_provider" value="<?php echo e($insurance->insurance_provider); ?>">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="text" class="form-control" name="insurance_identifier" value="<?php echo e($insurance->insurance_identifier); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                            <?php echo Form::submit('Update Payment', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Edit Insurance -->
                            <!-- Delete Insurance -->
                            <div class="modal fade delete-insurance-<?php echo e($insurance->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="blue bigger text-center">
                                                Delete Insurance?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 text-center">
                                                        <p>Are you sure you want to <b>Permanently</b> delete this insurance payment?</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                <?php echo Form::open(['method'=>'DELETE','action'=>['Accounts\InsuranceController@deleteInsurance',$insurance->id]]); ?>

                                                <?php echo Form::submit('Yes, Delete', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Delete Insurance -->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer bg-light lt text-center">
                    <ul class="pagination">
                        <?php echo e($insurances->links()); ?>

                    </ul>
                </div>
            </div>