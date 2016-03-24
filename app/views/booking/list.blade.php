@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Booking List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Card ID</th>
							<th>Member Name</th>
							<th>Book Title</th>
							<th>Call No</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bookings as $booking)
						<?php 
							$book = Book::where('barcode','=',$booking->barcode)->first();
							$booktitle = Booktitle::where('id','=',$book->title)->first();
							$count = Transaction::where('book_id','=',$book->id)->where('returned_at','=',NULL)->sum('copies'); 
							$member = Member::join('Idcards','Idcards.card_no','=','Members.card_no')->where('Members.card_no','=',$booking->card_no)->first(); 
						?>
						<tr>
							<td>{{$booking->id}}</td>
							<td>{{$booking->card_no}}</td>
							<td>{{$member->name}}</td>
							<td>{{$booktitle->title_name}}</td>
							<td>{{$book->classification_no}}:{{$book->book_no}}</td>
							<td>{{!$count? "Available":"Not Available"}}</td>
							<td>
								@if($book->volume > $count)
								<button type="button" class="btn btn-primary" onclick="location.href='issue/new'">Issue Book</button>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>

@stop