<div class="col-md-5">
  <div class="row row-sm text-center">
    <div class="col-xs-6">
      <a href="<?php echo e(route('triage-vitals')); ?>" class="block panel padder-v <?php if(count($triages)>0): ?> bg-danger <?php else: ?> bg-info <?php endif; ?> item dker">
        <span class="text-white font-thin h1 block"><?php echo e(count($triages)); ?></span>
        <span class="text-muted text-xs">Pending</span>
      </a>
    </div>
    <div class="col-xs-6">
      <a href="<?php echo e(route('triage-vitals')); ?>" class="block panel padder-v <?php if(!count($medical_certificates)): ?> bg-info <?php else: ?> bg-danger <?php endif; ?> item dker">
        <span class="text-white font-thin h1 block"><?php echo e(count($medical_certificates)); ?></span>
        <span class="text-muted text-xs">Certificate</span>
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