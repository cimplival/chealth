@if (Session::has('info'))
@include('templates.sub-sections.alerts.info')
@endif
@if (Session::has('success'))
@include('templates.sub-sections.alerts.success')
@endif
@if (count($errors) > 0)
@include('templates.sub-sections.alerts.errors')
@endif
<div class="row">
    <div class="col-sm-12 b-r">
        {!! Form::open(array('route' => 'search-patient')) !!}
    	    <div class="form-group">
        	    <div class="input-group m-b">
                    <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search patient..." required>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>