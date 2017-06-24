<aside id="aside" class="app-aside hidden-xs bg-light">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="padder m-t m-b-sm text-muted">
                        <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-patient">
                        <i class="fa fa-search"></i> Search Patients
                        </button>
                    </li>
                    <li class="active">
                        <a href="{{ route('reception-home') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-home"></i>
                            <span class="">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-registration') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-pencil"></i>
                            <span class="">Registration</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-appointments') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-file-text-o"></i>
                            <span class="">Appointments</span>
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
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
<div class="modal fade search-patient" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body bg-light lt">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h5 class="m-t-none m-b font-thin text-center">Search for a Patient</h5>
                        {!! Form::open(array('route' => 'search-patient')) !!}
                        <div class="form-group">
                            <div class="input-group m-b">
                                <input type="text" class="form-control search-input focus" name="search" placeholder="Search here..." autocomplete="off" required>
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
