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
        {!! Form::open(array('route' => 'search-inpatient', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Inpatient" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-xs table-responsive">
            <thead>
                <tr>
                    <th style="width:25%">Patient</th>
                    <th style="width:20%">Bed</th>
                    <th style="width:15%">Status</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($inpatients as $inpatient)
                <tr>   
                    <td>
                        {{$inpatient->patient->first_name}} {{$inpatient->patient->middle_name}} {{$inpatient->patient->last_name}} ({{$inpatient->patient->med_id}})
                    </td>
                    <td>
                        {{$inpatient->ward->ward_name}} Bed No: {{$inpatient->bed->bed_no}}
                    </td>
                    <td>
                        @if($inpatient->status==0)
                        <span class="label label-info">Admitted</span>
                        @else
                        <span class="label label-success">Discharged</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".discharge-{{$inpatient->id}}"><i class="fa fa-check"></i></button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-{{$inpatient->id}}"><i class="fa fa-eye"></i>
                        </button>
                        <!-- <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".delete-{{$inpatient->id}}"><i class="fa fa-trash"></i>
                        </button> -->
                    </td>
                </tr>

                <!-- Delete Inpatient -->
                        <div class="modal fade delete-{{$inpatient->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Delete Inpatient</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <p>Are you sure you want to <b>permanently</b> delete this Inpatient Record?</p>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light bg">
                                            {!!Form::open()!!}
                                            {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                            {!!Form::close()!!}
                                            {!!Form::open(['method'=>'DELETE','action'=>['Nurse\InpatientController@deleteInpatient',$inpatient->id]])!!}
                                            {!! Form::submit('Delete Inpatient', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div>
                            <!-- Delete Inpatient -->

                <!-- Discharge Inpatient -->
                <div class="modal fade discharge-{{$inpatient->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                 Discharge Inpatient</h4>
                             </div>
                             <div class="modal-body">
                             <div class="row">
                                <div class="col-md-11 col-md-offset-1 text-center">
                                        <p>Are you sure you want to discharge the Patient?</p>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">No, Go Back</button>
                                {!! Form::open(['method'=>'PUT','action'=>['Nurse\InpatientController@dischargePatient', $inpatient->id]])!!}
                                {!! Form::submit('Yes, Discharge', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div><!-- /. modal dialog -->
                </div><!-- /. modal-->

                <!-- View Inpatient -->
                <div class="modal fade view-{{$inpatient->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Inpatient</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-3 col-md-offset-1 text-right font-bold">
                                            Patient: <br>
                                            Bed: <br>
                                            Status: <br>
                                            Created by: <br>
                                            Date:
                                        </div>
                                        <div class="col-md-6">
                                            {{$inpatient->patient->first_name}} {{$inpatient->patient->middle_name}} {{$inpatient->patient->last_name}} ({{$inpatient->patient->med_id}})<br>
                                            {{$inpatient->ward->ward_name}} Bed No: {{$inpatient->bed->bed_no}}<br>
                                            @if($inpatient->status==0)
                                            <span class="label label-info">Admitted</span>
                                            @else
                                            <span class="label label-success">Discharged</span>
                                            @endif<br>
                                            {{$inpatient->user->full_name}}<br>
                                            {{ Carbon\Carbon::parse($inpatient->created_at)->formatLocalized('%A %d %B %Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light bg">
                                    {!!Form::open()!!}
                                    {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <ul class="pagination">
                {{$inpatients->links()}}
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
                                    Inpatient Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Inpatient Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyInpatient']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Inpatient Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyInpatient']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Inpatient Reports</label>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllInpatient']])!!}
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