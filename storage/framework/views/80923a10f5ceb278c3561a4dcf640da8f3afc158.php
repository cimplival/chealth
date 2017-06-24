<div class="col-lg-4">
      <div class="panel panel-default text-center">
      <div class="panel-heading">Original Patient Record</div>
        <div class="panel-body">
          <div class="clearfix text-center ">
            <div class="inline">
              <div ui-jq="easyPieChart" ui-options="{
                    percent: 100,
                    lineWidth: 5,
                    trackColor: '#e8eff0',
                    barColor: '#23b7e5',
                    scaleColor: false,
                    color: '#3a3f51',
                    size: 134,
                    lineCap: 'butt',
                    rotate: -90,
                    animate: 2000
                  }" class="easyPieChart" style="width: 134px; height: 134px; line-height: 134px;">
                <div class="thumb-xl">
                  <img src="../img/person.jpg" class="img-circle" alt="...">
                </div>
              <canvas width="134" height="134"></canvas></div>
              <div class="h5 m-t m-b-xs"><?php echo e($patient_original->first_name); ?> <?php echo e($patient_original->middle_name); ?> <?php echo e($patient_original->last_name); ?></div>
            </div>                      
          </div>
        </div>
        <footer class="panel-footer bg-info text-center no-padder">
          <div class="row no-gutter">
            <div class="col-xs-6">
              <div class="wrapper">
                <span class="m-b-xs h6 block text-white">Patient ID:</span>
                <small class="text-muted"><?php echo e($patient_original->med_id); ?></small>
              </div>
            </div>
            <div class="col-xs-6 dk">
              <div class="wrapper">
                <span class="m-b-xs h6 block text-white">Created On</span>
                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($patient_original->created_at)->toFormattedDateString()); ?></small>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>