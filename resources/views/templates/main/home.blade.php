<!DOCTYPE html>
<html lang="en" class="bg">
  <head>
    @include('templates.sub-sections.nav.head')
  </head>
  <body>
    <div class="app app-header-fixed container">
      <!-- header -->
      @yield('header')
      <!-- / header -->
      <!-- aside -->
      @yield('aside')
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
              @yield('main-header')
              @yield('main-header-appointments')
              @yield('main-header-consultations')
              @yield('main-header-calendar')
              @yield('reception-header-home')
              <!-- / main header -->
              <div class="wrapper" ng-controller="FlotChartDemoCtrl">
                <!-- stats -->
                <div class="row">
                  <div class="col-md-12">
                    @yield('sign-in')
                    @yield('medical-stats')
                    @yield('doctor-blocks')
                    @yield('doctor-medical-stats')
                    @yield('doctor-appointments-body')
                    @yield('doctor-consultations-body')
                    @yield('doctor-calendar-body')
                    @yield('reception-home-blocks')
                    @yield('reception-home-statistics')
                    @yield('body')
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
      @yield('footer')
      <!-- / footer -->
    </div>
    @yield('scripts')
  </body>
</html>