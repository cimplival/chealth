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
        <?php echo Form::open(array('route' => 'search-drugs-accounts', 'class'=>'form-inline text-right')); ?>

        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Drugs" name="search" class="form-control" type="text" autocomplete="off" required>
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
                        <th style="width:18%">Drug ID.</th>
                        <th style="width:20%">Name of Drug</th>
                        <th style="width:13%">Formulation</th>
                        <th style="width:20%">Description</th>
                        <th style="width:15%">Drug Cost</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inventories as $inventory): ?>
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
                            <?php echo e(str_limit($inventory->description, $limit = 30, $end = '...')); ?>

                        </td>
                        <td>
                            <?php echo e($settings->currency); ?> <?php echo e($inventory->per_cost); ?>

                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".add-price-<?php echo e($inventory->id); ?>"><i class="fa fa-edit"></i> Edit Cost</button>
                        </td>
                    </tr>
                    <!-- Add new drug Modal -->
                    <div class="modal fade add-price-<?php echo e($inventory->id); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        Add Price</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo Form::open(['method'=>'PUT','action'=>['Accounts\DrugsPaymentsController@updateCost', $inventory->id]]); ?>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="form-group col-md-10 col-md-offset-1">
                                                    <input type="hidden" name="drug_id" value="<?php echo e($inventory->id); ?>">  
                                                    <span class="font-bold">Name of Drug:</span> <?php echo e($inventory->drug_name); ?><br>
                                                    <span class="font-bold">Formulation:</span> <?php echo e($inventory->formulation); ?><br>
                                                    <span class="font-bold">Description:</span> <?php echo e($inventory->description); ?>

                                                </div>
                                                <div class="form-group col-md-6 col-md-offset-1">
                                                    <input type="text" class="form-control" name="per_cost" placeholder="Cost per formulation" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        <?php echo Form::submit('Refill Drug', ['class' => 'btn btn-success btn-sm pull-right']); ?>

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
               <?php echo e($inventories->links()); ?>

           </ul>
       </div>
   </div>
