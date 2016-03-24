@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Add New Publisher</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Publisher</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-10">
								{{ Form::open(array('url'=>'publisher', 'method'=>'post', 'class'=>'form-horizontal publisher-form', 'enctype'=>'multipart/form-data')) }}
									
									<div class="form-group {{($errors->has('publisher_name'))?'has-error':''}}">
										{{ Form::label('publisher_name', 'Publisher Name', array('class'=>'col-sm-4 control-label')) }}
										<div class="col-sm-8">
											{{ Form::text('publisher_name', Input::old('publisher_name'), array('autocomplete'=>'off', 'id'=>'publisher_name', 'placeholder'=>'Enter new publisher name', 'class'=>'form-control')) }}

											@if($errors->has('publisher_name'))
											<p class="help-block text-danger">{{$errors->first('publisher_name')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group">
									    <div class="col-sm-offset-4 col-sm-8">
											<button type="submit" class="btn btn-primary" name="create">Create</button>
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