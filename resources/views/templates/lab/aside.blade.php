            <aside id="aside" class="app-aside hidden-xs bg-light">
                <div class="aside-wrap">
                    <div class="navi-wrap">
                        <!-- nav -->
                        <nav ui-nav class="navi clearfix">
                            <ul class="nav">
                                <li class="padder m-t m-b-sm text-muted">
                                    <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-lab">
                                        <i class="fa fa-search"></i>Lab Requests
                                    </button>
                                </li>
                                <li>
                                    <a href="{{ route('lab-home') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-home"></i>
                                        <span class="">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('lab-records') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-bar-chart"></i>
                                        <span class="">Lab Requests</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- nav -->
                    </div>
                </div>
            </aside>
            <!--Modal Search -->
            <div id="search-dispensation" class="modal fade search-lab" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body bg-light lt">
                            <div class="row">
                                <div class="col-md-12 b-r">
                                    <h4 class="m-t-none m-b font-thin text-center">Search for Lab Record<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    {!! Form::open(array('route' => 'search-lab')) !!}
                                    <div class="form-group">
                                        <div class="input-group m-b">
                                            <input type="text" class="form-control focus-input" name="search" placeholder="Search here..." autocomplete="off" required>
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
