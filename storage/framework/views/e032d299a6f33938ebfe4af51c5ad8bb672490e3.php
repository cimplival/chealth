<aside id="aside" class="app-aside hidden-xs bg-light">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="padder m-t m-b-sm text-muted">
                        <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-payment">
                        <i class="fa fa-search"></i> Search Payment
                        </button>
                    </li>
                    <li>
                        <a href="<?php echo e(route('accounts-home')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-home"></i>
                            <span class="">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('accounts-payments')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-money"></i>
                            <span class="">Payments</span>
                            <b class="badge bg-danger dk pull-right"></b>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('accounts-insurance')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-credit-card"></i>
                            <span class="">Insurance Records</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('get-insurance-plans')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-credit-card-alt"></i>
                            <span class="">Insurance Plans</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('accounts-services')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <span class="">Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('drugs-payments')); ?>">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-medkit"></i>
                            <span class="">Drugs</span>
                        </a>
                    </li> 
                </ul>
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
<!-- Search Payment Modal -->
<div id="search-modal" class="modal fade search-payment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body bg-light lt">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h5 class="m-t-none m-b font-thin text-center"> Search for payment below:</h5>
                        <?php echo Form::open(array('route' => 'search-payment')); ?>

                        <div class="form-group">
                            <div class="input-group m-b">
                                <input type="text" class="form-control search-input" placeholder="Search here..." name="search" required>
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
<!-- Search Payment Modal -->