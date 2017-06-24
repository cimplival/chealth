<div class="panel panel-default col-md-7 col-md-offset-1">
    <div class="panel-body">
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <?php if(Session::has('info')): ?>
                <?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if(Session::has('success')): ?>
                <?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
                <?php if(count($errors) > 0): ?>
                <?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active bg-grey" id="search_id">
                    <ul class="list-group no-borders pull-in m-b-none animated fadeInDown">
                        <?php foreach($patient->reverse() as $patient): ?>
                        <?php if($patient->id !== $patient_original->id): ?>
                        <li class="list-group-item bg-light">
                            <p>
                                <span class="h5 m-b-sm m-t-sm block">
                                    <a class="btn btn-info btn-sm col-md-4 pull-right" data-toggle="modal" data-target=".merge-<?php echo e($patient->id); ?>">Merge Patient Record <i class="fa fa-link"></i></a>Name: 
                                    <?php echo e($patient->first_name); ?> <?php echo e($patient->middle_name); ?> <?php echo e($patient->last_name); ?></span><input name="med_id" type="hidden" value="<?php echo e($patient->med_id); ?>"></input>Age: <?php echo e(Carbon\Carbon::parse($patient->date_birth)->age); ?> years
                                    <br>Gender: <?php echo e($patient->gender); ?></p>
                                    <p><span class="label bg-primary pos-rlt m-r inline wrapper-xs"><?php echo e($patient->med_id); ?></span> </span>
                                        <br>
                                    </p>
                                </li>
                                <div class="modal fade merge-<?php echo e($patient->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Merge Patient Record</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <h5 class="text-center">Merge with <?php echo e($patient->first_name); ?> <?php echo e($patient->middle_name); ?> <?php echo e($patient->last_name); ?>'s patient record?</h5>
                                                        <input type="hidden" name="on_patient" value="<?php echo e($patient->id); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light dk">
                                            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Go Back</button>
                                            <?php echo Form::open(['method'=>'POST', 'url'=>'merge-patients', 'action'=>['Medical\PatientController@mergePatients']]); ?>

                                            <input type="hidden" name="original_patient" value="<?php echo e($patient_original->id); ?>"/>
                                            <input type="hidden" name="existing_patient" value="<?php echo e($patient->id); ?>"/>
                                            <?php echo Form::submit('Merge Patient Record', ['class' => 'btn btn-success btn-sm pull-right']); ?>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
