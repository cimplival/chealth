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
        <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-service"><i class="fa fa-fw fa-plus"></i>Add Service</button>
        <?php echo Form::open(array('route' => 'search-services', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Services" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-xs table-hover table-responsive">

                <thead>
                    <tr>
                        <th style="width:20%">Service Name</th>
                        <th style="width:15%">Cost</th>
                        <th style="width:10%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($services->reverse() as $service): ?>
                    <tr>
                        <td>
                            <?php echo e($service->service_name); ?>

                        </td>
                        <td>
                            <?php echo e($settings->currency); ?> <?php echo e($service->cost); ?>

                        </td>
                        <td>
                            <?php if(($service->status)==0): ?>
                            Disabled
                            <?php else: ?>
                            Enabled
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target=".edit-service-<?php echo e($service->id); ?>"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".<?php echo e($service->id); ?>"><i class="fa fa-trash"></i> Trash</button>
                        </td>
                    </tr>
                    <!-- Delete Service -->
                    <div class="modal fade <?php echo e($service->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="blue bigger">
                                        <i class="fa fa-trash"></i>
                                        Delete Service</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <p>Do you want to <b>permanently</b> delete this service?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <?php echo Form::open(); ?>

                                        <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                                        <?php echo Form::close(); ?>

                                        <?php echo Form::open(['method'=>'DELETE','action'=>['Accounts\ServicesController@deleteService',$service->id]]); ?>

                                        <?php echo Form::submit('Delete Service', ['class' => 'btn btn-danger btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Delete Service -->
                        <!-- Update Details Modal -->
                        <div class="modal fade edit-service-<?php echo e($service->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <h4 class="font-thin text-center"><i class="fa fa-pencil"></i> Edit Service<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\ServicesController@updateService', $service->id]]); ?>

                                                <div class="form-group col-md-12">
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="service_name" placeholder="Name of Service" value="<?php echo e($service->service_name); ?>">
                                                    </div>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="cost" placeholder="Cost of Service" value="<?php echo e($service->cost); ?>">
                                                    </div>
                                                    <?php if($service->status==1): ?>
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="1" checked>
                                                                <i></i>
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0">
                                                                <i></i>
                                                                Disable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php else: ?>
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="1">
                                                                <i></i>
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0" checked>
                                                                <i></i>
                                                                Disable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="hidden" name="from_user" value="<?php echo e($user); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php echo Form::submit('Update', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- End Update Details Modal -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </tbody>
    </table>
</div>
<div class="panel-footer bg-light lt text-center">
    <ul class="pagination">
        <?php echo e($services->links()); ?>

    </ul>
</div>
</div>
<!--  Add Service -->
<div class="modal fade add-service" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info dk">
                <h4 class="font-thin text-center">Add New Service <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo Form::open(['method'=>'POST', 'action'=>['Accounts\ServicesController@addService']]); ?>

                        <div class="form-group col-md-12">
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="service_name" placeholder="Service Name" autocomplete="off" required>
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="cost" placeholder="Cost of Service" autocomplete="off" required>
                            </div>
                            <div class="input-group m-b col-md-12">
                                <select class="form-control" name="status" required>
                                    <option value="">Choose service status here...</option>
                                    <option value="1" selected>Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light lt">
                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                <?php echo Form::submit('Add Service', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div><!-- /. modal dialog -->
</div><!-- /. modal-->
<!-- Add Service -->
