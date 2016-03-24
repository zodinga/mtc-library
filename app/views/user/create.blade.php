@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Add New User</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New User</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-8">
								{{ Form::open(array('url'=>'user', 'method'=>'post', 'class'=>'form-horizontal user-form', 'enctype'=>'multipart/form-data')) }}
									
									<div class="form-group {{($errors->has('username'))?'has-error':''}}">
										{{ Form::label('username', 'User Name', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('username', Input::old('username'), array('autocomplete'=>'off', 'id'=>'username', 'placeholder'=>'Enter username for login', 'class'=>'form-control')) }}

											@if($errors->has('username'))
											<p class="help-block text-danger">{{$errors->first('username')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group {{($errors->has('password'))?'has-error':''}}">
										{{ Form::label('password', 'Password', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::password('password', array('autocomplete'=>'off', 'id'=>'password', 'placeholder'=>'Enter password for login', 'class'=>'form-control')) }}

											@if($errors->has('password'))
											<p class="help-block text-danger">{{$errors->first('password')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group {{($errors->has('fullname'))?'has-error':''}}">
										{{ Form::label('fullname', 'Full Name', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('fullname', Input::old('fullname'), array('id'=>'fullname', 'placeholder'=>'Enter user full name', 'class'=>'form-control')) }}

											@if($errors->has('fullname'))
											<p class="help-block text-danger">{{$errors->first('fullname')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group">
										{{ Form::label('role', 'Role', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::select('role', array('principal'=>'Principal', 'administrator'=>'Administrator'), Input::old('role'), array('id'=>'role', 'class'=>'')) }}
										</div>
									</div>

									<div class="form-group {{($errors->has('avatar'))?'has-error':''}}">
										{{ Form::label('picture', 'Picture', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::file('picture', array('id'=>'picture'))}}

											@if($errors->has('picture'))
											<p class="help-block text-danger">{{$errors->first('picture')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group">
									    <div class="col-sm-offset-5 col-sm-7">
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