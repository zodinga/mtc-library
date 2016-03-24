@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Edit Book Title</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
		<div class="col-lg-6 col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Existing Book Title</h3>
					</div>

					<div class="panel-body">
						
						<div class="row">
							
							<div class="col-lg-12 col-md-12">
							{{ Form::open(array('url'=>'title-search', 'method'=>'post', 'class'=>'form-horizontal book-form', 'enctype'=>'multipart/form-data')) }}
								<div class="col-lg-12 col-md-12">
									<div class="form-group {{($errors->has('title'))?'has-error':''}}">
										{{ Form::label('title', 'Book Title', array('class'=>'col-sm-4 control-label')) }}
										<div class="col-sm-4">
											{{ Form::text('title', Input::old('title'), array('autocomplete'=>'off', 'id'=>'title', 'placeholder'=>'Enter title for the book', 'class'=>'form-control')) }}

											@if($errors->has('title'))
											<p class="help-block text-danger">{{$errors->first('title')}}</p>
											@endif
										</div>
									    <div class="col-sm-4">
											<button type="submit" class="btn btn-primary" name="create">Search</button>
										</div>
									</div>
								</div>
							{{ Form::close() }}
								<table class="table table-hover">
									<thead>
										<tr>
											<td>#</td>
											<td>Book Title</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
										@foreach($booktitles as $booktitle)
										<tr>
											<td>{{$booktitle->id}}</td>
											<td>{{$booktitle->title_name}}</td>
											<td>
												{{ Form::open(array('url'=>'new-book', 'method'=>'post', 'class'=>'form-horizontal book-form', 'enctype'=>'multipart/form-data')) }}
												<a title="Edit Book title" class="tooltip-top btn btn-primary btn-xs" href="{{url('title', array($booktitle->id, 'edit'))}}"><i class="fa fa-pencil"></i> Edit</a>
												<Input type="hidden" name="titleID" value="{{$booktitle->id}}">
												<button type="submit" class="tooltip-top btn btn-success btn-xs" name="create"><i class="fa fa-plus"></i> New Book</button>
												{{ Form::close() }}
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Book Title</h3>
					</div>

					<div class="panel-body">
						
						{{ Form::open(array('url'=>url('title', array($title->id)), 'method'=>'put', 'class'=>'form-horizontal book-form', 'enctype'=>'multipart/form-data')) }}

						<div class="row">
							
							<div class="col-lg-12 col-md-12">
								<div class="form-group {{($errors->has('title'))?'has-error':''}}">
									{{ Form::label('title', 'Book Title', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('title', Input::old('title', $title->title_name), array('autocomplete'=>'off', 'id'=>'title', 'placeholder'=>'Enter title for the book', 'class'=>'form-control')) }}

										@if($errors->has('title'))
										<p class="help-block text-danger">{{$errors->first('title')}}</p>
										@endif
									</div>
								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
								    <div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-primary" name="create">Update</button>
									</div>
								</div>
							</div>
							<div class="col-sm-6"></div>
						</div>

						{{ Form::close() }}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@stop