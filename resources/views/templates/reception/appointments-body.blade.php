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
        {!! Form::open(array('route' => 'search-appointment', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Appointments" name="search" class="form-control" type="text" autocomplete="off" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-responsive">
                <thead>
                    <tr>
                        <th style="width:40%">Patient</th>
                        <th style="width:20%">Service</th>
                        <th style="width:25%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>
                            {{ $appointment->patient->first_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->last_name }} ({{ $appointment->patient->med_id }})
                        </td>
                        <td>
                            {{ $appointment->service->service_name }}
                        </td>
                        <td>
                            @if($appointment->status==0)
                            Scheduled
                            @elseif($appointment->status==1)
                            Accounts
                            @elseif($appointment->status==2)
                            Triage
                            @elseif($appointment->status==3)
                            Medical Certificate
                            @elseif($appointment->status==4)
                            Examination
                            @elseif($appointment->status==5)
                            Lab
                            @elseif($appointment->status==6)
                            Pharmacy
                            @elseif($appointment->status==7)
                            Inpatient
                            @elseif($appointment->status==8)
                            <i class="fa fa-check text-success"></i> Discharged
                            @elseif($appointment->status==9)
                            Accounts (Pharmacy)
                            @elseif($appointment->status==10)
                            Accounts (Lab)
                            @elseif($appointment->status==11)
                            Accounts (Medical Certificate)
                            @elseif($appointment->status==12)
                            Accounts (Patient Admission)
                            @endif
                        </td>
                        <td class="text-right">
                            @if(($appointment->status)==0)
                            <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".checkin-appointment-{{$appointment->id}}"><i class="fa fa-check"></i></button>
                            @endif
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-appointment-{{$appointment->id}}"><i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".edit-{{$appointment->id}}"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".appointment-{{$appointment->id}}"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Checkin Appointment -->
                    <div class="modal fade checkin-appointment-{{$appointment->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!!Form::open(['method'=>'POST', 'url'=>'checkin-appointment', 'action'=>['Reception\AppointmentsController@checkInPatient']])!!}
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                     Check in for Appointment</h4>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row m-b">
                                        <div class="col-md-10 col-md-offset-1 text-center">
                                            <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                                            Would you like to check in <b>{{ $appointment->patient->first_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->last_name }}</b> for the scheduled appointment?
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light bg">
                                    <button class="btn btn-sm btn-default pull-left">Go Back</button>
                                    <button type="submit" class="btn btn-sm btn-success pull-right">Checkin Patient</button>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    <!-- View Appointment -->
                    <div class="modal fade view-appointment-{{$appointment->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        View Appointment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-b">
                                            <div class="col-md-5 col-md-offset-1 text-right font-bold">
                                                Medication ID: <br>
                                                Name of Patient: <br>
                                                Type of Service: <br>
                                                Scheduled: <br>
                                                Appointment Status: <br>
                                                Created by: <br>
                                                Created on: 
                                            </div>
                                            <div class="col-md-5">
                                                {{ $appointment->patient->med_id }} <br>
                                                {{ $appointment->patient->first_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->last_name }} <br>
                                                @if($appointment->service_id!=0)
                                                {{ $appointment->service->service_name }}
                                                @else
                                                Insurance 
                                                @endif <br>
                                                @if($appointment->status==0)
                                                Yes
                                                @else
                                                No 
                                                @endif <br>
                                                @if($appointment->status==0)
                                                Scheduled
                                                @elseif($appointment->status==1)
                                                Accounts
                                                @elseif($appointment->status==2)
                                                Triage
                                                @elseif($appointment->status==3)
                                                Medical Certificate
                                                @elseif($appointment->status==4)
                                                Examination
                                                @elseif($appointment->status==5)
                                                Lab
                                                @elseif($appointment->status==6)
                                                Pharmacy
                                                @elseif($appointment->status==7)
                                                Inpatient
                                                @elseif($appointment->status==8)
                                                <i class="fa fa-check text-success"></i> Discharged
                                                @elseif($appointment->status==9)
                                                Accounts (Pharmacy)
                                                @elseif($appointment->status==10)
                                                Accounts (Lab)
                                                @elseif($appointment->status==11)
                                                Accounts (Medical Certificate)
                                                @endif<br>
                                                {{ $appointment->user->full_name }} <br>
                                                {{ Carbon\Carbon::parse($appointment->created_at)->toDayDateTimeString() }}
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
                        <!-- Cancel Appointment -->
                        <div class="modal fade appointment-{{$appointment->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                            Cancel Appointment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-center">
                                                <div class="col-xs-12 col-sm-12">
                                                    <p>Are you sure you want to <b>permanently</b> cancel this appointment?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light bg">
                                            {!!Form::open()!!}
                                            {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                            {!!Form::close()!!}
                                            {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$appointment->id]])!!}
                                            {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div><!-- /. modal dialog -->
                            </div>
                            <!-- Edit Appointment -->
                            <div class="modal fade edit-{{$appointment->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="blue bigger text-center">
                                                Edit Appointment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    {!! Form::open(['method'=>'PUT','action'=>['Reception\AppointmentsController@updateAppointment', $appointment->id]])!!}
                                                    <div class="form-group col-md-10 col-md-offset-1">
                                                        <label>
                                                            Change Appointment Service:
                                                        </label><br><br>
                                                        <select class="form-control" name="service_id">
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Edit Appointment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                    <ul class="pagination">
                        {{ $appointments->links() }}
                    </ul>
            </div>

            <!-- Export Reports -->
                <div class="modal fade all-reports" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                    Appointments Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Appointments Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyAppointments']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Appointments Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyAppointments']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Appointments Reports</label>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllAppointments']])!!}
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