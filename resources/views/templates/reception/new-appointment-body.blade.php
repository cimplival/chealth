@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="panel panel-default col-md-12">
  <div class="panel-heading text-center">Create a new appointment</div>
  <div class="panel-body">
    <div class="row">
      <p class="text-center m-b">Do you want to create an appointment for: <br> <span class="font-bold"> ({{$patient->med_id}}) {{$patient->first_name}} {{$patient->middle_name}} {{$patient->last_name}}?</span></p>
      <div class="col-md-12">
       <button class="btn btn-sm btn-info " data-toggle="modal" data-target=".schedule-appointment">Schedule Appointment</button>
       <button class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target=".new-appointment">Create Appointment</button>
     </div>
   </div>
 </div>
</div>
<div class="modal fade new-appointment" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info dk">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="blue bigger text-center">
          Choose a Service</h4>
        </div>
        {!!Form::open(['method'=>'POST', 'url'=>'create-appointment', 'action'=>['Reception\AppointmentsController@CreateAppointment']])!!}
        <div class="modal-body">
          <div class="row text-center">
            <div class="col-md-10 col-md-offset-1">
              <input type="hidden" name="on_patient" value="{{$patient->id}}"/>
              <select id="services_all" name="service_id" class="form-control m-b" required>
                <option value="">Select a service...</option>
                @foreach($services as $service)
                <option value="{{$service->id}}">{{$service->provider->name}} - {{$service->service_name}} ({{$settings->currency}} {{$service->cost}})</option>
                @endforeach
              </select>
              <input name="med_id" type="hidden" value="{{ $patient->med_id }}"></input>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light bg">
          <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
          {!! Form::submit('Create Appointment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
          {!!Form::close()!!}
        </div>
      </div>
    </div><!-- /. modal dialog -->
  </div>

  <div class="modal fade schedule-appointment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
                  <option value="{{$service->id}}">{{$service->service_name}} (Ksh. {{$service->cost}})</option>
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