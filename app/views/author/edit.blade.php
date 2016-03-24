@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Edit Author</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{$author->author_name}}</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-10">
								{{ Form::open(array('url'=>url('author', array($author->id)), 'method'=>'put', 'class'=>'form-horizontal author-form', 'enctype'=>'multipart/form-data')) }}
									
									<div class="form-group {{($errors->has('author_name'))?'has-error':''}}">
										{{ Form::label('author_name', 'Author Name', array('class'=>'col-sm-4 control-label')) }}
										<div class="col-sm-8">
											{{ Form::text('author_name', Input::old('author_name', $author->author_name), array('autocomplete'=>'off', 'id'=>'author_name', 'placeholder'=>'Enter new author name', 'class'=>'form-control')) }}

											@if($errors->has('author_name'))
											<p class="help-block text-danger">{{$errors->first('author_name')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group">
									    <div class="col-sm-offset-4 col-sm-8">
											<button type="submit" class="btn btn-primary" name="save">Save</button>
										</div>
									</div>
								{{ Form::close() }}
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){});
</script>
@stop