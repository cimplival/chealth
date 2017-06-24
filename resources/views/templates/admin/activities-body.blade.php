@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="row">
    <div class="col-md-12">         
        <div class="list-group list-group-lg list-group-sp">
            {!! Form::open(array('route' => 'search-activities')) !!}
            <span class="list-group-item clearfix clear bg-white dker">
                <span class="col-md-12 no-padder">
                    <div class="pull-left padder">
                        <a class="btn btn-default" data-toggle="modal" data-target=".my-reports"><i class="fa fa-file-pdf-o"></i> Reports</a>
                        @if(Auth::user()->hasRole('administrator'))
                        <a class="btn btn-default" data-toggle="modal" data-target=".user-reports"><i class="fa fa-users"></i> Users</a>
                        @endif
                    </div>
                    <div class="input-group">
                        <input name="search" class="form-control focus-input col-md-12" type="text" placeholder="Search Activities" autocomplete="off" title="Search Activities" required>
                        <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
                    </div>
                </span>
            </span>
            {!! Form::close() !!}
            <div class="text-white" style="overflow:scroll; height:400px;">
                @foreach($activities->reverse() as $activity)
                <span class="list-group-item bg-white dker">
                    <span class="clear">
                        <span>{{ \Carbon\Carbon::parse($activity->created_at)->format('l jS \\of F Y h:i:s A') }}</span><br>
                        <small>
                            @if(Auth::user()->hasRole('administrator'))
                            {{ $activity->users->full_name}}
                            @else
                            I 
                            @endif
                            {{ $activity->description }}
                        </small>
                    </span>
                </span>
                @endforeach
            </div>
            <div class="text-center">
                <div class="pagination">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Export Reports -->
                <div class="modal fade my-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Export Activity Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Activity Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyActivity']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Activity Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyActivity']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>

                @if(Auth::user()->hasRole('administrator'))
                    <!-- Export Reports -->
                <div class="modal fade user-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    User Activity Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily User Activity Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyUserActivity']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <select class="col-md-6 form-control m-b" ui-jq="chosen" name="user_id" title="Search a User">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->full_name}} ({{$user->staff_id}}) - {{$user->email}}</option>
                                                @endforeach
                                                </select><br><br>
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly User Activity Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyUserActivity']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <select class="col-md-6 form-control m-b" ui-jq="chosen" name="user_id" title="Search a User">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->full_name}} ({{$user->staff_id}}) - {{$user->email}}</option>
                                                @endforeach
                                                </select><br><br>
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    @endif