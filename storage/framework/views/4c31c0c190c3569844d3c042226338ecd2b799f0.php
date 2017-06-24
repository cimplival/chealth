<div class="modal fade summary-<?php echo e($patient->id); ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info dk text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">
                        Medical Summary</h4>
                    </div>
                    <?php echo $__env->make('templates.medical.summary-body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="modal-footer bg-light lt">
                        <?php echo Form::open(); ?>

                        <?php echo Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']); ?>

                        <?php echo Form::close(); ?>

                        <?php echo Form::open(['method'=>'GET', 'action'=>['Medical\MedicalController@exportPDF']]); ?>

                            <button type="submit" class="btn btn-sm btn-success pull-right"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export as PDF</button>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                </div><!-- /. modal dialog -->
            </div>