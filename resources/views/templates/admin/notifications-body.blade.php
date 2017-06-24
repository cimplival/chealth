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
    <div class="panel-heading font-bold">
      Notifications
    </div>
    <div class="panel-body">
        @foreach($notifications as $notification)
        {!! Form::open(['method'=>'PUT','action'=>['Admin\NotificationsController@updateNotifications', $notification->id ]])!!}
        {{ Form::hidden('approved', false) }}
        <div class="form-group">
          <div class="checkbox col-sm-offset-1">
              <label class="i-checks">
                <input name="status" type="checkbox" value="{{$notification->status}}" @if($notification->status) checked @endif>
                <i></i>
                {{ $notification->notification_name }}
              </label>
              <button type="submit" class="btn btn-xs btn-info pull-right">Update Notification</button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="line line-dashed b-b line-lg"></div>
        @endforeach
    </div>
  </div>