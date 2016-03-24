@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Advanced Booking</h1>
</div>

<div id="content">
	<div class="container">
		@include('layout.partial.alert')
		<div class="row">
			<div class="col-sm-7">
				<div class="panel panel-default browse-books">
					<div class="panel-heading">
						<h3 class="panel-title">Booking Form</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-8">
								{{ Form::open(array('url'=>url('saveBooking'), 'method'=>'post', 'class'=>'form-horizontal user-form')) }}
									<div class="form-group">
										<label class="col-sm-5 control-label" >Book Name </label>
										<div class="col-sm-7">
											<?php 
												if(Input::get('barcode'))
												{
													$barcode = Input::get('barcode');
												}
												else
												{
													$barcode = $barcode;
												}
												$book = Book::where('barcode','=',$barcode)->first(); 
												$booktitle = Booktitle::find($book->title);
											?>
											<input type="text" id="bookName" disabled="disabled"  class="form-control" value="{{$booktitle? $booktitle->title_name:'-'}}">
										</div>
									</div>

									<div class="form-group {{($errors->has('cardId'))?'has-error':''}}">
										{{ Form::label('cardId', 'Card ID', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('cardId', Input::get('cardId'), array('placeholder'=>'Enter Your Card ID', 'id'=>'cardId', 'class'=>'form-control','autocomplete'=>'off')) }}

											@if($errors->has('cardId'))
											<p class="help-block text-danger">{{$errors->first('cardId')}}</p>
											@endif
										</div>
									</div>

									
									<div class="form-group">
									    <div class="col-sm-offset-5 col-sm-7">
									    	<input type="hidden" name="barcode" value="{{$barcode}}">
											<button type="submit" class="btn btn-success" name="save">Save</button>
											<button type="button" onclick="location.href='http://mtc-library.com'" class="btn btn-danger" name="exit">Exit</button>
										</div>
									</div>
								{{ Form::close() }}
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Search Card ID</h3>
					</div>
					<div class="panel-body">
						{{ Form::open(array('url'=>'SearchCardId', 'method'=>'post', 'class'=>'form form-vertical')) }}
						<div class="form-group">
							{{ Form::label('memberName', 'Member Name') }}
							{{ Form::text('memberName', Input::get('memberName'), array('placeholder'=>'Enter Member Name', 'id'=>'memberName', 'class'=>'form-control','autocomplete'=>'off')) }}
						</div>
						<input type="hidden" name="barcode" value="{{$barcode}}">
						<button type="submit" class="btn btn-primary" name="find">Find</button>

						{{ Form::close() }}
					</div>
					@if($display)
					<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td>Card Id </td>
								<td>Name</td>
								<td>Type</td>
							</tr>
						</thead>
						<tbody>
							@foreach($icards as $icard)
							<tr>
								<td>{{$icard->card_no}}</td>
								<td>{{$icard->name}}</td>
								<td>{{$icard->type}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){});
</script>
@stop