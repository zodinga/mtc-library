@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Profile Update</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Your Profile</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-8">
								{{ Form::open(array('url'=>url('profile'), 'method'=>'post', 'class'=>'form-horizontal user-form', 'enctype'=>'multipart/form-data')) }}
									
									<div class="form-group {{($errors->has('username'))?'has-error':''}}">
										{{ Form::label('username', 'User Name', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('username', Input::old('username', $user->username), array('autocomplete'=>'off', 'id'=>'username', 'placeholder'=>'Enter username for login', 'class'=>'form-control')) }}

											@if($errors->has('username'))
											<p class="help-block text-danger">{{$errors->first('username')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group {{($errors->has('password'))?'has-error':''}}">
										{{ Form::label('password', 'Password', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::password('password', array('autocomplete'=>'off', 'id'=>'password', 'placeholder'=>'Enter password for login', 'class'=>'form-control')) }}

											<p class="help-block">Leave the password field blank to retain current password.</p>
											@if($errors->has('password'))
											<p class="help-block text-danger">{{$errors->first('password')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group {{($errors->has('fullname'))?'has-error':''}}">
										{{ Form::label('fullname', 'Full Name', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::text('fullname', Input::old('fullname', $user->fullname), array('id'=>'fullname', 'placeholder'=>'Enter user full name', 'class'=>'form-control')) }}

											@if($errors->has('fullname'))
											<p class="help-block text-danger">{{$errors->first('fullname')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group {{($errors->has('avatar'))?'has-error':''}}">
										{{ Form::label('picture', 'Picture', array('class'=>'col-sm-5 control-label')) }}
										<div class="col-sm-7">
											{{ Form::file('picture', array('id'=>'picture'))}}
											
											@if($user->avatar != 'avatar/default-white.png')
											<p class="help-block">Upload new picture to change current profile picture.<br>
												<img src="{{asset($user->avatar)}}" width="100px" height="auto"><br>
												<label>{{ Form::checkbox('remove_picture', 1) }} Remove Picture</label>
											</p>
											@endif
											
											@if($errors->has('picture'))
											<p class="help-block text-danger">{{$errors->first('picture')}}</p>
											@endif
										</div>
									</div>

									<div class="form-group">
									    <div class="col-sm-offset-5 col-sm-7">
											<button type="submit" class="btn btn-success" name="save">Save</button>
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