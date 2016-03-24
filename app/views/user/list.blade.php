@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>User List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				
				{{ Form::hidden('page', $users->getCurrentPage()) }}
				
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $users->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-3">
					{{ Form::select('role', array(''=>'All Role', 'administrator'=>'Administrator', 'principal'=>'Principal'), Input::get('role', null), array('class'=>'form-control', 'id'=>'role')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('status', array(''=>'All Status', 'active'=>'Active', 'deleted'=>'Deleted'), Input::get('status', null), array('class'=>'form-control', 'id'=>'status')) }}
		      	</div>
				<div class="col-lg-4">
					<div class="input-group">
						{{ Form::text('search', Input::get('search', null), array('placeholder'=>'Search user by name', 'class'=>'form-control')) }}
						<span class="input-group-btn">
							<button class="btn btn-success" type="submit">Search</button>
						</span>
					</div>
				</div>
				<div class="col-lg-2 text-right"><a class="btn btn-primary" href="{{url('user/create')}}">New</a></div>
			{{ Form::close() }}
			<hr>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Full Name</th>
							<th>Role</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key=>$user)
						<tr>
							<td>{{$key+$index}}</td>
							<td>
								@if($user->avatar == 'avatar/default-white.png')
								<span style="border-radius:30%;background:#000;padding:2px;"><img src="{{asset($user->avatar)}}" width="15px" height="auto"></span>
								@elseif($user->avatar != 'avatar/default-white.jpg')
								<img src="{{asset($user->avatar)}}" width="19px" height="auto">
								@endif
								{{$user->username}}
							</td>
							<td>{{$user->fullname}}</td>
							<td>{{ucwords($user->role)}}</td>
							<td>
							@if( $user->deleted_at != null )
								<span class="label label-danger">deleted</span>
							@else
								<span class="label label-success">active</span>
							@endif
							</td>
							<td class="action">
								{{Form::open(array('url'=>url('user', array($user->id)), 'method'=>'delete'))}}
								
								<a class="btn btn-success btn-xs tooltip-top" title="Edit user" href="{{url('user', array($user->id,'edit')) }}"><i class="fa fa-pencil"></i> Edit</a>

								@if($user->deleted_at != null)
								<button class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore User" type="submit" name="restore" value="{{$user->id}}"><i class="fa fa-undo"></i> Restore</button>
								<button class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete User Permanently" type="submit" name="force" value="{{$user->id}}"><i class="fa fa-times"></i> Force Delete</button>
								@endif
								
								@if($user->deleted_at == null)
								<button class="tooltip-top btn btn-danger btn-xs" title="Delete User" type="submit" name="delete" value="{{$user->id}}"><i class="fa fa-times"></i> Delete</button>
								@endif

								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="align-center">
					{{$users->appends($search_criteria)->links()}}
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