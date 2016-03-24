@extends('layout.main')
@section('content')
<div class="content-head">
	<ul class="breadcrumb">
		<li><a href="{{ url('/dashboard') }}">Home</a> <span class="divider"><i class="icon-angle-right"></i></span></li>
		<li class="active">ID Cards</li>
	</ul>
	<h2>ID Cards List</h2>
	<div class="muted">
		List of ID cards for students, faculty and temporary teachers.
	</div>
</div>
<div class="content-body">
	<section class="row-fluid">
		<div class="span12">
			<div class="module no-head message">
				<div class="module-body no-padding">
					<div class="module-option">
						<div class="row-fluid">
							<div class="span8">
								{{ Form::open(array('url'=>'idcard', 'class'=>'form-absolute', 'method'=>'get')) }}
									<button type="submit" class="btn btn-icon go-right"><i class="icon-search"></i></button>
									<input type="text" name="search" class="input-block-level" placeholder="Search card number or name..." autocomplete="off">
								{{ Form::close() }}
							</div>
							<div class="span4 message-navigation align-right hidden-phone">
								<div class="btn-toolbar">
									<div class=" btn-group">
										<button class="btn"><i class="icon-chevron-left"></i></button>
										<button class="btn" disabled="disabled"><i class="icon-chevron-right"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<table class="table table-utilities vertical-top">
						<tbody>
							<tr>
								<td class="cell-avatar">
									<img src="img/samples/avatar-2.jpg" class="avatar img-circle">
								</td>
								<td class="cell-detail">
									<button type="button" class="btn btn-inverse pull-right" data-toggle="collapse" data-target="#people-brief-2"><i class="icon-ellipsis-horizontal"></i></button>
									<h5 class="people-name">Andy Norman <small>@andynorman</small></h5>
									<div class="people-brief">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
									<div class="muted">
										255 friends, Kuala Lumpur, MY
									</div>
									<div class="people-action">
										<div id="people-brief-2" class="collapse">
											<p>
												<button class="btn btn-primary"><i class="icon-envelope-alt"></i> &nbsp; Message</button>
												<button class="btn btn-success"><i class="icon-phone"></i> &nbsp; Call Mobile</button>
											</p>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>

					<div class="module-option">
						<div class="row-fluid">
							<div class="span8 hidden-phone">
								<div style="line-height: 30px">
									Displaying <b>10</b> of 4,230 people
								</div>
							</div>
							<div class="span4 message-navigation align-right">
								<div class="btn-toolbar">
									<div class=" btn-group">
										<button class="btn"><i class="icon-chevron-left"></i></button>
										<button class="btn"><i class="icon-chevron-right"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="module">
		<div class="module-head">
			{{ Form::open(array('url'=>'idcard', 'method'=>'get')) }}
				{{ Form::select('type', $types) }}
			{{ Form::close() }}
		</div><!--/.module-head-->

		<div class="module-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Card No</th>
						<th>Name</th>
						<th>Type</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php var_dump($idcards->count()); ?>
					@foreach($idcards as $key=>$idcard)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$idcard->card_no}}</td>
						<td>{{$idcard->name}}</td>
						<td>{{ucwords($idcard->type)}}</td>
						<td class="action">
							{{Form::open(array('url'=>'idcard/' . $idcard->id, 'method'=>'delete'))}}
							<a class="tooltip-top" title="View ID Card" href="{{url('idcard/' . $idcard->id)}}"><i class="icon-eye-open"></i></a>
							<a class="tooltip-top" title="Edit ID Card" href="{{url('idcard/' . $idcard->id . '/edit')}}"><i class="icon-pencil"></i></a>
							<button class="tooltip-top btn-link" title="Delete ID Card" type="submit" name="idcard_id" value="{{$idcard->id}}"><i class="icon-trash"></i></button>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			

			{{$idcards->links()}}
		</div><!--/.module-body-->
	</section>
</div>
@stop