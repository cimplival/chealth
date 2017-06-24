@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-left">
            <a class="btn btn-default" data-toggle="modal" data-target=".all-reports"><i class="fa fa-file-pdf-o"></i> Reports</a>
        </div>
        {!! Form::open(array('route' => 'search-dispensations', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input name="search" class="form-control focus-input" type="text" placeholder="Search Dispensations" autocomplete="off" title="Search Dispensations" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-responsive">
            
            <thead>
                <tr>
                    <th style="width:15%">Med ID.</th>
                    <th style="width:25%">Patient Name</th>
                    <th style="width:25%">Name of Drug</th>
                    <th style="width:15%">Status</th>
                    <th style="width:10%">Paid</th>
                    <th class="text-center" style="width:10%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dispensations->reverse() as $dispensation)
                <tr>
                    <td>
                        {{ $dispensation->patient->med_id }}
                    </td>
                    <td>
                        {{ $dispensation->patient->first_name }} {{ $dispensation->patient->middle_name }} {{ $dispensation->patient->last_name }}
                    </td>
                    <td>
                        {{ $dispensation->inventories->drug_name }} {{ $dispensation->inventories->drug_id }} {{ $dispensation->inventories->formulation }}
                    </td>
                    <td>
                        @if($dispensation->status==0)
                        <span class="text-danger">Not Dispensed</span>
                        @else
                        <i class="fa fa-check text-success"></i>  Dispensed
                        @endif
                    </td>
                    <td>
                        @if($dispensation->paid==0)
                            <span class="text-danger">Not Paid</span>
                        @else
                            <i class="fa fa-check text-success"></i> Paid
                        @endif
                    </td>
                    <td class="text-center">
                        @if($dispensation->paid==1 && ($dispensation->status)==0)
                            <button class="btn btn-xs btn-info col-md-12" data-toggle="modal" data-target=".dispense-{{$dispensation->id}}"><i class="fa fa-check"></i> Dispense</button>
                        @else
                            <button class="btn btn-xs btn-default col-md-12" data-toggle="modal" data-target=".dispense-{{$dispensation->id}}"><i class="fa fa-eye"></i> View Dispensation</button>
                        @endif
                    </td>
                </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade dispense-{{$dispensation->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                        @if(($dispensation->paid)==1)
                                            Dispense Drug
                                        @else
                                            View Dispensation
                                        @endif
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                {!! Form::open(['method'=>'PUT','action'=>['Pharmacy\DispensationController@dispenseDrug', $dispensation->id]])!!}
                                                <div class="col-md-10 col-md-offset-1">
                                                    <label><strong>Medication ID:</strong> <i>{{ $dispensation->patient->med_id }}</i></label><br>
                                                    <label><strong>Patient Name:</strong> <i>{{ $dispensation->patient->first_name }} {{ $dispensation->patient->middle_name }} {{ $dispensation->patient->last_name }}</i></label><br><hr>
                                                    <label><strong>Name of Drug:</strong> <i>{{ $dispensation->inventories->drug_name }} ({{ $dispensation->inventories->drug_id }})</i></label><br>
                                                    <label><strong>To be Dispensed:</strong> <i>{{ $dispensation->quantity_consumed }} {{$dispensation->inventories->formulation}}</i></label><br>
                                                    <label><strong>Medication Format:</strong> <i><strong>{{ $dispensation->medication->quantity_consumed }}</strong> quantity x <strong>{{ $dispensation->medication->times_a_day }}</strong> times a day x <strong>{{ $dispensation->medication->no_of_days }}</strong> days</i></label><br>
                                                    <label><strong>Description:</strong> <i>
                                                    @if($dispensation->medication->description)
                                                        {{ $dispensation->medication->description }}
                                                    @else
                                                        N/A
                                                    @endif</i></label><br><hr>
                                                    <label><strong>From Date:</strong> <i>{{ \Carbon\Carbon::parse($dispensation->medication->from_date)->format('l\\, jS F Y') }}</i></label><br>
                                                    <label><strong>To Date:</strong> <i>{{ \Carbon\Carbon::parse($dispensation->medication->to_date)->format('l\\, jS F Y') }}</i></label><br>
                                                    <hr>
                                                    <label><strong>Prescribed by:</strong> <i>{{ $dispensation->user->full_name }}</i></label><br>
                                                    <label><strong>Created on:</strong> <i>{{ Carbon\Carbon::parse($dispensation->created_at)->toDayDateTimeString() }}</i></label><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        @if(($dispensation->paid)==1 && ($dispensation->status==0))
                                            {!! Form::submit('Dispense Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        @endif
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Edit Modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <ul class="pagination">
                                    {{ $dispensations->links() }}
                                </ul>
                            </div>
                        </div>

                        <!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Dispensations Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Dispensations Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyDispensations']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Dispensations Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyDispensations']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Dispensations Reports</label>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllDispensations']])!!}
                                            <button class="btn btn-md btn-info col-md-4 pull-right">Export All Reports <i class="fa fa-external-link-square"></i></button>
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