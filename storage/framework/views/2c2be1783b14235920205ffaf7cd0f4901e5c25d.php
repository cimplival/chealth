<div class="col-md-7 col-md-offset-5">           
          <div class="list-group list-group-lg list-group-sp">
            <span class="list-group-item clearfix text-muted clear text-ellipsis">
              <span class="clear">
                <h4 class="font-thin m-t-none m-n no-padder text-muted">Your Recent Activities</h4>
              </span>
            </span>
            <div class="scroll" style="overflow:scroll; height:300px;">
            <?php foreach($activities->reverse() as $activity): ?>
            <span class="list-group-item clearfix">
              <span class="clear">
                <span class="text-muted">On <?php echo e(Carbon\Carbon::parse($activity->created_at)->toDayDateTimeString()); ?></span>
                <small class="clear"><strong>You</strong> <?php echo e($activity->description); ?></small>
              </span>
            </span>
            <?php endforeach; ?>
            </div>
          </div>
        </div>