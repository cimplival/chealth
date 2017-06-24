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
      @if (!Auth::check())
      <!-- navbar collapse -->
            <div class="collapse pos-rlt navbar-collapse box-shadow bg-info dk">
                <!-- nabar right -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
                            <i class="fa fa-user-md"></i>
                            <span class="hidden-sm hidden-md"> John.Smith</span> <b class="caret"></b>
                        </a>
                        <!-- dropdown -->
                        <ul class="dropdown-menu animated fadeIn w">
                            <li>
                                <a href="">Profile</a>
                            </li>
                            <li>
                                <a href="">Settings</a>
                            </li>
                            <li>
                                <a href="">Help</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a ui-sref="access.signin">Logout</a>
                            </li>
                        </ul>
                        <!-- / dropdown -->
                    </li>
                </ul>
                <!-- / navbar right -->
            </div>
            <!-- / navbar collapse -->
      <!-- / navbar collapse -->
      @endif
  </header>