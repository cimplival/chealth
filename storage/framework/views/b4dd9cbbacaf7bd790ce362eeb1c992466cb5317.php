<div class="col-md-5">
    <div class="row row-sm text-center">
        <div class="col-xs-6">
            <a href="<?php echo e(route('lab-records')); ?>" class="block panel padder-v <?php if(count($labs_pending)>0): ?> bg-danger <?php else: ?> bg-info <?php endif; ?> item dker">
                <span class="text-white font-thin h1 block"><?php echo e(count($labs_pending)); ?></span>
                <span class="text-muted text-xs">Labs Pending</span>
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