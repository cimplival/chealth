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
        <button class="btn btn-sm btn-default pull-left" data-toggle="modal" data-target=".add-patient"><i class="fa fa-fw fa-plus"></i>Add Unknown Patient</button>
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
                        <th style="width:15%">Medical ID.</th>
                        <th style="width:25%">Patient</th>
                        <th style="width:15%">Service</th>
                        <th style="width:10%">Status</th>
                        <th class="text-center" style="width:15%">Options</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($unknown_patients as $unknown_patient)
                    <td>{{$unknown_patient->patient->med_id}}</td>
                    <td>{{$unknown_patient->patient->first_name}} {{$unknown_patient->patient->middle_name}} {{$unknown_patient->patient->last_name}}</td>
                    <td>{{$unknown_patient->appointment->service->service_name}}</td>
                    <td>
                        @if($unknown_patient->appointment->status === 4)
                            Examination
                        @else
                            Admitted
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-xs btn-info col-md-12" data-toggle="modal" data-target=".view-patient-{{$unknown_patient->id}}">View Patient</button>
                    </td>
                <!-- View Appointment -->
                    <div class="modal fade view-patient-{{$unknown_patient->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger text-center">
                                        View Unknown Patient</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-b">
                                            <div class="col-md-5 col-md-offset-1 text-right font-bold">
                                                Medication ID: <br>
                                                Name of Patient: <br>
                                                Type of Service: <br>
                                                Appointment Status: <br>
                                                Created by: <br>
                                                Created on: 
                                            </div>
                                            <div class="col-md-5">
                                                {{ $unknown_patient->patient->med_id }}<br>
                                                {{$unknown_patient->patient->first_name}} {{$unknown_patient->patient->middle_name}} {{$unknown_patient->patient->last_name}} <br>
                                                {{$unknown_patient->appointment->service->service_name}}<br>
                                                @if($unknown_patient->appointment->status === 4)
                                                    Examination
                                                @else
                                                    Admitted
                                                @endif
                                                <br>
                                                {{ Carbon\Carbon::parse($unknown_patient->created_at)->toDayDateTimeString() }}<br>
                                                {{$unknown_patient->user->full_name}}
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
    </div>
    <div class="panel-footer bg-light lt text-center">
        <ul class="pagination">

        </ul>
    </div>
</div>
<!--  Add Service -->
<div class="modal fade add-patient" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info dk">
                <h4 class="font-thin text-center">Add Unknown Patient <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['method'=>'POST', 'action'=>['Reception\ReceptionController@addUnknownPatient']])!!}
                        <div class="form-group m-lg">
                            <label class="m-b">Demographics (All fields are Optional)</label>
                            <div class="input-group m-b col-md-12">
                            <input type="text" class="form-control focus" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                value="{{ old('last_name') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" id="datepicker" class="form-control datepicker-here" data-language='en' name="date_birth" value="{{ old('date_birth') }}" data-view="years" data-date-format="yyyy-mm-dd" placeholder="Date of Birth *Optional" onkeydown="return false">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="estimated_age" placeholder="or Estimated age" value="{{ old('estimated_age') }}" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label>
                                    Gender:
                                </label>
                                <div class="radio">
                                    <label class="i-checks">
                                        <input type="radio" name="gender" value="Male">
                                        <i></i>
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="i-checks">
                                        <input type="radio" name="gender" value="Female">
                                        <i></i>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-lg">
                            <label class="m-b">Contact Details (All fields are Optional)</label>
                            <div class="input-group m-b col-md-12">
                                <input type="phone" class="form-control" name="patient_phone" placeholder="Patient Phone" value="{{ old('patient_phone') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="kin_name" placeholder="Name of Kin" value="{{ old('kin_name') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="kin_relationship" placeholder="Relationship of Kin" value="{{ old('kin_relationship') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="phone" class="form-control" name="kin_phone" placeholder="Next of Kin Phone" value="{{ old('kin_phone') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="emial" class="form-control" name="email" placeholder="Patient Email" value="{{ old('email') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <input type="text" class="form-control" name="residence" placeholder="Residence" value="{{ old('residence') }}" autocomplete="off">
                            </div>
                            <div class="input-group m-b col-md-12">
                                <select class="form-control m-b" name="county" value="{{ old('county') }}">
                                    @include('templates.reception.select-counties')
                                </select>
                            </div>
                            <div class="input-group m-b col-md-12">

                                <select class="form-control m-b" name="country_origin" value="{{ old('country_origin') }}">
                                    @include('templates.reception.select-countries')
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light lt">
                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                {!! Form::submit('Add Unknown Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                {!!Form::close()!!}
            </div>
        </div><!-- /. modal dialog -->
    </div><!-- /. modal-->
<!-- Add Service -->