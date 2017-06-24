@if (count($errors) > 0)
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Whoops! Sorry!</strong> There were some problems with your input.<br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<div class="panel panel-default col-md-8 col-md-offset-1">
<div class="panel-heading text-center">Export Medical Certificate</div>
  <div class="panel-body">
    <div class="row">
    <p class="text-center m-b">Export the medical certificate below.</p>
            <div class="col-md-6 pull-right">
            {!! Form::open(['method'=>'GET', 'action'=>['Medical\SecondaryVitalsController@exportCertificate']])!!}
            <input type="hidden" name="id" value="{{$patients_id}}"/>
                      <button type="submit" class="btn btn-sm btn-info pull-right"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export as PDF</button>
            {!!Form::close()!!}
          </div>
      </div>
  </div>
</div>