<!DOCTYPE html>
<html lang="en" class="bg">
  <head>
    <meta charset="utf-8" />
    <title>cHealth / Service Unavailable - 503</title>
    <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="assets/animate.css/animate.css" type="text/css" />
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
  </head>
  <body>
    <div class="app app-header-fixed container">
      <!-- header -->
      <header id="header" class="app-header navbar" role="menu">
        <!-- navbar header -->
        <div class="navbar-header bg-info dker">
          <!-- brand -->
          <a href="#/" class="navbar-brand text-lt">
            <i class="fa fa-hospital-o"></i>
            <span class="hidden-folded m-l-xs">cHealth</span>
          </a>
          <!-- / brand -->
        </div>
        <!-- / navbar header -->
        <!-- navbar collapse -->
        <div class="collapse pos-rlt navbar-collapse box-shadow bg-info dker">
          
        </div>
        <!-- / navbar collapse -->
      </header>
      <!-- / header -->
      
      <!-- content -->
      <div id="content" class="" role="main">
        <div class="app-content-body ">
          <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
            app.settings.asideFolded = false;
            app.settings.asideDock = false;
            ">
            <!-- main -->
            <div class="col">
              <!-- main header -->
              <div class="bg-white lter b-b wrapper-md">
                <div class="row">
                  <div class="col-sm-12 col-xs-12 text-center">
                    <h1 class="m-n font-thin h3 text-grey">cHealth</h1>
                    <small class="text-muted">Bringing simplicity to healthcare.</small>
                    
                  </div>
                </div>
              </div>
              <!-- / main header -->
              <div class="wrapper" ng-controller="FlotChartDemoCtrl">
                <!-- stats -->
                <div class="row">
                  <div class="col-md-12 text-center">Sorry, our service is temporarily unavailable. We will be right back shortly.</div>
                  <div class="text-center m-b-lg col-md-12">
                    <h1 class="text-shadow text-white">503</h1>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <a href="{{route('home-redirect')}}" class="btn m-b-xs btn-info btn-addon btn-md center-block">
                      Okay.
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- / stats -->
          </div>
        </div>
        <!-- / main -->
        <!-- right col -->
        <!-- / right col -->
      </div>
    </div>
  </div>
  <!-- /content -->
  
  <!-- footer -->
  <footer id="footer"  role="footer">
    <div class="wrapper b-t bg-light text-center">
      &copy; Cimplicity Apps. All Rights Reserved.
    </div>
  </footer>
  <!-- / footer -->
</div>
<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="js/ui-client.js"></script>
</body>
</html>