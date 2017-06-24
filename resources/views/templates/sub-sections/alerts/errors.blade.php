@if (count($errors) > 0)
<div class="alert alert-danger">
<i class="fa fa-warning" aria-hidden="true"></i>
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Whoops! Sorry!</strong> There were some problems with your input.<br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif