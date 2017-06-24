<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
<i class="fa fa-warning" aria-hidden="true"></i>
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Whoops! Sorry!</strong> There were some problems with your input.<br>
	<ul>
		<?php foreach($errors->all() as $error): ?>
		<li><?php echo e($error); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>