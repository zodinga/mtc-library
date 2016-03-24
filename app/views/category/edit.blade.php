@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Edit Category</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">{{$category->category_name}}</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-10">
								{{ Form::open(array('url'=>url('category', array($category->id)), 'method'=>'put', 'class'=>'form-horizontal category-form', 'enctype'=>'multipart/form-data')) }}
									
									<div class="form-group {{($errors->has('category_name'))?'has-error':''}}">
										{{ Form::label('category_name', 'Category Name', array('class'=>'col-sm-4 control-label')) }}
										<div class="col-sm-8">
											{{ Form::text('category_name', Input::old('category_name', $category->category_name), array('autocomplete'=>'off', 'id'=>'category_name', 'placeholder'=>'Enter new category name', 'class'=>'form-control')) }}

											@if($errors->has('category_name'))
											<p class="help-block text-danger">{{$errors->first('category_name')}}</p>
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