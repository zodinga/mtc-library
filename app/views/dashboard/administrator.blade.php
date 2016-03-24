@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Dashboard</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="stat-block stat-success" onclick="document.location='{{url('issue?page=1&amp;limit=30&amp;status=active&amp;search=')}}'">
							<div class="icon">
								<i class="fa fa-cog"></i>
							</div>
							<div class="details">
								<div class="number">{{Transaction::whereRaw('returned_at is null')->count()}}</div>
								<div class="description">Current Issue</div>
							</div>               
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="stat-block stat-info" onclick="document.location='{{url('issue')}}'">
							<div class="icon">
								<i class="fa fa-cogs"></i>
							</div>
							<div class="details">
								<div class="number">{{Transaction::count()}}</div>
								<div class="description">Total Issues</div>
							</div>               
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="stat-block stat-primary" onclick="document.location='{{url('book')}}'">
							<div class="icon">
								<i class="fa fa-book"></i>
							</div>
							<div class="details">
								<div class="number">
									{{Book::count()}}
								</div>
								<div class="description">                           
									Total Books
								</div>
							</div>               
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="stat-block stat-danger" onclick="document.location='{{url('booking')}}'">
							<div class="icon">
								<i class="fa fa-group"></i>
							</div>
							<div class="details">
								<div class="number">{{Booking::count()}}</div>
								<div class="description">Booking</div>
							</div>               
						</div>
					</div>
				</div><!-- /.row -->

			</div>
		</div>
		@if($bookingDelete)
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{$bookingDelete}} Expired Booking List Delete from Database...
		</div>
		@endif
			
	</div>
</div>
@stop