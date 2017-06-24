<div class="panel panel-default">
    <div class="panel-heading bg-light lt">
    </div>
    <div class="panel-body">
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href data-toggle="tab" data-target="#search_id">Search Results <span class="badge badge-sm m-l-xs">{{ count($patient) }}</span></a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active bg-grey" id="search_id">
                    <ul class="list-group no-borders pull-in m-b-none animated fadeInDown">
                        @foreach($patient->reverse() as $patient)
                        <li class="list-group-item bg-light lt">
                            <div class="col-md-6 pull-right">
                                @if(Auth::user()->hasRole('doctor'))
                                <?php
                                if(Auth::user()->hasRole('doctor'))
                                {   
                                    $on_patient = $patient->id;
                                    $vitals = App\Vital::where('on_patient', $on_patient)->paginate(10);

            //Get medications to display on medical profile
                                    $medications = App\Medication::where('on_patient', $on_patient)->paginate(10, ['*'], 'medications' );

            //Get diagnosis to display on the medical profile
                                    $diagnosis = App\Diagnosis::where('on_patient', $on_patient)->paginate(10, ['*'], 'diagnosis');

            //Get immunizations to display on the medical profile
                                    $immunizations = App\Immunization::where('on_patient', $on_patient)->paginate(10, ['*'], 'immunizations');

            //Get therapies to display on the medical profile
                                    $therapies = App\Therapy::where('on_patient', $on_patient)->paginate(10, ['*'], 'therapies');

            //Get procedures to display on the medical profile
                                    $procedures = App\Procedure::where('on_patient', $on_patient)->paginate(10, ['*'], 'procedures');

            //Get histories to display on the medical profile
                                    $histories = App\History::where('on_patient', $on_patient)->paginate(10, ['*'], 'histories');

            //Get allergies to display on the medical profile
                                    $allergies = App\Allergy::where('on_patient', $on_patient)->paginate(10, ['*'], 'allergies');

            //Get lab records to display on the medical profile
                                    $labs = App\Lab::where('on_patient', $on_patient)->paginate(10, ['*'], 'labs');

                                    $wards = App\Ward::where('ward_status', 1)->get();

                                    $beds = App\Bed::where('bed_status', 0)->get();

                                    $services = App\Service::get();
                                }
                                    //Will check whether there is an unknown patient in existence   
                                $unknown_patient = App\UnknownPatient::where('patient_id', $patient->id)->first();
                                ?>
                                <a class="btn btn-info col-md-offset-6 col-md-6" data-toggle="modal" data-target=".summary-{{ $patient->id }}"> View Medical Profile</a><br><br>
                                <a class="btn btn-default col-md-offset-6 col-md-6" data-toggle="modal" data-target=".schedule-{{$patient->id}}">Schedule Appointment <i class="fa fa-clock-o"></i></a>
                                @endif
                                @if(Auth::user()->hasRole('receptionist') && !Auth::user()->hasRole('doctor'))
                                <?php
                                if(Auth::user()->hasRole('receptionist') && !Auth::user()->hasRole('doctor') )
                                {   
                                    $on_patient = $patient->id;
                                    $vitals = App\Vital::where('on_patient', $on_patient)->paginate(10);

            //Get medications to display on medical profile
                                    $medications = App\Medication::where('on_patient', $on_patient)->paginate(10, ['*'], 'medications' );

            //Get diagnosis to display on the medical profile
                                    $diagnosis = App\Diagnosis::where('on_patient', $on_patient)->paginate(10, ['*'], 'diagnosis');

            //Get immunizations to display on the medical profile
                                    $immunizations = App\Immunization::where('on_patient', $on_patient)->paginate(10, ['*'], 'immunizations');

            //Get therapies to display on the medical profile
                                    $therapies = App\Therapy::where('on_patient', $on_patient)->paginate(10, ['*'], 'therapies');

            //Get procedures to display on the medical profile
                                    $procedures = App\Procedure::where('on_patient', $on_patient)->paginate(10, ['*'], 'procedures');

            //Get histories to display on the medical profile
                                    $histories = App\History::where('on_patient', $on_patient)->paginate(10, ['*'], 'histories');

            //Get allergies to display on the medical profile
                                    $allergies = App\Allergy::where('on_patient', $on_patient)->paginate(10, ['*'], 'allergies');

            //Get lab records to display on the medical profile
                                    $labs = App\Lab::where('on_patient', $on_patient)->paginate(10, ['*'], 'labs');

                                    $wards = App\Ward::where('ward_status', 1)->get();

                                    $beds = App\Bed::where('bed_status', 0)->get();

                                    $services = App\Service::get();
                                }
                                    //Will check whether there is an unknown patient in existence   
                                $unknown_patient = App\UnknownPatient::where('patient_id', $patient->id)->first();
                                ?>
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-sm col-md-12" data-toggle="modal" data-target=".appointment-{{$patient->id}}">Create Appointment <i class="fa fa-calendar"></i></a><br><br>
                                    <a class="btn btn-info btn-sm col-md-12" data-toggle="modal" data-target=".admit-{{$patient->id}}">Admit Patient <i class="fa fa-bed"></i></a>
                                </div>
                                <div class="col-md-6">
                                <a class="btn btn-default btn-sm col-md-12" data-toggle="modal" data-target=".schedule-{{$patient->id}}">Schedule <i class="fa fa-clock-o"></i></a><br><br>
                                    @if(!\App\UnknownPatient::where('patient_id', $patient->id)->first())
                                    <a class="btn btn-default btn-sm col-md-12 pull-right" data-toggle="modal" data-target=".merge-{{$patient->id}}">Merge Medical Record <i class="fa fa-link"></i></a>
                                    @else 
                                    <label class="text-center text-info h6">This patient has been registered as unknown.</label>
                                    @endif
                                </div>
                                <br><br><br><br>


                                <div class="modal fade admit-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Admit Patient</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="text-center">Are you sure you want to create an appointment?</h5>
                                                    </div><br>
                                                    {!!Form::open(['method'=>'POST', 'url'=>'create-appointment', 'action'=>['Reception\AppointmentsController@CreateAppointment']])!!}
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <input type="hidden" name="on_patient" value="{{ $patient->id }}" />
                                                        <select name="service_id" class="form-control m-b" required>
                                                            <option value="">Select a service...</option>
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->id }}">{{ \App\Provider::where('id', $service->provider_id)->value('name') }} — {{ $service->service_name }} ({{ $settings->currency }} {{ $service->cost }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div><br>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <select name="ward_id" class="form-control m-b" required>
                                                            <option value="">Select a Ward...</option>
                                                            @foreach($wards as $ward)
                                                            <option value="{{ $ward->id }}">{{$ward->ward_name}} - {{$ward->ward_notes}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div><br>
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <select name="bed_id" class="form-control m-b" required>
                                                            <option value="">Select a Bed...</option>
                                                            @foreach($beds as $bed)
                                                            <option value="{{ $bed->id }}">Bed No: {{$bed->bed_no}} ({{$bed->bed_notes}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light dk">
                                                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Admit Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <p>
                                <span class="h5 m-b-sm m-t-sm block">
                                    {{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</span><input name="med_id" type="hidden" value="{{ $patient->med_id }}"/>Age: {{ Carbon\Carbon::parse($patient->date_birth)->age }} years
                                    <br>Gender: {{ $patient->gender }}</p>
                                    <p><span class="label bg-info pos-rlt m-r inline wrapper-xs">{{ $patient->med_id }}</span> </span>
                                        <br>
                                    </p>
                                </li>
                                <hr>
                                <div class="modal fade appointment-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Create an Appointment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <h5 class="text-center">Are you sure you want to create an appointment?</h5>
                                                        {!!Form::open(['method'=>'POST', 'url'=>'create-appointment', 'action'=>['Reception\AppointmentsController@CreateAppointment']])!!}
                                                        <input type="hidden" name="on_patient" value="{{ $patient->id }}" />
                                                        <select name="service_id" class="form-control m-b" required="">
                                                            <option value="">Select a Service...</option>
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->id }}">{{ \App\Provider::where('id', $service->provider_id)->value('name') }} — {{ $service->service_name }} ({{ $settings->currency }} {{ $service->cost }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light dk">
                                                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Create Appointment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade schedule-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center">Schedule Appointment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    {!!Form::open(['method'=>'POST', 'url'=>'schedule', 'action'=>['Reception\AppointmentsController@scheduleAppointment']])!!}
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <h5>Choose Date of Appointment:</h5>
                                                        <div class="form-group">
                                                            <input type="hidden" name="on_patient" value="{{ $patient->id }}"/>
                                                            <input type="text" id="datepicker" class="form-control datepicker-here schedule" data-language='en' name="scheduled_at" value="{{Request::old('scheduled_at')}}"  data-timepicker="true" placeholder="Appointment Date" onkeydown="return false" autocomplete="off" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="service_id" class="form-control m-b" required>
                                                                <option value="">Select a Service...</option>
                                                                @foreach($services as $service)
                                                                <option value="{{$service->id}}">{{$service->service_name}} ({{ $settings->currency }} {{$service->cost}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light dk">
                                                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Go Back</button>

                                                {!! Form::submit('Schedule Appointment', ['class' => 'btn btn-success btn-sm pull-right']) !!}

                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade merge-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-link"></i> Merge Patient Record</h4>
                                            </div>
                                            <div class="modal-body bg-light dk">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <h5 class="m-t-none m-b font-thin text-center">Search for a patient to merge this medical record with</h5>
                                                        {!! Form::open(array('route' => 'search-merge-patient')) !!}
                                                        <div class="form-group">
                                                            <div class="input-group m-b">
                                                                <input type="text" class="form-control search-input focus" name="search" placeholder="Search here..." autocomplete="off" required>
                                                                <input name="patient_id" type="hidden" value="{{ $patient->id }}">
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
                                    </div>
                                </div>
                                @if(Auth::user()->hasRole('doctor'))
                                @include('templates.medical.summary')
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
