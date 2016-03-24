@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>ID Card List</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row">
			{{ Form::open(array('class'=>'list-toolbar form-horizontal', 'role'=>'form', 'method'=>'get')) }}
				{{ Form::hidden('page', $idcards->getCurrentPage()) }}
				<div class="col-lg-1">
					{{ Form::select('limit', $limit_sizes, $idcards->getPerPage(), array('class'=>'form-control', 'id'=>'limit')) }}
		      	</div>
				<div class="col-lg-2">
					{{ Form::select('validity', array(''=>'All ID Card', 'valid'=>'Valid', 'expired'=>'Expired'), Input::get('validity', null), array('class'=>'form-control', 'id'=>'validity')) }}
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
							<th width="10px"></th>
							<th>#</th>
							<th>Card No</th>
							<th>Name</th>
							<th>Type</th>
							<th>Validity</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($idcards as $key=>$idcard)
						<tr>
							<td><input name="idcard_id[]" class="idcard-id" value="{{ $idcard->id }}" type="checkbox"></td>
							<td>{{$key+$index}}</td>
							<td>{{$idcard->card_no}}</td>
							<td>{{$idcard->name}}</td>
							<td>{{ucwords($idcard->type)}}</td>
							<td>
							@if($idcard->type == 'faculty' || $idcard->type == 'staff' || strtotime($idcard->valid_upto) >= strtotime(date('Y-m-d')))
								<span class="label label-success">valid</span>
							@elseif(strtotime($idcard->valid_upto) < strtotime(date('Y-m-d')))
								<span class="label label-danger">expired</span>
							@endif
							</td>
							<td class="action">
								{{Form::open(array('url'=>url('idcard', array($idcard->id)), 'method'=>'delete'))}}
								
								@if($idcard->deleted_at == null)
								<a title="Edit ID Card" class="tooltip-top btn btn-success btn-xs" href="{{url('idcard', array($idcard->id, 'edit'))}}"><i class="fa fa-pencil"></i> Edit</a>
								@endif

								@if($idcard->deleted_at != null)
								<button class="tooltip-top btn btn-primary btn-xs restore-button" title="Restore ID" type="submit" name="restore" value="{{$idcard->id}}"><i class="fa fa-undo"></i> Restore</button>
								@endif
								
								@if($idcard->deleted_at == null)
								<button class="tooltip-top btn btn-danger btn-xs" title="Delete ID" type="submit" name="delete" value="{{$idcard->id}}"><i class="fa fa-times"></i> Delete</button>
								@endif

								<button class="tooltip-top btn btn-danger btn-xs force-delete-button" title="Delete ID Permanently" type="submit" name="force" value="{{$idcard->id}}"><i class="fa fa-times"></i> Force Delete</button>
								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="7">
								<button onclick="return printIdcard();" class="multiprint-button hidden btn btn-primary btn-md"><span class="fa fa-spinner fa-spin hidden"></span><i class="fa fa-print"></i> Print Selected</button>
							</td>
						</tr>
					</tfoot>
				</table>
				<div class="align-center">
					{{$idcards->appends($search_criteria)->links()}}
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

	$('.table tbody td').not(':first-child').on("click", function(){
		var checkbox = $(this).parent("tr").find("input.idcard-id");
		if(checkbox.is(':checked'))
			checkbox.prop("checked", false);
		else
			checkbox.prop("checked", true);

		if( $('.table tr input.idcard-id:checked').length )
			$('.multiprint-button').removeClass('hidden');
		else
			$('.multiprint-button').addClass('hidden');
	});

	$('.table tbody td .idcard-id').on("click", function(){
		if( $('.table tr input.idcard-id:checked').length )
			$('.multiprint-button').removeClass('hidden');
		else
			$('.multiprint-button').addClass('hidden');
	});
});

function printIdcard(){
	var id = [];
	$(".idcard-id:checked").each(function(){
		id.push($(this).val());
	});
	
	$(".multiprint-button span.fa-spinner, .multiprint-button i.fa-print").toggleClass('hidden');
	
	$.get('print-idcard/' + id.join(","), function(data){
		$(".multiprint-button span.fa-spinner, .multiprint-button i.fa-print").toggleClass('hidden');
		$('#print_area').html(data);
		// document.title = 'Print ID Cards';
		window.print();
	});
}
</script>
@stop