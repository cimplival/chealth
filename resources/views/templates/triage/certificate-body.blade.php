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
<div class="row">
    <div class="col-sm-12 b-r">
        {!! Form::open(array('route' => 'search-certificate')) !!}
    	    <div class="form-group">
        	    <div class="input-group m-b">
                    <input type="text" class="form-control search-input" name="search" autocomplete="off" placeholder="Search for Patient..." required>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>