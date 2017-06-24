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
        <?php echo Form::open(array('route' => 'search-payment', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search payments" name="search" class="form-control" type="text" required>
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
                        <th style="width:25%">Patient Name</th>
                        <th style="width:10%">Status</th>
                        <th style="width:20%">Type</th>
                        <th style="width:15%">Service</th>
                        <th style="width:10%">Cost</th>
                        <th class="text-center" style="width:20%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($payments as $payment): ?>
                    <tr>
                        <td>
                            <?php echo e($payment->patient->first_name); ?> <?php echo e($payment->patient->middle_name); ?> <?php echo e($payment->patient->last_name); ?>

                        </td>
                        <td><?php if(($payment->status)===0): ?>
                            <span class="text-danger">Not Paid</i></span>
                            <?php else: ?>
                            <span class="text-success">Paid</i></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($payment->insurance_id==0): ?>
                            <?php echo e(str_limit("Self Sponsored", $limit = 15, $end = '...')); ?>

                            <?php else: ?>
                            Insurance
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e(str_limit($payment->service->service_name, $limit = 20, $end = '...')); ?>

                        </td>
                        <td>
                            <?php echo e($payment->service->cost); ?>

                        </td>
                        <td class="text-center">
                            <?php if(($payment->status)===0): ?>
                            <div class="btn-group">
                                <?php if($payment->insurance_id==0): ?>
                                <label aria-invalid="false" class="btn btn-xs btn-info" btn-checkbox="" data-toggle="modal" data-target=".confirm-cash-<?php echo e($payment->id); ?>"><i class="fa fa-money"></i> Confirm</label>
                                <?php else: ?>
                                <label style="" aria-invalid="false" class="btn btn-xs btn-primary" btn-checkbox="" data-toggle="modal" data-target=".confirm-insurance-<?php echo e($payment->id); ?>"><i class="fa fa-credit-card"></i> Confirm Payment</label>
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target=".edit-<?php echo e($payment->id); ?>"><i class="fa fa-edit"></i> Edit</button>
                            <?php endif; ?>
                            <label aria-invalid="false" class="btn btn-xs btn-primary" btn-checkbox="" data-toggle="modal" data-target=".invoice-<?php echo e($payment->id); ?>"><i class="fa fa-file-text-o"></i> Invoice</label>
                            <!-- Invoice Payment -->
                            <div class="modal fade invoice-<?php echo e($payment->id); ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h3 class="blue bigger text-center">
                                                Invoice #: <?php echo e(Carbon\Carbon::parse($payment->created_at)->format('ymdHis')); ?></h3>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo $__env->make('templates.reports.accounts.patients-invoice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default btn-sm pull-left">Go Back</button>
                                                <?php echo Form::open(['method'=>'POST', 'action'=>['Medical\MedicalController@exportInvoice']]); ?>

                                                <input type="hidden" name="payment_id" value="<?php echo e($payment->id); ?>"/>
                                                <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-file-pdf-o"></i> Export Invoice</button>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                            </td>
                        </tr>
                        <input type="hidden" class="form-control" name="on_patient" value="<?php echo e($payment->drug_id); ?>">
                        <!-- Confirm cash Payment -->
                        <div class="modal fade confirm-cash-<?php echo e($payment->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Confirm Cash Payment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-10 col-md-offset-1 text-center">
                                                    <p>Confirm cash payment of <i class="fa fa-money"></i> <strong>Ksh. <?php echo e($payment->cost); ?></strong> for <strong><?php echo e($payment->patient->first_name); ?> <?php echo e($payment->patient->middle_name); ?> <?php echo e($payment->patient->last_name); ?></strong>?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-default btn-sm pull-left">Go Back</button>
                                            <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@confirmPayment',$payment->id]]); ?>

                                            <?php echo Form::submit('Confirm Payment', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- Insure Payment -->
                            <div class="modal fade confirm-insurance-<?php echo e($payment->id); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="blue bigger text-center">
                                                Confirm Insurance Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-10 col-md-offset-1 text-center">
                                                        <p>Confirm insurance payment for
                                                           <strong><?php echo e($payment->patient->first_name); ?> <?php echo e($payment->patient->middle_name); ?> <?php echo e($payment->patient->last_name); ?></strong> of <strong>Ksh. <?php echo e($payment->cost); ?></strong>.</p>
                                                           <?php echo Form::open(['method'=>'POST','url'=>'create-insurance','action'=>['Accounts\InsuranceController@createInsurance']]); ?>

                                                           <div class="form-group">
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="insurance_provider" placeholder="Insurance Provider" required>
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="insurance_identifier" placeholder="Insurance Identifier" required>
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="hidden" class="form-control" name="payment_id" value="<?php echo e($payment->id); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-default btn-sm pull-left"><i class="fa fa-arrow-left"></i> Go Back</button>
                                                <?php echo Form::submit('Insure Payment', ['class' => 'btn btn-primary btn-sm pull-right']); ?>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Confirm cash Payment -->
                                <!-- Edit Payment -->
                                <div class="modal fade edit-<?php echo e($payment->id); ?>" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger text-center">
                                                    Edit Payment</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@updatePayment', $payment->id]]); ?>

                                                        <?php if($payment->status===0): ?>
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Edit Payment Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Paid" checked>
                                                                    <i></i>
                                                                    Paid
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Not Paid">
                                                                    <i></i>
                                                                    Not Paid
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Payment Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Paid">
                                                                    <i></i>
                                                                    Paid
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="status" value="Not Paid" checked>
                                                                    <i></i>
                                                                    Not Paid
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(($payment->insurance_id)==1): ?>
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Update Insurance Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="1" checked>
                                                                    <i></i>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="0">
                                                                    <i></i>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="form-group col-md-11 col-md-offset-1">
                                                            <label>
                                                                Update Insurance Status:
                                                            </label>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="1">
                                                                    <i></i>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label class="i-checks">
                                                                    <input type="radio" name="insurance" value="0" checked>
                                                                    <i></i>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="hidden" class="form-control" name="updatedBy" placeholder="UpdatedBy"
                                                            value="">
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
                                    <!-- Edit Payment -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer text-center bg-light lt">
                        <ul class="pagination">
                            <?php echo e($payments->links()); ?>

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
                                    Payment Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Payment Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportDailyPayments']]); ?>

                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                <?php foreach($providers as $provider): ?>
                                                <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                                                <?php endforeach; ?>
                                            </select><br>
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="<?php echo e(old('date')); ?>"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                            <br>
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Payment Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportMonthlyPayments']]); ?>

                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                <?php foreach($providers as $provider): ?>
                                                <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                                                <?php endforeach; ?>
                                            </select><br>
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="<?php echo e(old('month')); ?>"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <br>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?>

                                            <br>
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Report for All Payment Reports</label><br><br>
                                            <?php echo Form::open(['method'=>'POST','action'=>['Medical\MedicalController@exportAllPayments']]); ?>

                                            <select class="form-control" name="payment_method_id" required>
                                                <option value="">Choose a Payment Method...</option>
                                                <?php foreach($providers as $provider): ?>
                                                <option value="<?php echo e($provider->id); ?>"><?php echo e($provider->name); ?></option>
                                                <?php endforeach; ?>
                                            </select><br>
                                            <button class="btn btn-md btn-info col-md-4 pull-right">Export All Reports <i class="fa fa-external-link-square"></i></button>
                                            <?php echo Form::close(); ?><br><br><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>