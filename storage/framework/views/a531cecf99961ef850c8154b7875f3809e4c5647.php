<div class="col-md-5">
  <div class="row row-sm text-center">
    <div class="col-xs-6">
      <?php if($dispensationsCount==0): ?>
      <a href="<?php echo e(route('pharmacy-dispensations')); ?>" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block"><?php echo e($dispensationsCount); ?></span>
        <span class="text-muted text-xs">Dispensations</span>
      </a>
      <?php elseif($dispensationsCount==1): ?>
      <a href="<?php echo e(route('pharmacy-dispensations')); ?>" class="block panel padder-v bg-danger item dker">
        <span class="text-white font-thin h1 block"><?php echo e($dispensationsCount); ?></span>
        <span class="text-muted text-xs">Dispensation</span>
      </a>
      <?php else: ?>
      <a href="<?php echo e(route('pharmacy-dispensations')); ?>" class="block panel padder-v bg-danger item dker">
        <span class="text-white font-thin h1 block"><?php echo e($dispensationsCount); ?></span>
        <span class="text-muted text-xs">Dispensations</span>
      </a>
      <?php endif; ?>
    </div>
    <div class="col-xs-6">
      <a href="<?php echo e(route('pharmacy-inventory')); ?>" class="block panel padder-v bg-info item dker">
        <span class="text-white font-thin h1 block"><i class="fa fa-stethoscope"></i></span>
        <span class="text-muted text-xs">Inventory</span>
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