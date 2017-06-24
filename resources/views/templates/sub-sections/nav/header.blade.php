<header id="header" class="app-header navbar" role="menu">
  <!-- navbar header -->
  <div class="navbar-header bg-info dker">
    <!-- brand -->
    <a href="" class="navbar-brand text-lt">
      <i class="fa fa-hospital-o"></i>
      <span class="hidden-folded m-l-xs">cHealth</span>
    </a>
    <!-- / brand -->
  </div>
  <!-- / navbar header -->

  <!-- navbar collapse -->

  <!-- navbar collapse -->
  <div class="collapse pos-rlt navbar-collapse box-shadow bg-info dk">
    <!-- nabar right --> 
    @if (Auth::check())
    <ul class="nav navbar-nav navbar-right">

      <li class="dropdown">
        <a aria-expanded="true" href="" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
          <i class="fa fa-user"></i>
          <span class="hidden-sm"> {{ Auth::user()->full_name }}</span> <b class="caret"></b>
        </a>
        <!-- dropdown -->
        <ul id="" class="dropdown-menu animated fadeIn ">
          <li>
            <a href="{{ route('change-password') }}"><i class="fa fa-gear text-info"></i> Change Password</a>
          </li>
          <li>
            <a href="{{ route('activities') }}"><i class="fa fa-line-chart text-info"></i> Recent Activities</a>
          </li>
          <li>
            <a href="{{ route('log-out') }}"><i class="fa fa-sign-out text-info"></i> Sign out</a>
          </li>
        </ul>
        <!-- / dropdown -->
      </li>
    </ul>
    @endif
    <!-- / navbar right -->
  </div>
  <!-- / navbar collapse -->
</header>
