@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Create ID Card</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New ID Card</h3>

						<div class="panel-utility pull-right code-preview">
							<!-- Nav tabs -->
							<ul class="nav nav-pills">
								<li{{ $card_type == "student"?' class="active"':'' }}><a href="#student">Student</a></li>
								<li{{ $card_type == "staff"?' class="active"':'' }}><a href="#staff">Staff</a></li>
							</ul>
						</div>
					</div>

					<div class="panel-body">
						<div class="student" {{ $card_type != "student"?'style="display: none;"':'' }}>
							@include('idcard.create.student-idcard')
						</div>
						<div class="staff" {{ $card_type != "staff"?'style="display: none;"':'' }}>
							@include('idcard.create.staff-idcard')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop