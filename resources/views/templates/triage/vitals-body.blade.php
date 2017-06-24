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
        {!! Form::open(array('route' => 'search-vitals', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Vitals" name="search" class="form-control search-input" type="text" autocomplete="off" required>
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
                        <th style="width:20%">Service</th>
                        <th style="width:15%">Status</th>
                        <th class="text-center" style="width:20%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($triages->reverse() as $triage)
                    <tr>
                        <td>
                            {{ $triage->patient->med_id }} 
                        </td>
                        <td>
                            {{ $triage->patient->first_name }} {{ $triage->patient->middle_name }} {{ $triage->patient->last_name }}
                        </td>
                        <td>
                            {{ $triage->service->service_name }}
                        </td>
                        <td>
                            @if($triage->status==0)
                            Not Attended
                            @else
                            <i class="fa fa-check text-success"></i> Attended
                            @endif
                        </td>
                        <td class="text-center">
                            @if($triage->status==1 && $triage->service_id==4)
                                {!! Form::open(['method'=>'POST', 'action'=>['Medical\SecondaryVitalsController@exportCertificate']])!!}
                                    <input type="hidden" name="patient_id" value="{{$triage->on_patient}}" />
                                    <input type="hidden" name="appointment_id" value="{{$triage->appointment_id }}" />
                                    <button class="btn btn-info btn-xs"><i class="fa fa-certificate"></i> Medical Certificate</button>
                                {!!Form::close()!!}
                            @elseif($triage->status==0)
                                <button class="btn btn-info btn-xs col-md-12" data-toggle="modal" data-target=".vitals-{{$triage->id}}"><i class="fa fa-plus"></i> Add Vitals</button>
                            @else
                                Vitals Added
                            @endif  
                        </td>
                    </tr>
                    <!--  Health Vitals -->
                    <div class="modal fade vitals-{{$triage->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Add Health Vitals <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::open(['method'=>'POST', 'action'=>['Triage\TriageController@addVitals']])!!}
                                            <input type="hidden" name="triage_id" value="{{ $triage->id }}">
                                            <div class="form-group m-b col-md-6">
                                                <label>Enter Weight in kgs</label>
                                                <input name="weight" class="form-control" type="text" value="{{ old('weight') }}" autocomplete="off" title="Enter weight in Kg without units. e.g. 56" required/>
                                            </div>
                                            <div class="form-group m-b col-md-6">
                                                <label>Enter Height in cm</label>
                                                <input name="height" class="form-control" type="text" value="{{ old('height') }}" autocomplete="off" title="Enter Height in cm without units. e.g. 123" required/>
                                            </div>
                                            <div class="form-group m-b col-md-6">
                                                <label>Enter BMI</label>
                                                <input name="bmi" class="form-control" type="text" value="{{ old('bmi') }}" autocomplete="off" title="Enter BMI e.g. 23" required/>
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
                                                <label>Random Blood Sugar <strong>(Numeric only)</strong></label>
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
                                            @if($triage->service->id=="4")
                                            <div class="form-group m-b col-md-12">
                                                <label>Conclusion</label>
                                                <textarea name="conclusion" class="form-control" type="text"  value="{{ old('conclusion') }}" autocomplete="off" title="Conclusion" required></textarea>
                                            </div>
                                            <div class="form-group m-b col-md-12">
                                                <label>Name and Designate</label>
                                                <input name="name_designate" class="form-control" type="text"  value="{{ old('name_designate') }}" autocomplete="off" required/>
                                            </div>
                                            @endif
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer bg-light lt text-center">
        <ul class="pagination">
            {{ $triages->links() }}
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
                                    Triages Reports</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Daily Triages Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportDailyTriages']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="date" placeholder="Choose a Date" value="{{ old('date') }}"  data-date-format="dd MM yyyy" onkeydown="return false" autocomplete="off" required>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">Monthly Triages Reports</label><br><br>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportMonthlyTriages']])!!}
                                            <div class="input-group m-b col-md-12">
                                                <input type="text" id="datepicker" class="form-control datepicker-here from_date" data-language='en' name="month" placeholder="Choose a Month" value="{{ old('month') }}"  data-date-format="MM yyyy" onkeydown="return false" data-min-view="months" data-view="months" autocomplete="off" required/>
                                            </div>
                                            <button class="btn btn-md btn-info col-md-4 text-center pull-right">Export Report <i class="fa fa-external-link-square"></i></button>
                                            {!!Form::close()!!}
                                        </div>
                                        <div class="col-md-12 wrapper-lg">
                                            <label class="text-bold">All Triages Reports</label>
                                            {!!Form::open(['method'=>'POST','action'=>['Reports\ReportsController@exportAllTriages']])!!}
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