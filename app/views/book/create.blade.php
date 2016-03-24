@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>New Book Entry</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Book Detail</h3>
					</div>

					<div class="panel-body">
						
						{{ Form::open(array('url'=>'book', 'method'=>'post', 'class'=>'form-horizontal book-form', 'enctype'=>'multipart/form-data')) }}

						<div class="row">
							
							<div class="col-lg-6 col-md-6">
								<div class="form-group {{($errors->has('title'))?'has-error':''}}">
									{{ Form::label('title', 'Book Title', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('title', Input::old('title',$booktitle->title_name), array('autocomplete'=>'off', 'id'=>'title', 'placeholder'=>'Enter title for the book', 'class'=>'form-control', 'disabled' => 'disabled', 'required' => 'required')) }}
										{{ Form::hidden('titleID', Input::old('titleID',$booktitle->id), array('id'=>'titleID', 'class'=>'form-control')) }}

										@if($errors->has('title'))
										<p class="help-block text-danger">{{$errors->first('title')}}</p>
										@endif
									</div>
								</div>

								<div class="form-group {{($errors->has('accession_no'))?'has-error':''}}">
									{{ Form::label('accession_no', 'Accession Number', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('accession_no', Input::old('accession_no'), array('autocomplete'=>'off', 'id'=>'accession_no', 'placeholder'=>'', 'class'=>'form-control','required' => 'required')) }}

										@if($errors->has('accession_no'))
										<p class="help-block text-danger">{{$errors->first('accession_no')}}</p>
										@endif
									</div>
								</div>

								<div class="form-group {{($errors->has('classification_no'))?'has-error':''}}">
									{{ Form::label('classification_no', 'Class No', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('classification_no', Input::old('classification_no'), array('autocomplete'=>'off', 'id'=>'classification_no', 'placeholder'=>'Optional', 'class'=>'form-control', 'required' => 'required')) }}

										@if($errors->has('classification_no'))
										<p class="help-block text-danger">{{$errors->first('classification_no')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('book_no'))?'has-error':''}}">
									{{ Form::label('book_no', 'Book No', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('book_no', Input::old('book_no'), array('autocomplete'=>'off', 'id'=>'book_no', 'placeholder'=>'Optional', 'class'=>'form-control', 'required' => 'required')) }}

										@if($errors->has('book_no'))
										<p class="help-block text-danger">{{$errors->first('book_no')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('edition'))?'has-error':''}}">
									{{ Form::label('edition', 'Edition', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('edition', Input::old('edition'), array('autocomplete'=>'off', 'id'=>'edition', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('edition'))
										<p class="help-block text-danger">{{$errors->first('edition')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('published_year'))?'has-error':''}}">
									{{ Form::label('published_year', 'Publication Year', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('published_year', Input::old('published_year'), array('autocomplete'=>'off', 'id'=>'published_year', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('published_year'))
										<p class="help-block text-danger">{{$errors->first('published_year')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('pages'))?'has-error':''}}">
									{{ Form::label('pages', 'Number of Pages', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('pages', Input::old('pages'), array('autocomplete'=>'off', 'id'=>'pages', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('pages'))
										<p class="help-block text-danger">{{$errors->first('pages')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('volume'))?'has-error':''}}">
									{{ Form::label('volume', 'Volume', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('volume', Input::old('volume'), array('autocomplete'=>'off', 'id'=>'volume', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('volume'))
										<p class="help-block text-danger">{{$errors->first('volume')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('isbn_no'))?'has-error':''}}">
									{{ Form::label('isbn_no', 'ISBN Number', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('isbn_no', Input::old('isbn_no'), array('autocomplete'=>'off', 'id'=>'isbn_no', 'placeholder'=>'Optional', 'class'=>'form-control')) }}

										@if($errors->has('isbn_no'))
										<p class="help-block text-danger">{{$errors->first('isbn_no')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('copies'))?'has-error':''}}">
									{{ Form::label('copies', 'Number of Copies', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('copies', Input::old('copies','1'), array('autocomplete'=>'off', 'id'=>'copies', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('copies'))
										<p class="help-block text-danger">{{$errors->first('copies')}}</p>
										@endif

									</div>
								</div>
								
								<div class="form-group {{($errors->has('price'))?'has-error':''}}">
									{{ Form::label('price', 'Book Price', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('price', Input::old('price'), array('autocomplete'=>'off', 'id'=>'price', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('price'))
										<p class="help-block text-danger">{{$errors->first('price')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('source'))?'has-error':''}}">
									{{ Form::label('source', 'Book Source', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::select('source', array(''=>'Select Book Source', 'gift'=>'Gift', 'purchase'=>'Purchase','others'=>'Others'), Input::get('source', null), array('class'=>'form-control', 'id'=>'source')) }}

										@if($errors->has('source'))
										<p class="help-block text-danger">{{$errors->first('source')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('source_name'))?'has-error':''}}">
									{{ Form::label('source_name', 'Source Name', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('source_name', Input::old('source_name'), array('autocomplete'=>'off', 'id'=>'source_name', 'placeholder'=>'Enter Source Name', 'class'=>'form-control')) }}

										@if($errors->has('source_name'))
										<p class="help-block text-danger">{{$errors->first('source_name')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('remarks'))?'has-error':''}}">
									{{ Form::label('remarks', 'Book Remarks', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::select('remarks', array(''=>'Select Book Remarks', 'general'=>'General', 'reference'=>'Reference','special collection'=>'Special Collection','general special collection'=>'General Special Collection','others'=>'Others'), Input::get('remarks', null), array('class'=>'form-control', 'id'=>'remarks')) }}

										@if($errors->has('remarks'))
										<p class="help-block text-danger">{{$errors->first('remarks')}}</p>
										@endif

									</div>
								</div>

							</div>

							<div class="col-lg-6 col-md-6">
								<div class="form-group {{($errors->has('category_new') || $errors->has('category_id'))?'has-error':''}}">
									{{ Form::label('category_id', 'Category / Subject', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-6">
										<?php
										$categories_options = array('' => 'Select Category');
										foreach($categories as $category)
											$categories_options[$category->id] = $category->category_name;
										?>

										{{ Form::select('category_id', $categories_options, Input::old('category_id'), array('autocomplete'=>'off', 'id'=>'category_id', 'placeholder'=>'', 'class'=>(Input::old('new_category')?'hidden ':'') . 'form-control')) }}
										
										{{ Form::text('category_new', Input::old('category_new'), array('autocomplete'=>'off', 'id'=>'category_new', 'placeholder'=>'Enter new category or subject', 'class'=>(Input::old('new_category')?'':'hidden ') . 'form-control')) }}
										
										@if($errors->has('category_new') || $errors->has('category_id'))
										<p class="help-block text-danger">Category field is required</p>
										@endif
										
										{{ Form::hidden('new_category', 0, array("id"=>"new_category")) }}
									</div>
									<div class="col-sm-2">
										<a title="Cancel" href="#" class="{{(Input::old('new_category')?'':'hidden ')}} tooltip-top btn btn-inverse btn-xs" id="new_category_cancel_button"><i class="fa fa-times"></i></a>
										<a title="Add New Category / Subject" href="#" class="{{(Input::old('new_category')?'hidden ':'')}}tooltip-top btn btn-success btn-xs" id="new_category_button"><i class="fa fa-plus"></i></a>
									</div>
								</div>

								<div class="form-group {{($errors->has('author_new') || $errors->has('author_id'))?'has-error':''}}">
									{{ Form::label('author_id', 'Author', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-6">
										<?php
										$authors_options = array('' => 'Select Author');
										foreach($authors as $author)
											$authors_options[$author->id] = $author->author_name;
										?>

										{{ Form::select('author_id', $authors_options, Input::old('author_id'), array('autocomplete'=>'off', 'id'=>'author_id', 'placeholder'=>'', 'class'=>(Input::old('new_author')?'hidden ':'') . 'form-control')) }}
										

										{{ Form::text('author_new', Input::old('author_new'), array('autocomplete'=>'off', 'id'=>'author_new', 'placeholder'=>'Enter new author', 'class'=>(Input::old('new_author')?'':'hidden ') . 'form-control')) }}
										
										@if($errors->has('author_new') || $errors->has('author_id'))
										<p class="help-block text-danger">Author field is required</p>
										@endif
										
										{{ Form::hidden('new_author', '0', array("id"=>"new_author")) }}
									</div>
									<div class="col-sm-2">
										<a title="Add New Author" href="#" class="{{(Input::old('new_author')?'hidden ':'')}}tooltip-top btn btn-success btn-xs" id="new_author_button"><i class="fa fa-plus"></i></a>
										<a title="Cancel" href="#" class="{{(Input::old('new_author')?'':'hidden ')}}tooltip-top btn btn-inverse btn-xs" id="new_author_cancel_button"><i class="fa fa-times"></i></a>
									</div>
								</div>

								<div class="form-group {{($errors->has('publisher_new') || $errors->has('publisher_id'))?'has-error':''}}">
									{{ Form::label('publisher_id', 'Publisher', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-6">
										<?php
										$publishers_options = array('' => 'Select Publisher');
										foreach($publishers as $publisher)
											$publishers_options[$publisher->id] = $publisher->publisher_name;
										?>
										
										{{ Form::select('publisher_id', $publishers_options, Input::old('publisher_id'), array('autocomplete'=>'off', 'id'=>'publisher_id', 'placeholder'=>'', 'class'=>(Input::old('new_author')?'hidden ':'') . 'form-control')) }}

										{{ Form::text('publisher_new', Input::old('publisher_new'), array('autocomplete'=>'off', 'id'=>'publisher_new', 'placeholder'=>'Enter new publisher', 'class'=>(Input::old('new_author')?'':'hidden ') . 'form-control')) }}
										
										@if($errors->has('publisher_new') || $errors->has('publisher_id'))
										<p class="help-block text-danger">Publisher field is required</p>
										@endif

										{{ Form::hidden('new_publisher', '0', array("id"=>"new_publisher")) }}
									</div>
									<div class="col-sm-2">
										<a title="Add New Publisher" href="#" class="{{(Input::old('new_author')?'hidden ':'')}}tooltip-top btn btn-success btn-xs" id="new_publisher_button"><i class="fa fa-plus"></i></a>
										<a title="Cancel" href="#" class="{{(Input::old('new_author')?'':'hidden ')}}tooltip-top btn btn-inverse btn-xs" id="new_publisher_cancel_button"><i class="fa fa-times"></i></a>
									</div>
								</div>

								<div class="form-group {{($errors->has('shelf_no'))?'has-error':''}}">
									{{ Form::label('shelf_no', 'Shelf Number', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('shelf_no', Input::old('shelf_no'), array('autocomplete'=>'off', 'id'=>'shelf_no', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('shelf_no'))
										<p class="help-block text-danger">{{$errors->first('shelf_no')}}</p>
										@endif

									</div>
								</div>

								<div class="form-group {{($errors->has('row_no'))?'has-error':''}}">
									{{ Form::label('row_no', 'Row Number', array('class'=>'col-sm-4 control-label')) }}
									<div class="col-sm-8">
										{{ Form::text('row_no', Input::old('row_no'), array('autocomplete'=>'off', 'id'=>'row_no', 'placeholder'=>'', 'class'=>'form-control')) }}

										@if($errors->has('row_no'))
										<p class="help-block text-danger">{{$errors->first('row_no')}}</p>
										@endif

									</div>
								</div>
							</div>
							

						</div>

						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="form-group">
								    <div class="col-sm-offset-4 col-sm-8">
										<button type="submit" class="btn btn-primary" name="create">Create</button>
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

<script type="text/javascript">
$(function(){
	$("#new_category_button, #new_category_cancel_button").on('click', function(ev){
		ev.preventDefault(true);
		
		$("#category_id").next(".bootstrap-select").toggleClass("hidden");
		$("#category_new, #new_category_button, #new_category_cancel_button").toggleClass("hidden");

		if($("#category_new").hasClass('hidden')) {
			$("#new_category").val(0);
			$("#category_new").val('');
			$("#category_new").next(".help-block").remove();
			$("#category_new").closest(".form-group").removeClass('has-error');
		}
		else
			$("#new_category").val(1);
	});

	$("#new_author_button, #new_author_cancel_button").on('click', function(ev){
		ev.preventDefault(true);
		
		$("#author_id").next(".bootstrap-select").toggleClass("hidden");
		$("#author_new, #new_author_button, #new_author_cancel_button").toggleClass("hidden");

		if($("#author_new").hasClass('hidden')) {
			$("#new_author").val(0);
			$("#author_new").val('');
			$("#author_new").next(".help-block").remove();
			$("#author_new").closest(".form-group").removeClass('has-error');
		}
		else
			$("#new_author").val(1);
	});

	$("#new_publisher_button, #new_publisher_cancel_button").on('click', function(ev){
		ev.preventDefault(true);
		
		$("#publisher_id").next(".bootstrap-select").toggleClass("hidden");
		$("#publisher_new, #new_publisher_button, #new_publisher_cancel_button").toggleClass("hidden");

		if($("#publisher_new").hasClass('hidden')) {
			$("#new_publisher").val(0);
			$("#publisher_new").val('');
			$("#publisher_new").next(".help-block").remove();
			$("#publisher_new").closest(".form-group").removeClass('has-error');
		}
		else
			$("#new_publisher").val(1);
	});
});
</script>
@stop