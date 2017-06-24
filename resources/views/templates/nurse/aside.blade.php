            <aside id="aside" class="app-aside hidden-xs bg-light">
                <div class="aside-wrap">
                    <div class="navi-wrap">
                        <!-- nav -->
                        <nav ui-nav class="navi clearfix">
                            <ul class="nav">
                                <li class="padder m-t m-b-sm text-muted">
                                    <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-inpatient">
                                        <i class="fa fa-search"></i>Search Inpatient
                                    </button>
                                </li>
                                <li>
                                    <a href="{{ route('nurse-home') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-home"></i>
                                        <span class="">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('get-inpatient') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="">Inpatient</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('get-wards') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-building" aria-hidden="true"></i>
                                        <span class="">Wards</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('get-beds') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                        <span class="">Beds</span>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                        <!-- nav -->
                    </div>
                </div>
            </aside>
            <!-- Search Patient -->
            <div id="search-modal" class="modal fade search-inpatient" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body bg-light lt">
                    <div class="row">
                      <div class="col-sm-12 b-r">
                        <h5 class="m-t-none m-b font-thin text-center">Search for Inpatient</h5>
                        {!! Form::open(array('route' => 'search-inpatient')) !!}
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
