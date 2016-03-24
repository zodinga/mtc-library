<hr>
<h5 class="text-center">CURRENT ISSUE</h5>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th width="50%">Title</th>
			<th>Copies</th>
			<th>Issue Date</th>
			<th>Due Date</th>
		</tr>
	</thead>
	<tbody>
		@if($pending_issues->count() == 0)
		<tr>
			<td colspan="5" class="text-center"><i>No pending issue for this member</i></td>
		</tr>

		@else
		
		@foreach($pending_issues as $key => $item)
		<?php
			$due_date = new DateTime($item->due_at);
			$today = new DateTime();
			$diff = $today->diff($due_date);
			$days_left = $diff->format('%R%a');
			$book = Book::find($item->book_id);
			if($book)
				$book_title = $book->title;
			else
				$book_title = "<span class='text-danger'>Deleted</span>";
		?>
		<tr class="{{($days_left < 0)?'danger':''}}">
			<td>{{$key+1}}</td>
			<td>{{$book_title}}</td>
			<td>{{$item->copies}}</td>
			<td>{{date('d M Y',strtotime($item->issued_at))}}</td>
			<td>{{date('d M Y',strtotime($item->due_at))}}</td>
		</tr>
		@endforeach

		@endif
	</tbody>
	<tfoot>
		@if($pending_issues->count())
		<tr>
			<td colspan="5" class="text-danger text-center">Note: Item highlighted in red indicates books not returned on or before due date.</td>
		</tr>
		@endif
	</tfoot>
</table>	