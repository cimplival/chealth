<div class="col-md-5">
  <div class="row row-sm text-center">

    <div class="col-xs-6">
      <a href="<?php echo e(route('doctor-appointments')); ?>" class="block panel padder-v <?php if(count($examinations)>0): ?> bg-danger <?php else: ?> bg-info <?php endif; ?> item dker">
        <span class="text-white font-thin h1 block"><?php echo e(count($examinations)); ?></span>
        <span class="text-muted text-xs">Pending</span>
      </a>
    </div>
    <div class="col-xs-6">
    <a href="<?php echo e(route('medical-profile')); ?>" class="block panel padder-v <?php if($examination): ?> bg-danger <?php else: ?> bg-info <?php endif; ?> item dker">
        <span class="text-white font-thin h1 block"> 
          <?php if($examination): ?>
            <i class="fa fa-check"></i> 
          <?php else: ?> 
            0 
          <?php endif; ?></span>
        <span class="text-muted text-xs">Examination</span>
      </a>
    </div>

    <div class="col-xs-6">
      <a href="" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block">5</span>
        <span class="text-muted text-xs">Today's Patients</span>
      </a>
    </div>
    <div class="col-xs-6">
      <a href="<?php echo e(route('activities')); ?>" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block"><i class="fa fa-line-chart"></i></span>
        <span class="text-muted text-xs">Activity</span>
      </a>
    </div>
  </div>
</div>