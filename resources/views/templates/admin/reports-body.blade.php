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
    <span class="font-bold">Automated Reports</span><span class="text-muted"> <small>(Sent Midnight Everyday)</small></span>
    <button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target=".add-email"><li class="fa fa-plus"></li> Add Email</button>
  </div>
  <div class="panel-body">
    @foreach($reports as $report)
    {!! Form::open(['method'=>'PUT','action'=>['Admin\ReportsController@updateReports', $report->id ]])!!}
    {{ Form::hidden('approved', false) }}
    <div class="form-group">
      <div class="checkbox col-sm-offset-1">
        <label class="i-checks">
          <input name="status" type="checkbox" value="{{$report->status}}" @if($report->status) checked @endif>
          <i></i>
          {{ $report->description  }}
        </label>
        <button type="submit" class="btn btn-xs btn-info pull-right">Update Report</button>
      </div>
      <div class="padder-lg col-sm-offset-1">
        @foreach($report->users as $user)
        <label class="label label-info bg-light"> {{$user->email}} <a data-toggle="modal" data-target=".remove-email-{{$user->id}}{{$report->id}}"><i class="fa fa-times"></i></a></label>
      <div class="modal fade remove-email-{{$user->id}}{{$report->id}}" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info dk">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="blue bigger text-center">
                Remove Email</h4>
              </div>
              <div class="modal-body">
                <div class="row text-center">
                  <div class="col-xs-12 col-sm-12">
                    <p>Are you sure you want to <b>remove</b> {{$user->full_name}}: {{$user->email}} from the automated report?</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer bg-light bg">
                {!!Form::open()!!}
                {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                {!!Form::close()!!}
                {!!Form::open(['method'=>'POST','action'=>['Admin\ReportsController@removeEmail']])!!}
                <input type="hidden" name="report_id" value="{{$report->id}}"/>
                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                {!! Form::submit('Remove Email', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                {!!Form::close()!!}
              </div>
            </div>
          </div><!-- /. modal dialog --><br>
        </div>
        <!-- remove email-->


        @endforeach
        </div>
      </div>
      {!! Form::close() !!}
      <div class="line line-dashed b-b line-lg"></div>
      @endforeach
    </div>
  </div>

  <!-- Add email-->
  <div class="modal fade add-email" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info dk">
          <h4 class="font-thin text-center">Add an Email<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              {!! Form::open(['method'=>'POST', 'action'=>['Admin\ReportsController@addEmail']])!!}
              <div class="form-group col-md-12">
                <div class="input-group m-b col-md-12">
                  <select name="user_id" class="form-control text-capitalize m-b" value="{{Request::old('user_id')}}" required>
                    <option value="">Select a User...</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->full_name}} ({{$user->staff_id}}) - {{$user->email}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group m-b col-md-12">
                  <select name="report_id" class="form-control text-capitalize m-b" value="{{Request::old('report_id')}}" required>
                    <option value="">Select User Role...</option>
                    @foreach($reports as $report)
                    <option value="{{$report->id}}">{{$report->description}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light lt">
          <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
          {!! Form::submit('Add Email', ['class' => 'btn btn-success btn-sm pull-right']) !!}
          {!!Form::close()!!}
        </div>
      </div>
    </div><!-- /. modal dialog -->
  </div><!-- /. modal-->
