@if(!$examination)
Sorry, no medical profile is shown since there isn't any selected appointment.
@else
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
    <div class="h5 panel-heading bg-light lt">
        Medical Profile
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-8">
                    <span class="thumb-lg">
                        <img src="../img/person.jpg" class="img-circle"></span>
                    </span>
                    <p>
                        <h5>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</h5>
                        <span class="h5 pull-left text-muted">
                            <span class="label bg-info pos-rlt m-b inline wrapper-xs"><i class="fa fa-user"></i> {{ $patient->med_id }}</span>

                            <span class="h6 text-muted"> Age:</span>
                            <span class="h6">{{ Carbon\Carbon::parse($patient->date_birth)->age }} years old</span><br><br>
                        </span>
                    </p>
                </div>
                <div class="col-md-3 pull-right">
                    <div class="form-group">
                        <div class="btn-group btn-group-justified">
                            @if($patient_return)
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target=".lab-visit-{{$examination->id}}"><i class="fa fa-user-md"></i> Send to Lab</a>
                            @else
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target=".consulted-{{$examination->id}}"><i class="fa fa-user-md"></i> Discharge</a>
                            @endif
                            <!-- <a class="btn btn-info btn-sm" data-toggle="modal" data-target=".refer-{{$examination->id}}"> Refer</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pull-right">
                    <div class="form-group">
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target=".summary-{{ $patient->id }}"> Medical Summary</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Medical Summary -->
            @include('templates.medical.summary')
            <!-- Medical Summary -->
            <!-- Lab Visit-->
            <div class="modal fade lab-visit-{{$examination->id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info dk text-center">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="blue bigger">
                                Send to Lab</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Confirm lab visit for the patient.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@labVisit',$examination->id]])!!}
                                {!! Form::submit('Confirm Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                    </div><!-- /. modal dialog -->
                </div>
                <!-- Lab Visit-->
                <!-- Checkout patient-->
                <div class="modal fade consulted-{{$examination->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">
                                    Confirm Discharge</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center">
                                        <div class="col-xs-12 col-sm-12">
                                            <p>Are you sure you want to discharge this patient?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    {!!Form::open()!!}
                                    {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                    {!!Form::close()!!}
                                    {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consulted',$examination->id]])!!}
                                    {!! Form::submit('Discharge Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /. modal dialog -->
                    </div>
                    <!-- Refer patient-->
                    <div class="modal fade refer-{{$examination->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk text-center">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">
                                        Refer Patient</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Kindly choose the department to refer the patient.</label><br><br>
                                                    <select class="col-md-6 form-control">
                                                        <option class="">Consultation</option>
                                                        <option class="">Dentist</option>
                                                        <option class="">Optician</option>
                                                        <option class="">Emergency</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer text-center bg-light lt">
                                        {!!Form::open()!!}
                                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                        {!!Form::close()!!}
                                        {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consulted',$examination->id]])!!}
                                        {!! Form::submit('Refer Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div><!-- /. modal dialog -->
                        </div>
                        <!-- Refer patient-->
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="text-muted" role="presentation"><a href="#demographics" aria-controls="home" role="tab" data-toggle="tab">Demographics</a></li>
                                <li class="text-muted" role="presentation"><a href="#health_vitals" aria-controls="health_vitals" role="tab" data-toggle="tab">Health Vitals</a></li>
                                <li class="text-muted" role="presentation"><a href="#medical_history" aria-controls="medical_history" role="tab" data-toggle="tab">Medical History</a></li>
                                <li class="text-muted" role="presentation"><a href="#medication" aria-controls="medication" role="tab" data-toggle="tab">Medications</a></li>
                                <li class="text-muted" role="presentation"><a href="#allergies" aria-controls="allergies" role="tab" data-toggle="tab">Allergies</a></li>
                                <li class="text-muted" role="presentation"><a href="#lab_records" aria-controls="lab_records" role="tab" data-toggle="tab">Lab Records</a></li>
                                <li class="text-muted" role="presentation"><a href="#inpatient" aria-controls="inpatient" role="tab" data-toggle="tab">Inpatient</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active wrapper" id="demographics">
                                    <a class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".update-demographics1"><i class="fa fa-pencil"></i> Update Demographics</a>
                                    <div class="row col-md-12">
                                        <h1 class="h6 m-b-sm m-t-sm text-muted">Primary Details</h1>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">First Name:</span> {{ $patient->first_name }}
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">Middle Name:</span> {{ $patient->middle_name }}<br>
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">Last Name:</span> {{ $patient->last_name }}<br>
                                                </p>
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">Gender:</span> {{ $patient->gender }}<br>
                                                </p>
                                                @if($patient->date_birth=="")
                                                <p class="h6 m">
                                                    <span class="text-muted">Date of Birth:</span> N/A<br>
                                                </p>
                                                @else
                                                <p class="h6 m">
                                                    <span class="text-muted">Date of Birth:</span>
                                                    {{ \Carbon\Carbon::parse($patient->date_birth)->toFormattedDateString() }}
                                                    <br>
                                                </p>
                                                @endif
                                                @if($patient->estimated_age=="")
                                                @else
                                                <span class="text-muted">Estimated Age:</span> {{ $patient->estimated_age }} years old<br>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <h1 class="text-muted h6 m-b-sm m-t-sm">Contact Details</h1>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">Patient Phone: </span> {{ $patient->patient_phone }}
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">Email:</span> {{ $patient->email }}<br>
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">Country:</span> {{ $patient->country_origin }}<br>
                                                </p>
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">Residence:</span> {{ $patient->residence }}<br>
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">County:</span> {{ $patient->county }}<br>
                                                </p>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <h1 class="text-muted h6 m-b-sm m-t-sm">Next of Kin Details</h1>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">Name: </span> {{ $patient->kin_name }}
                                                </p>
                                                <p class="h6 m">
                                                    <span class="text-muted">Relationship:</span> {{ $patient->kin_relationship }}<br>
                                                </p>
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="m-t-xs">
                                                <p class="h6 m">
                                                    <span class="text-muted">Phone:</span> {{ $patient->kin_phone }}
                                                    <br>
                                                </p>
                                            </small>
                                        </div>
                                    </div>

                                </div>
                                <!-- Update Details Modal -->
                                <div class="modal fade update-demographics1" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <h4 class="font-thin text-center">Update Demographics <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! Form::open(['method'=>'PUT','action'=>['Medical\PatientController@updatePatient', $patient->id ]])!!}
                                                        <div class="form-group col-md-6">
                                                            <label>Primary Details</label>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ $patient->first_name }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" value="{{ $patient->middle_name }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                                                value="{{ $patient->last_name }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" id="datepicker" class="form-control datepicker-here" data-language='en' name="date_birth" value="{{ $patient->date_birth }}" data-view="years" data-date-format="yyyy-mm-dd" placeholder="Date of Birth" onkeydown="return false">
                                                            </div>
                                                            @if($patient->estimated_age)
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="estimated_age" placeholder="or Estimated age" value="{{ $patient->estimated_age }}">
                                                            </div>
                                                            @endif
                                                            @if($patient->gender === "Male")
                                                            <div class="form-group col-md-12">
                                                                <label>
                                                                    Gender:
                                                                </label>
                                                                <div class="radio">
                                                                    <label class="i-checks">
                                                                        <input type="radio" name="gender" value="Male" checked>
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
                                                            @else
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
                                                                        <input type="radio" name="gender" value="Female" checked>
                                                                        <i></i>
                                                                        Female
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Contact Details</label>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="phone" class="form-control" name="patient_phone" placeholder="Patient Phone" value="{{ $patient->patient_phone }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="kin_name" placeholder="Name of Kin" value="{{ $patient->kin_name }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="kin_relationship" placeholder="Relationship of Kin" value="{{ $patient->kin_phone }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="phone" class="form-control" name="kin_phone" placeholder="Next of Kin Phone" value="{{ $patient->kin_phone }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="emial" class="form-control" name="email" placeholder="Patient Email" value="{{ $patient->email }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <input type="text" class="form-control" name="residence" placeholder="Residence" value="{{ $patient->residence }}">
                                                            </div>
                                                            <div class="input-group m-b col-md-12">
                                                                <select class="form-control m-b" name="county" value="{{ $patient->county }}">
                                                                    @include('templates.reception.select-counties')
                                                                </select>
                                                            </div>
                                                            <div class="input-group m-b col-md-12">

                                                                <select class="form-control m-b" name="country_origin" value="{{ $patient->country_origin }}">
                                                                    @include('templates.reception.select-countries')
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Update Demographics', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- End Update Details Modal -->
                                <div role="tabpanel" class="tab-pane wrapper fade in" id="health_vitals">
                                    <h1 class="h6 m-b-sm m-t-sm"></h1>
                                    @if(count($vitals)>0)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Health Vitals
                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".health-vitals"><i class="fa fa-plus"></i> Add Health Vitals</button>
                                        </div>
                                        <div class="panel-body table-responsive">
                                            <table class="table table-hover m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Weight</th>
                                                        <th>Height</th>
                                                        <th>BMI</th>
                                                        <th>Blood Pressure</th>
                                                        <th>Pulse</th>
                                                        <th>Temp</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($vitals->reverse() as $vital)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($vital->created_at)->format('d/m/Y') }}</td>
                                                        <td>{{$vital->weight}} Kg</td>
                                                        <td>{{$vital->height}} cm</td>
                                                        <td>{{$vital->bmi}}</td>
                                                        <td>{{$vital->blood_pressure}} bpm</td>
                                                        <td>{{$vital->pulse}} bpm</td>
                                                        <td>{{$vital->temperature}}&deg;C</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer bg-light lt">
                                            <div class="text-center">{{ $vitals->links() }}</div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Other Vitals
                                        </div>
                                        <div class="panel-body table-responsive">
                                            <table class="table table-hover m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th title="Cardiovascular">Cardiova...</th>
                                                        <th>Respiratory</th>
                                                        <th>Abdomen</th>
                                                        <th>Blood Sug..</th>
                                                        <th>Stool</th>
                                                        <th>Urine</th>
                                                        <th>HIV I&II</th>
                                                        <th title="Haemoglobin">Haemo...</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($vitals2->reverse() as $vital2)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($vital2->created_at)->format('d/m/Y') }}</td>
                                                        <td>{{$vital2->cardiovascular}}</td>
                                                        <td>{{$vital2->respiratory}}</td>
                                                        <td>{{$vital2->abdomen}}</td>
                                                        <td>{{$vital2->blood_sugar}}</td>
                                                        <td>{{$vital2->stool}}</td>
                                                        <td>{{$vital2->urine}}</td>
                                                        <td>{{$vital2->hiv_I_II}}</td>
                                                        <td>{{$vital2->haemoglobin}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer bg-light lt">
                                            <div class="text-center">{{ $vitals->links() }}</div>
                                        </div>
                                    </div>
                                    @else
                                    There is no past vital recorded.
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".health-vitals"><i class="fa fa-plus"></i> Add Health Vitals</button>
                                    @endif
                                </div>
                                <!--  Health Vitals -->
                                <div class="modal fade health-vitals" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <h4 class="font-thin text-center">Add Health Vitals <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\VitalsController@addVitals']])!!}
                                                        <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Weight in Kg</label>
                                                            <input name="weight" class="form-control focus" type="text" value="{{ old('weight') }}" autocomplete="off" title="Enter weight in Kg without units. e.g. 56" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Height in cm</label>
                                                            <input name="height" class="form-control" type="text" value="{{ old('height') }}" autocomplete="off" title="Enter Height in cm without units. e.g. 123" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter BMI</label>
                                                            <input name="bmi" class="form-control" type="text" value="{{ old('bmi') }}" autocomplete="off" title="Enter BMI e.g. 23"  required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Blood Pressure in bpm</label>
                                                            <input name="blood_pressure" class="form-control" type="text" value="{{ old('blood_pressure') }}" autocomplete="off" title="Enter Blood Pressure in bpm" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Pulse in bpm</label>
                                                            <input name="pulse" class="form-control" type="text" value="{{ old('pulse') }}" autocomplete="off" title="Enter Pulse in bpm"  required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Temp. in Degrees Celcius</label>
                                                            <input name="temperature" class="form-control" type="text"  value="{{ old('temperature') }}" autocomplete="off" title="Temperature in Degrees Celcius" required/>
                                                        </div>
                                                        <label class="form-group col-md-12 text-center"><strong>Other Vitals</strong></label><br>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Cardiovascular System</label>
                                                            <input name="cardiovascular" class="form-control" type="text" value="{{ old('cardiovascular') }}" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Respiratory System</label>
                                                            <input name="respiratory" class="form-control" type="text" value="{{ old('respiratory') }}" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Abdomen</label>
                                                            <input name="abdomen" class="form-control" type="text" value="{{ old('abdomen') }}" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Random Blood Sugar</label>
                                                            <input name="blood_sugar" class="form-control" type="text" value="{{ old('blood_sugar') }}" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Stool</label>
                                                            <input name="stool" class="form-control" type="text" value="{{ old('stool') }}" autocomplete="off"/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Urine</label>
                                                            <input name="urine" class="form-control" type="text" value="{{ old('urine') }}" autocomplete="off" />
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>HIV I & II</label>
                                                            <input name="hiv_I_II" class="form-control" type="text"  value="{{ old('hiv_I_II') }}" autocomplete="off" />
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Full Haemogram</label>
                                                            <input name="haemoglobin" class="form-control" type="text"  value="{{ old('haemoglobin') }}" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Save Health Vitals', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                    </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <div role="tabpanel" class="tab-pane wrapper fade in" id="medical_history">
                                    <h1 class="h6 m-b-sm m-t-sm"></h1>
                                    @if(count($diagnosis)>0)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Diagnosis
                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".diagnosis"><i class="fa fa-plus"></i> Add Diagnosis</button>
                                        </div>
                                        <table class="table table-hover m-b-none">
                                            <thead>
                                                <tr>
                                                    <th>Diagnosis</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                    <th>Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($diagnosis->reverse() as $diagnos)
                                                <tr>
                                                    <td>{{$diagnos->diagnosis}}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($diagnos->from_date)->toFormattedDateString() }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($diagnos->to_date)->toFormattedDateString() }}</td>
                                                        <td>{{$diagnos->notes}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="panel-footer bg-light lt">
                                                <div class="text-center">{{ $diagnosis->links() }}</div>
                                            </div>
                                        </div>
                                        @else
                                        There is no past diagnosis recorded.
                                        <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".diagnosis"><i class="fa fa-plus"></i> Add Diagnosis</button>
                                        @endif
                                        <!--  Add Diagnosis -->
                                        <div class="modal fade diagnosis" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info dk">
                                                        <h4 class="font-thin text-center">Add Diagnosis<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                {!! Form::open(['method'=>'POST', 'action'=>['Medical\DiagnosisController@addDiagnosis']])!!}
                                                                <div class="form-group col-md-12">
                                                                    <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                    <div class="input-group m-b col-md-12">
                                                                        <input class="form-control focus" type="text" name="diagnosis_title" placeholder="Diagnosis" value="{{ old('diagnosis_title') }}" autocomplete="off" />
                                                                    </div>
                                                                    <div class="input-group m-b col-md-6">
                                                                        <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="diagnosis_fromdate" placeholder="From Date" value="{{ old('diagnosis_fromdate') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                    </div>
                                                                    <div class="input-group m-b col-md-6">
                                                                        <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="diagnosis_todate" placeholder="To Date" value="{{ old('diagnosis_todate') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                    </div>
                                                                    <div class="input-group m-b col-md-12">
                                                                        <textarea type="text" class="form-control" name="diagnosis_notes" placeholder="Notes on Diagnosis" rows="8" value="{{ old('diagnosis_notes') }}"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-light lt">
                                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                        {!! Form::submit('Add Diagnosis', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                        {!!Form::close()!!}
                                                    </div>
                                                </div>
                                            </div><!-- /. modal dialog -->
                                        </div><!-- /. modal-->

                                        <div class="wrapper"></div>
                                        @if(count($immunizations)>0)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Immunizations
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".immunization"><i class="fa fa-plus"></i> Add Immunizations</button>
                                            </div>
                                            <table class="table table-hover m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Vaccine</th>
                                                        <th>Date/Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($immunizations->reverse() as $immunization)
                                                    <tr>
                                                        <td>{{$immunization->vaccine}}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($immunization->date_administered)->toFormattedDateString() }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="panel-footer bg-light lt">
                                                    <div class="text-center">{{ $immunizations->links() }}</div>
                                                </div>
                                            </div>
                                            @else
                                            There is no past immunization recorded.
                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".immunization"><i class="fa fa-plus"></i> Add Immunization</button>
                                            @endif
                                            <!--  Add Immunization -->
                                            <div class="modal fade immunization" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info dk">
                                                            <h4 class="font-thin text-center">Add Immunization<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\ImmunizationController@addImmunization']])!!}
                                                                    <div class="form-group col-md-12">
                                                                        <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                        <div class="input-group m-b col-md-12">
                                                                            <input class="form-control focus" type="text" name="vaccine_name" placeholder="Name of Vaccine" value="{{ old('vaccine_name') }}" autocomplete="off"/>
                                                                        </div>
                                                                        <div class="input-group m-b col-md-12">
                                                                            <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="vaccine_date" placeholder="Date of Vaccine Administration"  value="{{ old('vaccine_date') }}" data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light lt">
                                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                            {!! Form::submit('Add Immunization', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                            {!!Form::close()!!}
                                                        </div>
                                                    </div>
                                                </div><!-- /. modal dialog -->
                                            </div><!-- /. modal-->
                                            <div class="wrapper"></div>
                                            @if(count($therapies)>0)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Injections/ Intravenous Therapies
                                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".therapy"><i class="fa fa-plus"></i> Add Injections/ Therapies</button>
                                                </div>
                                                <table class="table table-hover m-b-none">
                                                    <thead>
                                                        <tr>
                                                            <th>Name of Therapy</th>
                                                            <th>Date Administered</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($therapies->reverse() as $therapy)
                                                        <tr>
                                                            <td>{{ $therapy->therapy_name }}</td>
                                                            <td>
                                                                {{ \Carbon\Carbon::parse($therapy->date_administered)->toFormattedDateString() }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="panel-footer bg-light lt">
                                                        <div class="text-center">{{ $therapies->links() }}</div>
                                                    </div>
                                                </div>
                                                @else
                                                There is no past therapy recorded.
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".therapy"><i class="fa fa-plus"></i> Add Therapy</button>
                                                @endif
                                                <!--  Add Therapy -->
                                                <div class="modal fade therapy" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-info dk">
                                                                <h4 class="font-thin text-center">Add Injections/ Intravenous Therapies<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\TherapyController@addTherapy']])!!}
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input class="form-control focus" type="text" name="therapy_name" placeholder="Name of therapy" value="{{ old('therapy_name') }}"/>
                                                                            </div>
                                                                            <div class="input-group m-b col-md-6">
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="therapy_date" placeholder="Date administered" value="{{ old('therapy_date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light lt">
                                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                                {!! Form::submit('Add Therapy', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                {!!Form::close()!!}
                                                            </div>
                                                        </div>
                                                    </div><!-- /. modal dialog -->
                                                </div><!-- /. modal-->
                                                <div class="wrapper"></div>
                                                @if(count($procedures)>0)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Procedures, Surgeries and Hospitalization
                                                        <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".procedures"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
                                                    </div>
                                                    <table class="table table-hover m-b-none">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Type</th>
                                                                <th>Notes</th>
                                                                <th>From Date</th>
                                                                <th>To Date</th>
                                                                <th>Duration</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($procedures->reverse() as $procedure)
                                                            <tr>
                                                                <td>{{ $procedure->procedure_name }}</td>
                                                                <td>{{ $procedure->procedure_type }}</td>
                                                                <td>{{ $procedure->procedure_notes }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($procedure->from_date)->toFormattedDateString() }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($procedure->to_date)->toFormattedDateString() }}</td>
                                                                <td>{{ $procedure->duration }} days</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="panel-footer bg-light lt">
                                                        <div class="text-center">{{ $procedures->links() }}</div>
                                                    </div>
                                                </div>
                                                @else
                                                There is no past procedure, surgery, hospitalization etc. recorded.
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".procedures"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
                                                @endif
                                                <!--  Add Procedure -->
                                                <div class="modal fade procedures" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-info dk">
                                                                <h4 class="font-thin text-center">Add procedures, surgeries etc.<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\ProcedureController@addProcedure']])!!}
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input class="form-control focus" type="text" name="procedure_name" placeholder="Name of procedure, surgeries, hospitalizations etc." value="{{ old('procedure_name') }}" autocomplete="off" />
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input class="form-control" type="text" name="procedure_type" placeholder="Type of procedure, surgery, hospitalization" value="{{ old('procedure_type') }}" autocomplete="off"/>
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <textarea class="form-control" type="text" name="procedure_notes" placeholder="Notes" value="{{ old('procedure_notes') }}"></textarea>
                                                                            </div>
                                                                            <div class="input-group m-b col-md-6">
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="from_date" placeholder="Starting Date" value="{{ old('from_date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                            </div>
                                                                            <div class="input-group m-b col-md-6">
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="to_date" placeholder="To Date" value="{{ old('to_date') }}"  data-date-format="dd MM yyyy"" onkeydown="return false" autocomplete="off">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light lt">
                                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                                {!! Form::submit('Add procedures etc.', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                {!!Form::close()!!}
                                                            </div>
                                                        </div>
                                                    </div><!-- /. modal dialog -->
                                                </div><!-- /. modal-->
                                                <div class="wrapper"></div>
                                                @if(count($histories)>0)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Family and Social History
                                                        <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".history"><i class="fa fa-plus"></i> Add Family and Social History</button>
                                                    </div>
                                                    <table class="table table-hover m-b-none">
                                                        <thead>
                                                            <tr>
                                                                <th>History</th>
                                                                <th>Relationship</th>
                                                                <th>From Date</th>
                                                                <th>To Date</th>
                                                                <th>Status</th>
                                                                <th>Notes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($histories->reverse() as $history)
                                                            <tr>
                                                                <td>{{ $history->history }}</td>
                                                                <td>{{ $history->relationship}}</td>
                                                                <td>{{ \Carbon\Carbon::parse($history->from_date)->toFormattedDateString() }}
                                                                </td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($history->to_date)->toFormattedDateString() }}</td>
                                                                    <td>{{ $history->status }}</td>
                                                                    <td>{{ $history->notes }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="panel-footer bg-light lt">
                                                            <div class="text-center">{{ $histories->links() }}</div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    There is no past Family or Social history recorded.
                                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".history"><i class="fa fa-plus"></i> Add Family and Social History</button>
                                                    @endif
                                                </div>

                                                <!--  Add Family and Social History -->
                                                <div class="modal fade history" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-info dk">
                                                                <h4 class="font-thin text-center">Add History<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\HistoryController@addHistory']])!!}
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input class="form-control focus" type="text" name="history_name" placeholder="History" value="{{ old('history_name') }}" autocomplete="off" />
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input class="form-control" type="text" name="history_relationship" placeholder="Relationship" value="{{ old('history_relationship') }}" autocomplete="off"/>
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <textarea class="form-control" type="text" name="history_notes" placeholder="Notes" value="{{ old('history_notes') }}"></textarea>
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="history_from" placeholder="From Date" value="{{ old('history_from') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="history_to" placeholder="To Date" value="{{ old('history_to') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off">
                                                                            </div>
                                                                            <div class="input-group m-b col-md-12">
                                                                                <label>
                                                                                    Choose current status:
                                                                                </label>
                                                                                <div class="radio">
                                                                                    <label class="i-checks">
                                                                                        <input type="radio" name="history_status" value="Alive" required>
                                                                                        <i></i>
                                                                                        Alive
                                                                                    </label>
                                                                                </div>
                                                                                <div class="radio">
                                                                                    <label class="i-checks">
                                                                                        <input type="radio" name="history_status" value="Dead">
                                                                                        <i></i>
                                                                                        Dead
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light lt">
                                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="moautocomplete="off"dal"> Go Back</button>
                                                                {!! Form::submit('Add History', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                {!!Form::close()!!}
                                                            </div>
                                                        </div>
                                                    </div><!-- /. modal dialog -->
                                                </div><!-- /. modal-->
                                                <div role="tabpanel" class="tab-pane wrapper fade in lter" id="medication">
                                                    <div class="wrapper "></div>
                                                    @if(count($medications)>0)
                                                    <div class="panel panel-default ">
                                                        <div class="panel-heading ">
                                                            Medications
                                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".medication"><i class="fa fa-plus"></i> Prescribe Medication</button>
                                                        </div>
                                                        <table class="table table-hover m-b-none ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Prescription</th>
                                                                    <th>Description</th>
                                                                    <th>From Date</th>
                                                                    <th>To Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($medications->reverse() as $medication)
                                                                <tr>
                                                                    <td>
                                                                        {{ $medication->inventory->drug_name }}
                                                                    </td>
                                                                    @if(!$medication->description)
                                                                    <td><i>N/A</i></td>
                                                                    @else
                                                                    <td>{{ $medication->description }}</td>
                                                                    @endif
                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($medication->from_date)->toFormattedDateString() }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($medication->to_date)->toFormattedDateString() }}
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="panel-footer bg-light lt">{{ $medications->links() }}</div>
                                                    </div>

                                                    @else
                                                    There is no medication recorded.
                                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".medication"><i class="fa fa-plus"></i> Add Medication</button>
                                                    @endif
                                                </div>
                                                <!--  Prescribe Medication -->
                                                <div class="modal fade medication" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-info dk">
                                                                <h4 class="font-thin text-center">Prescribe Medication <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\MedicationController@prescribeMedication']])!!}
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                            <div class="form-group m-b col-md-12">
                                                                                <select class="form-control w-full prescription-drug focus" ui-jq="chosen" name="inventory_id" title="Search and select the drug to be adminstered to the patient. Note that these are the drugs available in the health pharmacy.">
                                                                                    <option class="text-muted" value="">Select a Drug...</option>
                                                                                    @foreach($drugs as $drug)
                                                                                    <option value="{{ $drug->id }}">{{ $drug->drug_name }} ({{ $drug->formulation }})</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group m-b col-md-6">
                                                                                <label class="text-muted">Quantity to be consumed each time?</label>
                                                                                <input name="quantity_consumed" ui-jq="TouchSpin" class="form-control" data-step=".5" data-decimals="1" data-min="0.5" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;" type="text" value="{{ old('quantity_consumed') }}" autocomplete="off" title="Input the quantity of the drug to be consumed each time by the patient e.g. 2" required/>
                                                                            </div>
                                                                            <div class="form-group m-b col-md-6">
                                                                                <label class="text-muted">How many times a day?</label>
                                                                                <input name="times_a_day" ui-jq="TouchSpin" class="form-control" data-min="1" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;" type="text" onkeydown="return false" value="{{ old('times_a_day') }}" autocomplete="off" title="Input the no of times a day the patient should consume the drug e.g. 3" required/>
                                                                            </div>
                                                                            <div class="form-group m-b col-md-6">
                                                                                <label class="text-muted">For how many days?</label>
                                                                                <input name="no_of_days" ui-jq="TouchSpin" class="form-control" data-min="1" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;" type="text" onkeydown="return false" value="{{ old('no_of_days') }}" autocomplete="off" title="Input the number of days the patient should consume the drug e.g. 2" required/>
                                                                            </div>
                                                                            <div class="m-b col-md-12 form-group">
                                                                                <label class="text-muted">Start Date</label>
                                                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date startD focus_input" data-language='en' name="startDate" placeholder="Date to begin medication" value="{{ old('diagnosis_fromdate') }}"  data-date-format="dd MM yyyy" data-position="top left" onkeydown="return false" autocomplete="off" title="Choose date to start Medication" required>
                                                                            </div>
                                                                            <div class="col-md-12 form-group">
                                                                                <label class="text-muted">End Date</label>
                                                                                <input type="date" class="form-control from_date endD" data-language='en' name="endDate" placeholder="Date to end medication" value="{{ old('diagnosis_fromdate') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" data-position="top left" title="Choose date to end Medication" required>
                                                                            </div>
                                                                            <div class="form-group m-b col-md-12">
                                                                                <textarea type="text" class="form-control" name="description" placeholder="Prescription Notes" rows="5" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light lt">
                                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                                {!! Form::submit('Prescribe Medication', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                {!!Form::close()!!}
                                                            </div>
                                                        </div>
                                                    </div><!-- /. modal dialog -->
                                                </div><!-- /. modal-->

                                                <div role="tabpanel " class="tab-pane wrapper fade in lter " id="allergies">
                                                    <div class="wrapper "></div>
                                                    @if(count($allergies)>0)
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            Allergies
                                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".allergy"><i class="fa fa-plus"></i> Add Allergy</button>
                                                        </div>
                                                        <div class="panel-body"> 
                                                            <table class="table table-hover m-b-none ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Allergen</th>
                                                                        <th>Severity</th>
                                                                        <th>Observed on</th>
                                                                        <th>Status</th>
                                                                        <th>Reactions</th>
                                                                        <th>Notes</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($allergies->reverse() as $allergy)
                                                                    <tr>
                                                                        <td>{{ $allergy->allergy }}</td>
                                                                        <td>{{ $allergy->severity }}</td>
                                                                        <td>
                                                                            {{ Carbon\Carbon::parse($allergy->observation_date)->toFormattedDateString() }}</td>
                                                                            <td>
                                                                                @if($allergy->status==1)
                                                                                Active    
                                                                                @else
                                                                                Not Active
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $allergy->reactions }}</td>
                                                                            <td>{{ $allergy->notes }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="panel-footer bg-light lt"> 
                                                                {{ $allergies->links() }}
                                                            </div>
                                                        </div>

                                                        @else
                                                        There is no past allergy recorded.
                                                        <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".allergy"><i class="fa fa-plus"></i> Add Allergy</button>
                                                        @endif
                                                    </div>
                                                    <!--  Add Allergy -->
                                                    <div class="modal fade allergy" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info dk">
                                                                    <h4 class="font-thin text-center">Add Allergy<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            {!! Form::open(['method'=>'POST', 'action'=>['Medical\AllergyController@addAllergy']])!!}
                                                                            <div class="form-group col-md-12">
                                                                                <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <input class="form-control focus" type="text" name="allergy_name" placeholder="Allergy Name" value="{{ old('allergy_name') }}" autocomplete="off" />
                                                                                </div>
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <input class="form-control" type="text" name="allergy_severity" placeholder="Severity" value="{{ old('allergy_severity') }}" autocomplete="off"/>
                                                                                </div>
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="allergy_date" placeholder="Observation Date" value="{{ old('allergy_date') }}"  data-date-format="dd MM yyyy"" onkeydown="return false" autocomplete="off">
                                                                                </div>
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <input class="form-control" type="text" name="allergy_reactions" placeholder="Reactions" value="{{ old('allergy_reactions') }}" autocomplete="off"/>
                                                                                </div>
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <textarea class="form-control" type="text" name="allergy_notes" placeholder="Notes" value="{{ old('allergy_notes') }}"></textarea>
                                                                                </div>
                                                                                <div class="input-group m-b col-md-12">
                                                                                    <label>
                                                                                        Choose Allergy status:
                                                                                    </label>
                                                                                    <div class="radio">
                                                                                        <label class="i-checks">
                                                                                            <input type="radio" name="allergy_status" value="1" checked>
                                                                                            <i></i>
                                                                                            Active
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio">
                                                                                        <label class="i-checks">
                                                                                            <input type="radio" name="allergy_status" value="0">
                                                                                            <i></i>
                                                                                            Not Active
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer bg-light lt">
                                                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                                    {!! Form::submit('Add Allergy', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                    {!!Form::close()!!}
                                                                </div>
                                                            </div>
                                                        </div><!-- /. modal dialog -->
                                                    </div><!-- /. modal-->
                                                    <div role="tabpanel" class="tab-pane wrapper fade in lter " id="lab_records">
                                                        <div class="wrapper "></div>
                                                        @if(count($labs)>0)
                                                        <div class="panel panel-default ">
                                                            <div class="panel-heading ">
                                                                Lab Records
                                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".lab"><i class="fa fa-plus"></i> Request Lab Test</button>
                                                            </div>
                                                            <div class="panel-body table-responsive">
                                                                <table class="table table-hover m-b-none ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:20%">Test Name</th>
                                                                            <th style="width:20%">Lab Review</th>
                                                                            <th style="width:20%">Date</th>
                                                                            <th style="width:20%">Status</th>
                                                                            <th class="text-center" style="width:20%">Options</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($labs->reverse() as $lab)
                                                                        <tr>
                                                                            <td>
                                                                                {{ str_limit($lab->lab_name, $limit = 15, $end = '...') }}
                                                                            </td>
                                                                            <td>@if($lab->lab_review)
                                                                                {{ str_limit($lab->lab_review, $limit = 15, $end = '...') }}
                                                                                @else
                                                                                N/A
                                                                                @endif  
                                                                            </td>
                                                                            <td>
                                                                                {{ \Carbon\Carbon::parse($lab->created_at)->toFormattedDateString() }}
                                                                            </td>
                                                                            <td>
                                                                                @if($lab->status==0)
                                                                                Not Complete
                                                                                @elseif($lab->status==2)
                                                                                Completed
                                                                                @else 
                                                                                In Progress
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="text-center">
                                                                                    @if($lab->status==2)
                                                                                    <button class="btn btn-xs btn-info col-md-6" data-toggle="modal" data-target=".lab-edit-{{$lab->id}}">Review</button>
                                                                                    @endif
                                                                                    <button class="btn btn-xs btn-default text-center" data-toggle="modal" data-target=".lab-view-{{$lab->id}}"><i class="fa fa-eye"></i> View</button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <div class="modal fade lab-edit-{{$lab->id}} focus" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-info dk">
                                                                                        <h4 class="font-thin text-center">Lab Review<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12 col-sm-12">
                                                                                                {!!Form::open(['method'=>'PUT','action'=>['Lab\LabController@updateReview',$lab->id]])!!}
                                                                                                <div class="col-md-10 col-md-offset-1">
                                                                                                    <label><strong>Lab Name: </strong> <i>{{ $lab->lab_name }}</i></label><br>
                                                                                                    <label><strong>Lab Review:</strong>
                                                                                                    </label><br>
                                                                                                    <textarea class="form-control focus col-md-12 m-b focus" name="lab_review" rows="5">{{$lab->lab_review}}</textarea>
                                                                                                    <br>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer bg-light lt">
                                                                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                                                        {!! Form::submit('Update Lab Review', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                                        {!!Form::close()!!}
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- /. modal dialog -->
                                                                        </div>
                                                                        <div class="modal fade lab-view-{{$lab->id}}" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-info dk">
                                                                                        <h4 class="font-thin text-center">Lab Request <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-12 col-sm-12">
                                                                                                <div class="col-md-10 col-md-offset-1">
                                                                                                    <label><strong>Lab Name: </strong> <i>{{ $lab->lab_name }}</i></label><br>
                                                                                                    <label><strong>Lab Status:</strong> <i>@if($lab->status==0)
                                                                                                        Not Complete
                                                                                                        @elseif($lab->status==2)
                                                                                                        Completed
                                                                                                        @endif</i></label>
                                                                                                        <br><label><strong>From Doctor:</strong> <i>{{ $lab->user->full_name }}</i></label><br>
                                                                                                        <label><strong>Lab Request:</strong><br> <i>{{$lab->lab_notes}}</i></label><hr>
                                                                                                        <label><strong>Lab Review:</strong>
                                                                                                            <i><br>
                                                                                                                @if($lab->lab_review)
                                                                                                                {{ $lab->lab_review }}
                                                                                                                @else
                                                                                                                None
                                                                                                                @endif
                                                                                                            </i></label>
                                                                                                            <br><hr>
                                                                                                            <label><strong>Lab Document:</strong> 
                                                                                                                @if($lab->lab_document)
                                                                                                                {{ $lab->lab_document }}
                                                                                                                @else
                                                                                                                N/A
                                                                                                                @endif
                                                                                                            </label><br>
                                                                                                            <label><strong>Created on:</strong> <i>{{ \Carbon\Carbon::parse($lab->created_at)->toFormattedDateString() }}</i></label><br>
                                                                                                            <label><strong>Updated on:</strong> <i>{{ \Carbon\Carbon::parse($lab->updated_at)->toFormattedDateString() }}</i></label><br>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer bg-light lt">
                                                                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- /. modal dialog -->
                                                                                </div>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="panel-footer bg-light lt">
                                                                        <div>{{ $labs->links() }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            There is no past lab test that is recorded.
                                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".lab"><i class="fa fa-plus"></i> Request Lab Test</button>
                                                            @endif
                                                            <!--  Request Lab Document -->
                                                            <div class="modal fade lab" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-info dk">
                                                                            <h4 class="font-thin text-center">Lab Test Request<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    {!! Form::open(['method'=>'POST', 'action'=>['Lab\LabController@addLab']])!!}
                                                                                    <div class="form-group col-md-12">
                                                                                        <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                                                                                        <div class="input-group m-b col-md-12">
                                                                                            <input class="form-control focus" type="text" name="lab_name" placeholder="Lab Name" autocomplete="off" required>
                                                                                        </div>
                                                                                        <div class="input-group m-b col-md-12">
                                                                                            <textarea class="form-control" name="lab_notes" placeholder="Lab Notes" rows="4" required></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer bg-light lt">
                                                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                                                            {!! Form::submit('Request Test', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                                            {!!Form::close()!!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /. modal dialog -->
                                <!-- <div class="row wrapper ">
                                    <a href=" " class="btn btn-info "><i class="fa fa-close "></i> Done with Record</a>
                                </div> -->

                                <div role="tabpanel" class="tab-pane wrapper fade in" id="inpatient">
                                    <h1 class="h6 m-b-sm m-t-sm"></h1>
                                    @if(count($inpatients)>0)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Inpatient
                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".admit-patient"><i class="fa fa-plus"></i> Add Inpatient Record</button>
                                        </div>
                                        <div class="panel-body table-responsive">
                                            <table class="table table-hover m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th style="width:35%">Patient</th>
                                                        <th style="width:20%">Bed</th>
                                                        <th style="width:10%">Status</th>
                                                        <th class="text-center" style="width:20%">Options</th
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
                                                                <button class="btn btn-xs btn-default col-md-6 col-md-offset-3" data-toggle="modal" data-target=".view-inpatient">View</button>
                                                            </td>
                                                        </tr>
                                                        <!-- View Inpatient -->
                                                        <div class="modal fade view-inpatient" tabindex="-1">
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
                                                <div class="panel-footer bg-light lt">
                                                    <div class="text-center">{{ $inpatients->links() }}</div>
                                                </div>
                                            </div>
                                            @else
                                            There is no past inpatient record.
                                            <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".admit-patient"><i class="fa fa-plus"></i> Add Admit Patient</button>
                                            @endif

                                            <div class="modal fade admit-patient" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk text-center">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Admit Patient</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    </div><br>
                                                    {!!Form::open(['action'=>['Nurse\InpatientController@createInpatient']])!!}
                                                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                                                    <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer bg-light bg"></div>
                    </div>
                    @endif