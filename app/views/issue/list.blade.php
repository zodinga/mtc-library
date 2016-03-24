@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Issue List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				
				{{ Form::hidden('page', $transactions->getCurrentPage()) }}
				
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $transactions->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('status', array(''=>'All Status', 'active'=>'Active', 'returned'=>'Returned', 'overdue'=>'Overdue', 'deleted'=>'Deleted'), Input::get('status', $search_criteria['status']), array('class'=>'form-control', 'id'=>'status')) }}
		      	</div>
				<div class="col-lg-5">
					<div class="input-group">
						{{ Form::text('search', Input::get('search', null), array('placeholder'=>'ID Card No', 'class'=>'form-control')) }}
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
							<th>ID Card No</th>
							<th>Name</th>
							<th>Book</th>
							<th>Issue Date</th>
							<th>Due Date</th>
							<th>Returned Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($transactions as $key=>$transaction)
						<tr>
							<td>{{$key+$index}}</td>
							<td>{{$transaction->card_no}}</td>
							<td>{{$transaction->name}}</td>
							<td><?php $booktitle = Booktitle::find($transaction->title); ?>{{$booktitle->title_name}}</td>
							<td>{{date('d M Y', strtotime($transaction->issued_at))}}</td>
							<td>{{date('d M Y', strtotime($transaction->due_at))}}</td>
							<td>
								@if($transaction->returned_at)
								{{date('d M Y', strtotime($transaction->returned_at))}}
								@endif
							</td>
							
							<td class="action">
								@if($transaction->deleted_at == null && $transaction->returned_at != null)
								<a href="{{url('issue/cancel-return/' . $transaction->id)}}" class="tooltip-top btn btn-warning btn-xs restore-button" title="Cancel Return Issue"><i class="fa fa-undo"></i> Cancel</a>
								@endif

								@if($transaction->deleted_at == null && $transaction->returned_at == null)
								<a href="{{url('issue/return/' . $transaction->id)}}" class="tooltip-top btn btn-success btn-xs restore-button" title="Return Issue"><i class="fa fa-mail-reply"></i> Return</a>
								@endif

								@if($transaction->deleted_at != null)
								<a href="{{url('issue/restore/' . $transaction->id)}}" class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore Deleted Issue"><i class="fa fa-undo"></i> Restore</a>
								@endif
								
								@if($transaction->deleted_at == null)
								<a href="{{url('issue/delete/' . $transaction->id)}}" class="tooltip-top btn btn-danger btn-xs" title="Delete Issue"><i class="fa fa-times"></i> Delete</a>
								@endif

								@if($transaction->deleted_at != null)
								<a href="{{url('issue/force/' . $transaction->id)}}" class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete Issue Permanently"><i class="fa fa-times"></i> Force Delete</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="align-center">
					{{$transactions->appends($search_criteria)->links()}}
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