@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Profile Viewing</h1>
</div>

<div id="content">
	<div class="container">
		@include('layout.partial.alert')
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default browse-books">
					<div class="panel-heading">
						<h3 class="panel-title">Enter Card ID for viewing profile</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8">
								{{ Form::open(array('url'=>url('searchId'), 'method'=>'post', 'class'=>'form-horizontal user-form')) }}
									<div class="form-group {{($errors->has('cardId'))?'has-error':''}}">
										{{ Form::label('cardId', 'Card ID', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('cardId', Input::get('cardId'), array('placeholder'=>'Enter Your Card ID', 'id'=>'cardId', 'class'=>'form-control','autocomplete'=>'off')) }}

											@if($errors->has('cardId'))
											<p class="help-block text-danger">{{$errors->first('cardId')}}</p>
											@endif
										</div>
									</div>

									
									<div class="form-group">
									    <div class="col-sm-offset-5 col-sm-7">
											<button type="submit" class="btn btn-success" name="save">Check</button>
											<button type="button" onclick="location.href='http://mtc-library.com'" class="btn btn-danger" name="exit">Exit</button>
										</div>
									</div>
								{{ Form::close() }}
							</div>

						</div>
					</div>
				</div>
			</div>
			@if($display)
			<div class="col-sm-6">
				<div class="panel panel-default browse-books">
					<div class="panel-heading">
						<h3 class="panel-title">Your Profile</h3>
					</div>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{{$info}}
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<strong>Member Profile</strong>
								<hr>
								@if($idcard)
								<table class="table table-striped table-bordered table-condensed">
									<tbody>
										<tr>
											<td>Card ID</td>
											<td>{{$idcard->card_no}}</td>
										</tr>
										<tr>
											<td>Name</td>
											<td>{{$idcard->name}}</td>
										</tr>
										<tr>
											<td>Father's Name</td>
											<td>{{$idcard->father_name}}</td>
										</tr>
										<tr>
											<td>Identification Mark</td>
											<td>{{$idcard->id_mark}}</td>
										</tr>
										<tr>
											<td>Contact</td>
											<td>{{$idcard->contact}}</td>
										</tr>
										<tr>
											<td>Blood Group</td>
											<td>{{$idcard->blood_group}}</td>
										</tr>
										<tr>
											<td>Member Type</td>
											<td>{{$idcard->type}}</td>
										</tr>
										<tr>
											<td>Academic Session</td>
											<td>{{$idcard->session}}</td>
										</tr>
										<tr>
											<td>Address</td>
											<td>{{$idcard->present_address}}</td>
										</tr>
										<tr>
											<td>Valid Upto</td>
											<td>{{$idcard->valid_upto}}</td>
										</tr>
										<tr>
											<td>DOB</td>
											<td>{{$idcard->date_of_birth}}</td>
										</tr>
									</tbody>
								</table>
								<strong>Book Borrowed Record</strong>
								<hr>
								<table class="table table-striped table-bordered table-condensed">
									<tbody>
										<tr>
											<td><strong>Book Barcode</strong></td>
											<td><strong>Book Name</strong></td>
											<td><strong>Status</strong></td>
											<td><strong>Issue Date</strong></td>
										</tr>
										@foreach($transactions as $transaction)
										<tr>
											<td>
												<?php
												$book = Book::find($transaction->book_id);
												$booktitle = Booktitle::find($book->id);
												echo $book->barcode;
												?>
											</td>
											<td>{{$booktitle->title_name}}</td>
											<td>{{$transaction->returned_at?'Returned':'Not return'}}</td>
											<td>{{$transaction->issued_at}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								@endif
								<strong>Booking Record</strong>
								<hr>
								<table class="table table-striped table-bordered table-condensed">
									<tbody>
										<tr>
											<td><strong>Book Barcode</strong></td>
											<td><strong>Book Name</strong></td>
											<td><strong>Issue Date</strong></td>
										</tr>
										@if($bookings)
										@foreach($bookings as $booking)
										<tr>
											<td>
												<?php
												$book = Book::where('barcode','=',$booking->barcode)->first();
												$booktitle = Booktitle::find($book->id);
												echo $booking->barcode;

												?>
											</td>
											<td>{{$booktitle->title_name}}</td>
											<td>{{$booking->created_at}}</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){});
</script>
@stop