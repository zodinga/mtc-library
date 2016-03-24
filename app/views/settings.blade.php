@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Settings</h1>
</div>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				
				@include('layout.partial.alert')

				{{ Form::open(array('url'=>'settings', 'method'=>'post', 'class'=>'settings-form form-horizontal', 'role'=>'form', 'enctype'=>'multipart/form-data')) }}
				<div class="form-group {{($errors->has('site_title'))?'has-error':''}}">
					{{ Form::label('site_title', 'Library Title', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('site_title', Input::old('site_title', Setting::whereSettingKey('site_title')->pluck('setting_data')), array('id'=>'site_title', 'placeholder'=>'Ex: Library Management Software', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('district'))?'has-error':''}}">
					{{ Form::label('district', 'District Name', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('district', Input::old('district', Setting::whereSettingKey('district')->pluck('setting_data')), array('id'=>'district', 'placeholder'=>'Ex: Aizawl District', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('district_code'))?'has-error':''}}">
					{{ Form::label('district_code', 'District Code', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('district_code', Input::old('district_code', Setting::whereSettingKey('district_code')->pluck('setting_data')), array('id'=>'district_code', 'placeholder'=>'Ex: 01', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('copyright'))?'has-error':''}}">
					{{ Form::label('copyright', 'Copyright Information', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('copyright', Input::old('copyright', Setting::whereSettingKey('copyright')->pluck('setting_data')), array('id'=>'copyright', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('logo'))?'has-error':''}}">
					{{ Form::label('logo', 'Logo', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::file('logo', array('id'=>'logo'))}}
						<?php $logo = Setting::whereSettingKey('logo')->pluck('setting_data'); ?>
						@if($logo != '')
						<p class="help-block">Upload new logo to change current logo.<br>
							<img src="{{asset($logo)}}" width="200px" height="auto"><br>
							<label>{{ Form::checkbox('remove_logo', 1) }} Remove Logo</label>
						</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-12">
						<h4>Number of Books Allowed To Borrow</h4>
						<hr>
					</div>
				</div>
				<div class="form-group {{($errors->has('faculty_allowed'))?'has-error':''}}">
					{{ Form::label('faculty_allowed', 'Faculty', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('faculty_allowed', Input::old('faculty_allowed', Setting::whereSettingKey('faculty_allowed')->pluck('setting_data')), array('id'=>'faculty_allowed', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('staff_allowed'))?'has-error':''}}">
					{{ Form::label('staff_allowed', 'Staff', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('staff_allowed', Input::old('staff_allowed', Setting::whereSettingKey('staff_allowed')->pluck('setting_data')), array('id'=>'staff_allowed', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('student_allowed'))?'has-error':''}}">
					{{ Form::label('student_allowed', 'Student', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('student_allowed', Input::old('student_allowed', Setting::whereSettingKey('student_allowed')->pluck('setting_data')), array('id'=>'student_allowed', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('temporary_allowed'))?'has-error':''}}">
					{{ Form::label('temporary_allowed', 'Temporary', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('temporary_allowed', Input::old('temporary_allowed', Setting::whereSettingKey('temporary_allowed')->pluck('setting_data')), array('id'=>'temporary_allowed', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>

				<div class="form-group {{($errors->has('booking_allowed'))?'has-error':''}}">
					{{ Form::label('booking_allowed', 'Booking Validity in Days', array('class'=>'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('booking_allowed', Input::old('booking_allowed', Setting::whereSettingKey('booking_allowed')->pluck('setting_data')), array('id'=>'booking_allowed', 'placeholder'=>'', 'class'=>'form-control')) }}
					</div>
				</div>


				<div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
						<button type="submit" class="btn btn-success" name="save">Save</button>
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop