<div class="bg-white b-b wrapper-md lt">
	<div class="row">
		<div class="col-sm-6 col-xs-12">
		<h1 class="m-n font-thin h3">
				<?php if(Auth::user()->hasRole('administrator')): ?>
				Audit: 
					<small>
						Recent Activities
					</small>
				<?php else: ?>
					Recent Activities
				<?php endif; ?>
		</h1>
			<small class="text-muted"></small>
		</div>
	</div>
</div>
