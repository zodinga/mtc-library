@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Book List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				
				{{ Form::hidden('page', $books->getCurrentPage()) }}
				
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $books->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('status', array(''=>'All Status', 'active'=>'Active', 'deleted'=>'Deleted'), Input::get('status', $search_criteria['status']), array('class'=>'form-control', 'id'=>'status')) }}
		      	</div>
		      	
				<div class="col-lg-2">
					{{ Form::select('category_id', $categories, Input::get('category_id', 0), array('class'=>'form-control', 'id'=>'category_id')) }}
		      	</div>
				<div class="col-lg-5">
					<div class="input-group">
						{{ Form::text('search', Input::get('search', null), array('placeholder'=>'Barcode or Title or Author or Publisher', 'class'=>'form-control')) }}
						<span class="input-group-btn">
							<button class="btn btn-success" type="submit">Search</button>
						</span>
					</div>
				</div>
			{{ Form::close() }}
			<hr>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Accession</th>
							<th>Title</th>
							<th>Edition</th>
							<th>Place & Publisher</th>
							<th>Year</th>
							<th>Pages</th>
							<th>Volume</th>
							<th>Class No</th>
							<th>Book No</th>
							<th>Remarks</th>
							<th>Status</th>
							<th width="240px"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($books as $key=>$book)
						<?php $booktitle = Booktitle::find($book->title); ?>
						<tr>
							<td>{{$key+$index}}</td>
							<td>{{$book->accession_no}}</td>
							<td>{{$booktitle->title_name}}</td>
							<td>{{$book->edition ? $book->edition : '-'}}</td>
							<td>{{$book->publisher->publisher_name}}</td>
							<td>{{$book->published_year ? $book->published_year : '-'}}</td>
							<td>{{$book->pages}}</td>
							<td>{{$book->volume ? $book->volume : '-'}}</td>
							<td>{{$book->classification_no}}</td>
							<td>{{$book->book_no}}</td>
							<td>{{$book->remarks}}</td>
							<td>
							@if( $book->deleted_at != null )
								<span class="label label-danger">deleted</span>
							@else
								<span class="label label-success">active</span>
							@endif
							</td>

							<td class="action">
								{{Form::open(array('url'=>url('book', array($book->id)), 'method'=>'delete'))}}
								
								@if($book->deleted_at == null)
								<a title="Edit Book" class="tooltip-top btn btn-primary btn-xs" href="{{url('book', array($book->id, 'edit'))}}"><i class="fa fa-pencil"></i> Edit</a>
								@endif

								@if($book->deleted_at != null)
								<button class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore Book" type="submit" name="restore" value="{{$book->id}}"><i class="fa fa-undo"></i> Restore</button>
								@endif
								
								@if($book->deleted_at == null)
								<button class="tooltip-top btn btn-danger btn-xs" title="Delete Book" type="submit" name="delete" value="{{$book->id}}"><i class="fa fa-times"></i> Delete</button>
								@endif

								<button class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete Book Permanently" type="submit" name="force" value="{{$book->id}}"><i class="fa fa-times"></i> Force Delete</button>
								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="align-center">
					{{$books->appends($search_criteria)->links()}}
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$(".list-toolbar select").on("change", function(){
		$(this).closest('form').submit();
	});
});
</script>
@stop