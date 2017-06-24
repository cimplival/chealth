<div class="col-md-5">
    <div class="row row-sm text-center">
        <div class="col-xs-6">
            <a href="<?php echo e(route('reception-registration')); ?>" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-pencil"></i></span>
                <span class="text-muted text-xs">Registration</span>
            </a>
        </div>
        <div class="col-xs-6">
            <a href="<?php echo e(route('reception-appointments')); ?>" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block">
                    <?php echo e($appointments); ?></span>
                    <span class="text-muted text-xs">Appointments Today</span>
            </a>
        </div>
        <div class="col-xs-6">
            <a href="<?php echo e(route('reception-appointments')); ?>" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-question-circle"></i>
                    </span>
                <span class="text-muted text-xs">Unknown Patients</span>
                </a>
        </div>
        <div class="col-xs-6">
            <a href="<?php echo e(route('activities')); ?>" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-line-chart"></i></span>
                <span class="text-muted text-xs">Activities</span>
            </a>
        </div>
    </div>
</div>
