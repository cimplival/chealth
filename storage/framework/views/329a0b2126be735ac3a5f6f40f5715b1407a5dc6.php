<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-light">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="padder m-t m-b-sm text-muted">
            <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-patient">
              <i class="fa fa-search"></i> Search Vitals
            </button>
         </li>
          <li>
            <a href="<?php echo e(route('triage-home')); ?>">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-home"></i>
              <span class="">Home</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('triage-vitals')); ?>">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-stethoscope"></i>
              <span>Vitals</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- nav -->
    </div>
  </div>
</aside>
<!-- / aside -->
<!--Modal Search -->
<div id="search-modal" class="modal fade search-patient search" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body bg-light lt">
                <div class="row">
                    <div class="col-md-12 b-r">
                        <h5 class="m-t-none m-b font-thin text-center">Search for Vitals</h5>
                        <?php echo Form::open(array('route' => 'search-vitals')); ?>

                        <div class="form-group">
                            <div class="input-group m-b">
                                <input type="text" class="form-control search-input search" name="search" placeholder="Search here..." autocomplete="off" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                                </span>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /. modal dialog -->
</div><!-- /. modal-->
