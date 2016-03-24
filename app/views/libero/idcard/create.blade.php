@extends('layout.main')
@section('content')
<div class="content-head">
	<ul class="breadcrumb">
		<li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
		<li class="active">New ID Card</li>
	</ul>
	<h2>New ID Card</h2>
	<div class="muted">
		Create new ID Card for students, faculty and temporary teachers.
	</div>
</div>
<div class="content-body">
	<section class="module">
		<div class="module-head">
			<ul class="module-control pull-left">
				<li class="active"><a href="#tab-1" data-toggle="tab">Student</a></li>
				<li><a href="#tab-2" data-toggle="tab">Faculty</a></li>
				<li><a href="#tab-3" data-toggle="tab">Temporary</a></li>
			</ul>
		</div><!--/.module-head-->

		<div class="module-body">
			<div class="tab">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab-1">
						@include('idcard.student-idcard')
					</div>

					<div class="tab-pane fade" id="tab-2">
						@include('idcard.faculty-idcard')
					</div>

					<div class="tab-pane fade" id="tab-3">
						@include('idcard.temporary-idcard')
					</div>
				</div>
			</div>
		</div><!--/.module-body-->
	</section>
</div>
@stop