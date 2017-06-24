 <!-- aside -->
 <aside id="aside" class="app-aside hidden-xs bg-light">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="padder m-t m-b-sm text-muted">
            <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-activities">
              <i class="fa fa-search"></i> Search Activities
            </button>
          </li>
          <li>
            <a href="{{route('admin-home')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-home"></i>
              <span class="">Home</span>
            </a>
          </li>
          <li>
            <a class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-users"></i>
              <span>Reception</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('reception-registration')}}">
                  <i class="fa fa-user text-muted"></i>
                  <span>Registration</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('reception-appointments')}}">
                  <i class="fa fa-file-text-o text-muted"></i>
                  <span>Appointments</span>
                </a>
              </li>
              <li>
                <a href="{{ route('unknown-patient') }}">
                  <span class="pull-right text-muted">
                  </span>
                  <i class="fa fa-question-circle"></i>
                  <span class="">Unknown</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-money"></i>
              <span>Accounts</span>
            </a>
            <ul class="nav nav-sub dk">
              <li>
                <a href="{{route('accounts-payments')}}">
                  <i class="fa fa-money text-muted"></i>
                  <span>Payments</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('accounts-insurance')}}">
                  <i class="fa fa-credit-card text-muted"></i>
                  <span>Insurance</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('accounts-services')}}">
                  <i class="fa fa-file-text-o text-muted"></i>
                  <span>Services</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('drugs-payments')}}">
                  <i class="fa fa-medkit text-muted"></i>
                  <span>Drugs</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="" class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-line-chart"></i>
              <span>Triage</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('triage-vitals')}}">
                  <i class="fa fa-stethoscope text-muted"></i>
                  <span>Vitals</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="" class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-stethoscope"></i>
              <span>Pharmacy</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('pharmacy-dispensations')}}">
                  <i class="fa fa-file-text-o text-muted"></i>
                  <span>Dispensations</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('pharmacy-archives')}}">
                  <i class="fa fa-archive text-muted"></i>
                  <span>Archive</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('pharmacy-inventory')}}">
                  <i class="fa fa-database text-muted"></i>
                  <span>Inventory</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('pharmacy-refills')}}">
                  <i class="fa fa-plus-circle text-muted"></i>
                  <span>Refills</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="" class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-heartbeat"></i>
              <span>Lab</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('lab-records')}}">
                  <i class="fa fa-file-text-o text-muted"></i>
                  <span>Lab Requests</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="" class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-bed"></i>
              <span>Inpatient</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('get-inpatient')}}">
                  <i class="fa fa-building text-muted"></i>
                  <span>Inpatient</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('get-wards')}}">
                  <i class="fa fa-building text-muted"></i>
                  <span>Wards</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('get-beds')}}">
                  <i class="fa fa-bed text-muted"></i>
                  <span>Beds</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="" class="auto">
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="fa fa-gear"></i>
              <span>Main Settings</span>
            </a>
            <ul class="nav nav-sub dk">
              <li ui-sref-active="active">
                <a href="{{route('admin-users')}}">
                  <i class="fa fa-users text-muted"></i>
                  <span>Users</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('activities')}}">
                  <i class="fa fa-area-chart text-muted"></i>
                  <span>Audit</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('admin-reports')}}">
                  <i class="fa fa-bar-chart text-muted"></i>
                  <span>Reports</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('admin-backups')}}">
                  <i class="fa fa-database text-muted"></i>
                  <span>Backups</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('admin-notifications')}}">
                  <i class="fa fa-paper-plane text-muted"></i>
                  <span>Notifications</span>
                </a>
              </li>
              <li ui-sref-active="active">
                <a href="{{route('admin-settings')}}">
                  <i class="fa fa-gear text-muted"></i>
                  <span>Settings</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- nav -->
    </div>
  </div>
</aside>
<!-- / aside -->
<div id="search-modal" class="modal fade search-activities" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body bg-light lt">
        <div class="row">
          <div class="col-sm-12 b-r">
            <h5 class="m-t-none m-b font-thin text-center">Search for Activities</h5>
            {!! Form::open(array('route' => 'search-activities')) !!}
            <div class="form-group">
              <div class="input-group m-b">
                <input type="text" class="form-control search-input" name="search" placeholder="Search here..." autocomplete="off" required>
                <span class="input-group-btn">
                  <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                </span>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div><!-- /. modal dialog -->
</div><!-- /. modal-->