<div class="row-fluid">
	<div class="span4">
		{{ Form::open(array('url'=>'idcard', 'method'=>'POST', 'class'=>'form-horizontal idcard-form')) }}
			{{ Form::hidden('card_no', $ps, array('id'=>'student_card_no')) }}
			<div class="control-group {{($errors->has('name'))?'error':''}}">
				{{ Form::label('student_name', 'Name', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('name', Input::old('name'), array('id'=>'student_name', 'placeholder'=>'Name of the student', 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('student_class', 'Class', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::select('type', array('pre service'=>'Pre Service', 'in service'=>'In Service'), '', array('id'=>'student_class', 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('session'))?'error':''}}">
				{{ Form::label('student_session', 'Session', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('session', Input::old('session'), array('id'=>'student_session', 'placeholder'=>'Ex: ' . date('Y') . ' - ' . (date('Y')+1), 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('date_of_issue'))?'error':''}}">
				{{ Form::label('student_date_of_issue', 'Date of Issue', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('date_of_issue', Input::old('date_of_issue'), array('placeholder'=>'Pick a date', 'class'=>'span12', 'id'=>'student_date_of_issue')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('valid_upto'))?'error':''}}">
				{{ Form::label('student_validity', 'Valid Upto', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('valid_upto', Input::old('valid_upto'), array('placeholder'=>'Pick a date', 'class'=>'span12', 'id'=>'student_validity')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('contact'))?'error':''}}">
				{{ Form::label('student_mobile', 'Mobile Number', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('contact', Input::old('contact'), array('id'=>'student_mobile', 'placeholder'=>'Student contact number', 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('present_address'))?'error':''}}">
				{{ Form::label('student_present_address', 'Present Address', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::textarea('present_address', Input::old('present_address'), array('id'=>'student_present_address', 'placeholder'=>'Student present address', 'rows'=>3, 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group {{($errors->has('permanent_address'))?'error':''}}">
				{{ Form::label('student_permanent_address', 'Permanent Address', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::textarea('permanent_address', Input::old('permanent_address'), array('id'=>'student_permanent_address', 'placeholder'=>'Student permanent address', 'rows'=>3, 'class'=>'span12')) }}
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary" name="create">Create</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<div class="span8">
		<div class="row-fluid">
			<div class="span12">
				<section class="idcard-preview-box module">
					<div class="module-head">
						<b>ID Card Preview</b>
					</div><!--/.module-head-->
					<div class="module-body">

						<div id="student_idcard" class="idcard idcard-preview">
							<div class="idcard-front">
								<div class="idcard-header">
									<div class="idcard-pillar"><img src="{{ asset('images/ashoka-pillar.png') }}"></div>
									<span class="idcard-title">DISTRICT INSTITUTE OF EDUCATION AND TRAINING</span>
									<span>GOVERNMENT OF MIZORAM. {{ strtoupper(get_setting('district')) }} DISTRICT</span>
									<h3>IDENTITY CARD</h3>
								</div>
								<div class="idcard-body">
									<div class="idcard-photo">
										<!-- <i class="icon-user"></i> -->
										<img src="{{asset('avatar/avatar-1.jpg')}}">
									</div>
									<div class="idcard-detail">
										<p><span class="idcard-label">Name</span><span class="idcard-separator">:</span><span class="idcard-value name"></span></p>
										<p><span class="idcard-label">Class</span><span class="idcard-separator">:</span><span class="idcard-value class">Pre Service</span></p>
										<p><span class="idcard-label">Session</span><span class="idcard-separator">:</span><span class="idcard-value session"></span></p>
										<p><span class="idcard-label">Date of Issue</span><span class="idcard-separator">:</span><span class="idcard-value issue"></span></p>
										<p><span class="idcard-label">Valid Upto</span><span class="idcard-separator">:</span><span style="color:red" class="idcard-value validity"></span></p>
									</div>
								</div>
								<div class="idcard-footer">
									<div class="idcard-barcode"></div>
								</div>
							</div>
							<div class="idcard-back">
								<h4>Phone No: <span class="phone-no"></span></h4>
								<h4>Present Address:</h4>
								<pre class="present-address"></pre>
								<h4>Permanent Address:</h4>
								<pre class="permanent-address"></pre>
								<div class="idcard-signature">signature of issuing authority</div>
							</div>
						</div>

					</div><!--/.module-body-->
				</section>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var student_ps = "{{$ps}}";
var student_is = "{{$is}}";

$(function(){
	student_generate_barcode(student_ps);

	$("#student_idcard .class").css('text-transform', 'capitalize').text($("#student_class").val());
	$("#student_class").change(function(){
		var student_class = $(this).val();
		$("#student_idcard .class").css('text-transform', 'capitalize').text($(this).val());
		if(student_class == 'pre service')
			student_generate_barcode(student_ps);
		else if(student_class == 'in service')
			student_generate_barcode(student_is);
	});

	$('#student_idcard .validity').text($('#student_validity').val());
	$('#student_validity').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#student_idcard .validity').text($('#student_validity').val());
		$('#student_validity').datepicker('hide');
	});

	$('#student_idcard .issue').text($('#student_date_of_issue').val());
	$('#student_date_of_issue').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#student_idcard .issue').text($('#student_date_of_issue').val());
		$('#student_date_of_issue').datepicker('hide');
	});

	$('#student_idcard .name').text($("#student_name").val());
	$("#student_name").on('keyup blur', function(){
		$('#student_idcard .name').text($(this).val());
	});

	$('#student_idcard .session').text($("#student_session").val());
	$("#student_session").on('keyup blur', function(){
		$('#student_idcard .session').text($(this).val());
	});

	$('#student_idcard .present-address').text($("#student_present_address").val());
	$("#student_present_address").on('keyup blur', function(){
		$('#student_idcard .present-address').text($(this).val());
	});

	$('#student_idcard .permanent-address').text($("#student_permanent_address").val());
	$("#student_permanent_address").on('keyup blur', function(){
		$('#student_idcard .permanent-address').text($(this).val());
	});

	$('#student_idcard .phone-no').text($("#student_mobile").val());
	$("#student_mobile").on('keyup blur', function(){
		$('#student_idcard .phone-no').text($(this).val());
	});
});

function student_generate_barcode(student_barcode_string) {
	$("#student_idcard .idcard-barcode").barcode(student_barcode_string, 'code128', {barHeight:18, fontSize:11});
	$("#student_card_no").val(student_barcode_string);
}
</script>