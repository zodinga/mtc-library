<div class="row-fluid">
	<div class="col-lg-5">
		{{ Form::open(array('url'=>url('idcard', array($idcard->id)), 'method'=>'put', 'class'=>'form-horizontal idcard-form', 'enctype'=>'multipart/form-data', 'autocomplete'=>'off')) }}
			{{ Form::hidden('card_no', $idcard->card_no, array('id'=>'student_card_no')) }}
			<div class="form-group {{($errors->has('name'))?'has-error':''}}">
				{{ Form::label('student_name', 'Name', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('name', Input::old('name', $idcard->name), array('id'=>'student_name', 'placeholder'=>'Name of the student', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('student_class', 'Class', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::select('type', array('regular student'=>'Regular Student', 'short course'=>'Short Course'), $idcard->type, array('id'=>'student_class', 'disabled'=>'disabled')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('session'))?'has-error':''}}">
				{{ Form::label('student_session', 'Session', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('session', Input::old('session', $idcard->session), array('id'=>'student_session', 'placeholder'=>'Ex: ' . date('Y') . ' - ' . (date('Y')+1), 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('date_of_issue'))?'has-error':''}}">
				{{ Form::label('student_date_of_issue', 'Date of Issue', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('date_of_issue', Input::old('date_of_issue', date('d.m.Y', strtotime($idcard->date_of_issue)) ), array('placeholder'=>'Pick a date', 'class'=>'form-control', 'id'=>'student_date_of_issue')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('valid_upto'))?'has-error':''}}">
				{{ Form::label('student_validity', 'Valid Upto', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('valid_upto', Input::old('valid_upto', date('d.m.Y', strtotime($idcard->valid_upto)) ), array('placeholder'=>'Pick a date', 'class'=>'form-control', 'id'=>'student_validity')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('contact'))?'has-error':''}}">
				{{ Form::label('student_mobile', 'Mobile Number', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('contact', Input::old('contact', $idcard->contact), array('id'=>'student_mobile', 'placeholder'=>'Student contact number', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('blood_group'))?'has-error':''}}">
				{{ Form::label('student_blood_group', 'Blood Group', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::select('blood_group', array('O+ve'=>'O+ve', 'A+ve'=>'A+ve', 'B+ve'=>'B+ve', 'AB+ve'=>'AB+ve','O'=>'O', 'A'=>'A', 'B'=>'B', 'AB'=>'AB'), Input::old('blood_group', $idcard->blood_group), array('id'=>'student_blood_group', 'placeholder'=>'', 'class'=>'form-control')) }}
				</div>
			</div>			

			<div class="form-group {{($errors->has('present_address'))?'has-error':''}}">
				{{ Form::label('student_present_address', 'Present Address', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('present_address', Input::old('present_address', $idcard->present_address), array('id'=>'student_present_address', 'placeholder'=>'Student present address', 'rows'=>3, 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('permanent_address'))?'has-error':''}}">
				{{ Form::label('student_permanent_address', 'Permanent Address', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('permanent_address', Input::old('permanent_address', $idcard->permanent_address), array('id'=>'student_permanent_address', 'placeholder'=>'Student permanent address', 'rows'=>3, 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('picture'))?'has-error':''}}">
				{{ Form::label('student_picture', 'Picture', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::file('picture', array('id'=>'student_picture'))}}
					<p class="help-block">Picture cannot be previewed</p>
				</div>
			</div>
			<div class="form-group">
			    <div class="col-sm-offset-5 col-sm-7">
					<button type="submit" class="btn btn-success" name="save">Save</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<div class="col-lg-7">
		<div class="row-fluid">
			<div class="span12">
				<div class="idcard-preview-box">
					<h4><i class="fa fa-eye"></i> Student ID Card Preview</h4>

					<div id="student_idcard" class="idcard idcard-preview">
						<div class="idcard-front">
							<div class="idcard-header">
								<div class="idcard-pillar"><img src="{{ asset('images/logo.jpg') }}"></div>
								<span class="idcard-title">MISSIONARY TRAINING CENTRE <br> PREBYTERIAN CHURCH OF MIZORAM</span>
								<h3>IDENTITY CARD</h3>
							</div>
							<div class="idcard-body">
								<div class="idcard-photo">
									@if($idcard->picture != '')
									<img src="{{asset($idcard->picture)}}" width="100%">
									@else
									<i class="icon-user"></i>
									@endif
								</div>
								<div class="idcard-detail">
									<p><span class="idcard-label">Name</span><span class="idcard-separator">:</span><span class="idcard-value name"></span></p>
									<p><span class="idcard-label">Class</span><span class="idcard-separator">:</span><span class="idcard-value class">Pre Service</span></p>
									<p><span class="idcard-label">Session</span><span class="idcard-separator">:</span><span class="idcard-value session"></span></p>
									<p><span class="idcard-label">Date of Issue</span><span class="idcard-separator">:</span><span class="idcard-value issue"></span></p>
									<p><span class="idcard-label">Valid Upto</span><span class="idcard-separator">:</span><span style="color:red" class="idcard-value validity"></span></p>
									<p><span class="idcard-label">Blood Group</span><span class="idcard-separator">:</span><span class="idcard-value blood-group"></span></p>
								</div>
							</div>
							<div class="idcard-footer">
								<div class="idcard-barcode"></div>
							</div>
						</div>
						<div class="idcard-back">
							<h4>Present Address:</h4>
							<pre class="present-address"></pre>
							<h4>Permanent Address:</h4>
							<pre class="permanent-address"></pre>
							<h4>Phone No: <span class="phone-no"></span></h4>
							<h4>Identification Mark: <span class="id-mark"></span></h4>
							<div class="idcard-logo"><img src="{{ asset('images/logo.jpg') }}" height="40px" width="41px"></div>
							
							<div class="idcard-signature">signature of issuing authority</div>
							<div class="terms">
								<hr>
								<ol>
									<li>This card is the property of MTC</li>
									<li>Transfer of this card to another person is a punishable crime</li>
									<li>Loss will be reported immediately</li>
								</ol>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var student_ps = "{{$idcard->card_no}}";
var student_is = "{{$idcard->card_no}}";

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

	$("#student_idcard .blood-group").text($("#student_blood_group").val());
	$("#student_blood_group").on('change', function(){
		$("#student_idcard .blood-group").text($(this).val());
	});
});

function student_generate_barcode(student_barcode_string) {
	$("#student_idcard .idcard-barcode").barcode(student_barcode_string, 'code128', {barHeight:12, fontSize:10});
	$("#student_card_no").val(student_barcode_string);
}
</script>