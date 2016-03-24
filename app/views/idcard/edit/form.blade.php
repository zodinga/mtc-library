@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Edit ID Card</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{$idcard->name}}</h3>
						<h3 class="panel-title pull-right">Card No: <b>{{$idcard->card_no}}</b></h3>
					</div>
					<div class="panel-body">
						@if($idcard->type == 'regular student' || $idcard->type == 'short course')
							@include('idcard.edit.student-idcard')
						@elseif($idcard->type == 'staff')
							@include('idcard.edit.staff-idcard')
						@endif
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@stop