<?php $success = Session::get('success'); ?>
<?php $info = Session::get('info'); ?>
<?php $warning = Session::get('warning'); ?>
<?php $danger = Session::get('danger'); ?>
<?php $bookId = Session::get('bookId'); ?>

@if(!empty($success))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$success}}
	</div>
@endif
@if(!empty($info))
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$info}}
	</div>
@endif
@if(!empty($warning))
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$warning}}
	</div>
@endif
@if(!empty($danger))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$danger}}
	</div>
@endif
