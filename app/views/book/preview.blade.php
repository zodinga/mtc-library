<div class="row">
	<?php 
		$book = Book::find($book->id);
		$booked = Booking::where('barcode','=',$book->barcode)->get();
	?>
	@if(!empty($booked))
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Already Booked by : </strong>
			@foreach($booked as $booking)
				<?php $member = Idcard::where('card_no','=',$booking->card_no)->first()?>
				 {{$member->name}} ,
			@endforeach 
		</div>
	@endif
	<div class="col-sm-6">
		<table width="100%">
			<input type="hidden" id="book_id" name="book_id" value="{{$book->id}}" />
			<tr>
				<td align="right" width="20%"><i>Title</i></td>
				<td align="center" width="10px">:</td>
				<td><b id="book_title"><?php $booktitle = Booktitle::find($book->title);?>{{$booktitle->title_name}}</b></td>
			</tr>
			<tr>
				<td align="right" width="20%"><i>Author</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->author->author_name}}</td>
			</tr>
			<tr>
				<td align="right" width="20%"><i>Category</i></td>
				<td align="center" width="10px">:</td>
				<td>{{($book->category_id != 0)?$book->category->category_name:'N/A'}}</td>
			</tr>
			<tr>
				<td align="right" width="20%"><i>Edition</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->edition}}</td>
			</tr>
			<tr>
				<td align="right" width="20%"><i>Publisher</i></td>
				<td align="center" width="10px">:</td>
				<td>{{($book->publisher_id != 0)?$book->publisher->publisher_name:'N/A'}}</td>
			</tr>
			<tr>
				<td align="right" width="20%"><i>Volume</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->volume}}</td>
			</tr>
		</table>
	</div>
	<div class="col-sm-6">
		<table>
			<tr>
				<td align="right"><i>Accession No</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->accession_no}}</td>
			</tr>
			<tr>
				<td align="right"><i>Classification No</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->classification_no}}</td>
			</tr>
			<tr>
				<td align="right"><i>Shelf No</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->shelf_no}}</td>
			</tr>
			<tr>
				<td align="right"><i>Row No</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->row_no}}</td>
			</tr>
			<tr>
				<td align="right"><i>ISBN No</i></td>
				<td align="center" width="10px">:</td>
				<td>{{$book->isbn_no}}</td>
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 text-center">
		<h4>Copies Available in Library: <span id="available" class="badge badge-success">
			<?php
			$issued = Transaction::whereRaw('returned_at is null')
				->whereBookId($book->id)
				->count();
			?>
			{{$book->copies - $issued}} Copies
		</span></h4>
	</div>
</div>