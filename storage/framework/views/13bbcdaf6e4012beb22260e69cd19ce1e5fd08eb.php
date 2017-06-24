<?php if(Session::has('info')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(Session::has('success')): ?>
<?php echo $__env->make('templates.sub-sections.alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<?php if(count($errors) > 0): ?>
<?php echo $__env->make('templates.sub-sections.alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<div class="row">
    <div class="col-sm-12 b-r">
        <?php echo Form::open(array('route' => 'search-patient')); ?>

    	    <div class="form-group">
        	    <div class="input-group m-b">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search patient..." required>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>