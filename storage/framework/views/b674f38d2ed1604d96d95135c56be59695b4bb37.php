<!DOCTYPE html>
<html lang="en" class="bg">
  <head>
    <?php echo $__env->make('templates.sub-sections.nav.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </head>
  <body>
    <div class="app app-header-fixed container">
      <!-- header -->
      <?php echo $__env->yieldContent('header'); ?>
      <!-- / header -->
      <!-- aside -->
      <?php echo $__env->yieldContent('aside'); ?>
      <!-- / aside -->
      <!-- content -->
      <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
          <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
            app.settings.asideFolded = false;
            app.settings.asideDock = false;
            ">
            <!-- main -->
            <div class="col">
              <!-- main header -->
              <?php echo $__env->yieldContent('main-header'); ?>
              <?php echo $__env->yieldContent('main-header-appointments'); ?>
              <?php echo $__env->yieldContent('main-header-consultations'); ?>
              <?php echo $__env->yieldContent('main-header-calendar'); ?>
              <?php echo $__env->yieldContent('reception-header-home'); ?>
              <!-- / main header -->
              <div class="wrapper" ng-controller="FlotChartDemoCtrl">
                <!-- stats -->
                <div class="row">
                  <div class="col-md-12">
                    <?php echo $__env->yieldContent('sign-in'); ?>
                    <?php echo $__env->yieldContent('medical-stats'); ?>
                    <?php echo $__env->yieldContent('doctor-blocks'); ?>
                    <?php echo $__env->yieldContent('doctor-medical-stats'); ?>
                    <?php echo $__env->yieldContent('doctor-appointments-body'); ?>
                    <?php echo $__env->yieldContent('doctor-consultations-body'); ?>
                    <?php echo $__env->yieldContent('doctor-calendar-body'); ?>
                    <?php echo $__env->yieldContent('reception-home-blocks'); ?>
                    <?php echo $__env->yieldContent('reception-home-statistics'); ?>
                    <?php echo $__env->yieldContent('body'); ?>
                  </div>
                </div>
                <!-- / stats -->
              </div>
            </div>
            <!-- / main -->
          </div>
        </div>
      </div>
      <!-- /content -->
      <!-- footer -->
      <?php echo $__env->yieldContent('footer'); ?>
      <!-- / footer -->
    </div>
    <?php echo $__env->yieldContent('scripts'); ?>
  </body>
</html>