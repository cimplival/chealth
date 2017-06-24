@if(count($patient)>0)
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
                            <div class="col-md-3 pull-right">
                                <a class="btn btn-info btn-sm col-md-12" data-toggle="modal" data-target=".certificate-{{$patient->id}}">Medical Certificate <i class="fa fa-certificate"></i></a>
                            </div>
                            <p>
                                <span class="h4 m-b-sm m-t-sm block">
                                    {{ $patient->firstName }} {{ $patient->middleName }} {{ $patient->lastName }}</span><input name="medId" type="hidden" value="{{ $patient->medId }}"></input>Age: {{ Carbon\Carbon::parse($patient->dateOfBirth)->age }} years
                                <br>Gender: {{ $patient->gender }}</p>
                                <p><span class="label bg-info pos-rlt m-r inline wrapper-xs">{{ $patient->medId }}</span> </span>
                                <br>
                            </p>
                        </li>
                        <div class="modal fade certificate-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center">Medical Certificate</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                        {!! Form::open(['method'=>'POST', 'action'=>['Medical\SecondaryVitalsController@saveAllVitals']])!!}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <input name="medId" type="hidden" value="{{ $patient->medId }}"></input>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Weight in Kgs</label>
                                                            <input name="weight" class="form-control" type="text" value="{{ old('weight') }}" autocomplete="off" title="Enter weight in Kg without units. e.g. 56" required/>
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
                                                            <input name="bloodPressure" class="form-control" type="text" value="{{ old('bloodPressure') }}" autocomplete="off" title="Enter Blood Pressure in bpm" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Pulse in bpm</label>
                                                            <input name="pulse" class="form-control" type="text" value="{{ old('pulse') }}" autocomplete="off" title="Enter Pulse in bpm" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Enter Temp. in Degrees Celcius</label>
                                                            <input name="temperature" class="form-control" type="text"  value="{{ old('temperature') }}" autocomplete="off" title="Temperature in Degrees Celcius" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Cardiovascular System</label>
                                                            <input name="cardiovascular" class="form-control" type="text" value="{{ old('cardiovascular') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Respiratory System</label>
                                                            <input name="respiratory" class="form-control" type="text" value="{{ old('respiratory') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Abdomen</label>
                                                            <input name="abdomen" class="form-control" type="text" value="{{ old('abdomen') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Random Blood Sugar</label>
                                                            <input name="blood_sugar" class="form-control" type="text" value="{{ old('blood_sugar') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Stool</label>
                                                            <input name="stool" class="form-control" type="text" value="{{ old('stool') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Urine</label>
                                                            <input name="urine" class="form-control" type="text" value="{{ old('urine') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>HIV I & II</label>
                                                            <input name="hivI_II" class="form-control" type="text"  value="{{ old('hivI_II') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-6">
                                                            <label>Full Haemogram</label>
                                                            <input name="haemoglobin" class="form-control" type="text"  value="{{ old('haemoglobin') }}" autocomplete="off" required/>
                                                        </div>
                                                        <div class="form-group m-b col-md-12">
                                                            <label>Conclusion</label>
                                                            <textarea name="conclusion" class="form-control" type="text"  value="{{ old('conclusion') }}" autocomplete="off" title="Conclusion" required></textarea>
                                                        </div>
                                                        <div class="form-group m-b col-md-12">
                                                            <label>Name and Designate</label>
                                                            <input name="name_designate" class="form-control" type="text"  value="{{ old('name_designate') }}" autocomplete="off" required/>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light dk">
                                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Go Back</button>
                                        {!! Form::submit('Create Medical Certificate', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
