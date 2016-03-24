@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Publisher List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				
				{{ Form::hidden('page', $publishers->getCurrentPage()) }}
				
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $publishers->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('status', array(''=>'All Status', 'active'=>'Active', 'deleted'=>'Deleted'), Input::get('status', $search_criteria['status']), array('class'=>'form-control', 'id'=>'status')) }}
		      	</div>
				<div class="col-lg-4">
					<div class="input-group">
						{{ Form::text('search', Input::get('search', null), array('placeholder'=>'Search by publisher name', 'class'=>'form-control')) }}
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
							<th>Name</th>
							<th>Updated</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($publishers as $key=>$publisher)
						<tr>
							<td>{{$key+$index}}</td>
							<td>{{$publisher->publisher_name}}</td>
							<td>{{date('d M Y, h:i A', strtotime($publisher->updated_at))}}</td>
							<td>
							@if( $publisher->deleted_at != null )
								<span class="label label-danger">deleted</span>
							@else
								<span class="label label-success">active</span>
							@endif
							</td>
							<td class="action">
								{{Form::open(array('url'=>url('publisher', array($publisher->id)), 'method'=>'delete'))}}
								
								@if($publisher->deleted_at == null)
								<a title="Edit Publisher" class="tooltip-top btn btn-primary btn-xs" href="{{url('publisher', array($publisher->id, 'edit'))}}"><i class="fa fa-pencil"></i> Edit</a>
								@endif

								@if($publisher->deleted_at != null)
								<button class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore Publisher" type="submit" name="restore" value="{{$publisher->id}}"><i class="fa fa-undo"></i> Restore</button>
								@endif
								
								@if($publisher->deleted_at == null)
								<button class="tooltip-top btn btn-danger btn-xs" title="Delete Publisher" type="submit" name="delete" value="{{$publisher->id}}"><i class="fa fa-times"></i> Delete</button>
								@endif

								<button class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete Publisher Permanently" type="submit" name="force" value="{{$publisher->id}}"><i class="fa fa-times"></i> Force Delete</button>
								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="align-center">
					{{$publishers->appends($search_criteria)->links()}}
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