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
    <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-new-drug"><i class="fa fa-fw fa-plus"></i>New Drug</button>
        <?php echo Form::open(array('route' => 'search-inventory', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control" type="text" autocomplete="off" title="Search Inventory" placeholder="Search Inventory" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="table-responsive">
        <table class="table table-hover table-sm table-responsive">

            <thead>
                <tr>
                    <th style="width:10%">Drug ID.</th>
                    <th style="width:20%">Name of Drug</th>
                    <th style="width:15%">Formulation</th>
                    <th style="width:10%">Quantity</th>
                    <th style="width:25%">Description</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($inventories->reverse() as $inventory): ?>
                <tr>
                    <td>
                        <?php echo e($inventory->drug_id); ?>

                    </td>
                    <td>
                        <?php echo e($inventory->drug_name); ?>

                    </td>
                    <td>
                        <?php echo e($inventory->formulation); ?>

                    </td>
                    <td>
                        <?php echo e($inventory->quantity); ?>

                    </td>
                    <td>
                        <?php echo e($inventory->description); ?>

                    </td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".view-<?php echo e($inventory->id); ?>"><i class="fa fa-search"></i> View</button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".refill-drugs-<?php echo e($inventory->id); ?>"><i class="fa fa-fw fa-level-up"></i>Refill</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade view-<?php echo e($inventory->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                    View Inventory</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="col-md-10 col-md-offset-1">
                                            <label><strong>Name of Drug:</strong> <i><?php echo e($inventory->drug_name); ?></i></label><br>
                                            <label><strong>Formulation:</strong> <i><?php echo e($inventory->formulation); ?></i></label><br>
                                            <label><strong>Quantity:</strong> <i><?php echo e($inventory->quantity); ?></i></label><br>
                                            <label><strong>Description:</strong> <i><?php echo e($inventory->description); ?></i></label><br>
                                            <label><strong>Per Cost:</strong> <?php echo e($settings->currency); ?> <i><?php echo e($inventory->per_cost); ?></i></label><br>
                                        </div>
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
                <!-- Consult Modal -->

                <!-- Add new drug Modal -->
                <div class="modal fade refill-drugs-<?php echo e($inventory->id); ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                    Refill Inventory Drug</h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo Form::open(['method'=>'PUT','action'=>['Pharmacy\InventoryController@refillDrug', $inventory->id]]); ?>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group col-md-12">
                                                <input type="text" class="form-control" name="quantity_added" placeholder="Quantity" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                    <?php echo Form::submit('Refill Drug', ['class' => 'btn btn-success btn-sm pull-right']); ?>

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
                <?php echo e($inventories->links()); ?>

            </ul>
        </div>
    </div>

    <!-- Add new drug Modal -->
    <div class="modal fade add-new-drug" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info dk text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">
                        Add New Drug</h4>
                    </div>
                    <?php echo Form::open(['method'=>'POST', 'action'=>['Pharmacy\InventoryController@refillNew']]); ?>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="drug_name" placeholder="Name of Drug" autocomplete="off" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="formulation" required>
                                        <option value="">Choose Formulation</option>
                                        <option value="Pills">Pills</option>
                                        <option value="Tablets">Tablets</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="quantity" placeholder="Quantity" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light lt">
                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                        <?php echo Form::submit('Add New Drug', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div><!-- /. modal dialog -->
        </div><!-- /. modal-->
            <!-- Add new drug Modal -->