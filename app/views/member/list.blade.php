@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Member List</h1>
</div>

<div id="content">
	<div class="container">
		
		@include('layout.partial.alert')

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				
				{{ Form::hidden('page', $members->getCurrentPage()) }}
				
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $members->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-3">
					{{ Form::select('type', $types, Input::get('type', null), array('class'=>'form-control', 'id'=>'type')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('status', array(''=>'All Status', 'valid'=>'Valid', 'expired'=>'Expired', 'deleted'=>'Deleted'), Input::get('status', null), array('class'=>'form-control', 'id'=>'status')) }}
		      	</div>
				<div class="col-lg-4">
					<div class="input-group">
						{{ Form::text('search', Input::get('search', null), array('placeholder'=>'Search by name or card number', 'class'=>'form-control')) }}
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
							<th>Card No</th>
							<th>Name</th>
							<th>Type</th>
							<th>Registration Date</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($members as $key=>$member)
						<tr>
							<td>{{$key+$index}}</td>
							<td><a data-toggle="modal" data-target="#member{{$member->id}}_modal" href="javascript:;">{{$member->card_no}}</a>
								<div class="modal fade list-member-idcard" id="member{{$member->id}}_modal" tabindex="-1" role="dialog" aria-labelledby="member{{$member->id}}_label" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="member{{$member->id}}_label">{{$member->card_no}}</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-sm-12">
														@if($member->type == 'pre service' || $member->type == 'in service')
														@include('idcard.detail.student-idcard', array('data'=>$member))

														@elseif($member->type == 'faculty')
														@include('idcard.detail.faculty-idcard', array('data'=>$member))

														@elseif($member->type == 'staff')
														@include('idcard.detail.staff-idcard', array('data'=>$member))

														@elseif($member->type == 'temporary')
														@include('idcard.detail.temporary-idcard', array('data'=>$member))
														@endif
													</div>
												</div>
												<script type="text/javascript">
												$(function(){
													$("#idcard_{{$member->id}} .idcard-barcode").barcode('{{$member->card_no}}', 'code128', {barHeight:18, fontSize:11});
												});
												</script>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</td>
							<td>{{$member->name}}</td>
							<td>{{ucwords($member->type)}}</td>
							<td>{{date('d F Y', strtotime($member->created_at))}}</td>
							<td>
							@if( $member->deleted_at != null )
								<span class="label label-danger">deleted</span>
							@elseif($member->type == 'faculty' || $member->type == 'staff' || strtotime($member->valid_upto) >= strtotime(date('Y-m-d')) )
								<span class="label label-success">valid</span>
							@elseif( strtotime($member->valid_upto) < strtotime(date('Y-m-d')) )
								<span class="label label-warning">expired</span>
							@endif
							</td>
							<td class="action">
								{{Form::open(array('url'=>url('member', array($member->id)), 'method'=>'delete'))}}
								
								@if($member->deleted_at != null)
								<button class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore Member" type="submit" name="restore" value="{{$member->id}}"><i class="fa fa-undo"></i> Restore</button>
								@endif
								
								@if($member->deleted_at == null)
								<button class="tooltip-top btn btn-danger btn-xs" title="Delete Member" type="submit" name="delete" value="{{$member->id}}"><i class="fa fa-times"></i> Delete</button>
								@endif

								<button class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete Member Permanently" type="submit" name="force" value="{{$member->id}}"><i class="fa fa-times"></i> Force Delete</button>
								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="align-center">
					{{$members->appends($search_criteria)->links()}}
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