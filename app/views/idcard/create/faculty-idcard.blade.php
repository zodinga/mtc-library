<div class="row-fluid">
	<div class="col-lg-5">
		{{ Form::open(array('url'=>'idcard', 'method'=>'POST', 'class'=>'form-horizontal idcard-form', 'enctype'=>'multipart/form-data', 'autocomplete'=>'off')) }}
			{{ Form::hidden('fa_card_no', $fa, array('id'=>'faculty_card_no')) }}
			{{ Form::hidden('type', 'faculty')}}
			<div class="form-group {{($errors->has('fa_name'))?'has-error':''}}">
				{{ Form::label('faculty_name', 'Name', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('fa_name', Input::old('fa_name'), array('id'=>'faculty_name', 'placeholder'=>'Name of faculty', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_designation'))?'has-error':''}}">
				{{ Form::label('faculty_designation', 'Designation', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('fa_designation', Input::old('fa_designation'), array('id'=>'faculty_designation', 'placeholder'=>'Faculty designation', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_date_of_issue'))?'has-error':''}}">
				{{ Form::label('faculty_date_of_issue', 'Date of Issue', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('fa_date_of_issue', Input::old('fa_date_of_issue'), array('placeholder'=>'Pick a date', 'class'=>'form-control', 'id'=>'faculty_date_of_issue')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_contact'))?'has-error':''}}">
				{{ Form::label('faculty_mobile', 'Mobile Number', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::text('fa_contact', Input::old('fa_contact'), array('id'=>'faculty_mobile', 'placeholder'=>'Faculty contact number', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_blood_group'))?'has-error':''}}">
				{{ Form::label('faculty_blood_group', 'Blood Group', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::select('fa_blood_group', array('O+ve'=>'O+ve', 'A+ve'=>'A+ve', 'B+ve'=>'B+ve', 'AB+ve'=>'AB+ve','O'=>'O', 'A'=>'A', 'B'=>'B', 'AB'=>'AB'), Input::old('fa_blood_group'), array('id'=>'faculty_blood_group', 'placeholder'=>'', 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_present_address'))?'has-error':''}}">
				{{ Form::label('faculty_present_address', 'Present Address', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('fa_present_address', Input::old('fa_present_address'), array('id'=>'faculty_present_address', 'placeholder'=>'Faculty present address', 'rows'=>3, 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_permanent_address'))?'has-error':''}}">
				{{ Form::label('faculty_permanent_address', 'Permanent Address', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::textarea('fa_permanent_address', Input::old('fa_permanent_address'), array('id'=>'faculty_permanent_address', 'placeholder'=>'Faculty permanent address', 'rows'=>3, 'class'=>'form-control')) }}
				</div>
			</div>
			<div class="form-group {{($errors->has('fa_picture'))?'has-error':''}}">
				{{ Form::label('faculty_picture', 'Picture', array('class'=>'col-sm-5 control-label')) }}
				<div class="col-sm-7">
					{{ Form::file('fa_picture', array('id'=>'faculty_picture'))}}
					<p class="help-block">Picture cannot be previewed</p>
				</div>
			</div>
			<div class="form-group">
			    <div class="col-sm-offset-5 col-sm-7">
					<button type="submit" class="btn btn-primary" name="create">Create</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<div class="col-lg-7">
		<div class="row-fluid">
			<div class="span12">

				<div class="idcard-preview-box">
					<h4><i class="fa fa-eye"></i> Faculty ID Card Preview</h4>
					<div id="faculty_idcard" class="idcard idcard-preview">
						<div class="idcard-front">
							<div class="idcard-header">
								<div class="idcard-pillar"><img src="{{ asset('images/logo.jpg') }}"></div>
								<span class="idcard-title">MISSIONARY TRAINING CENTRE <br> PREBYTERIAN CHURCH OF MIZORAM</span>
								<h3>IDENTITY CARD</h3>
							</div>
							<div class="idcard-body">
								<div class="idcard-photo">
									<i class="icon-user"></i>
									<!-- <img src="{{asset('avatar/avatar-1.jpg')}}"> -->
								</div>
								<div class="idcard-detail">
									<p><span class="idcard-label">Name</span><span class="idcard-separator">:</span><span class="idcard-value name"></span></p>
									<p><span class="idcard-label">Designation</span><span class="idcard-separator">:</span><span class="idcard-value designation"></span></p>
									<p><span class="idcard-label">Date of Issue</span><span class="idcard-separator">:</span><span class="idcard-value issue"></span></p>
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
var fa = "{{$fa}}";

$(function(){
	faculty_generate_barcode(fa);

	$('#faculty_idcard .issue').text($('#faculty_date_of_issue').val());
	$('#faculty_date_of_issue').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#faculty_idcard .issue').text($('#faculty_date_of_issue').val());
		$('#faculty_date_of_issue').datepicker('hide');
	});

	$('#faculty_idcard .name').text($("#faculty_name").val());
	$("#faculty_name").on('keyup blur', function(){
		$('#faculty_idcard .name').text($(this).val());
	});

	$('#faculty_idcard .designation').text($("#faculty_designation").val());
	$("#faculty_designation").on('keyup blur', function(){
		$('#faculty_idcard .designation').text($(this).val());
	});

	$('#faculty_idcard .present-address').text($("#faculty_present_address").val());
	$("#faculty_present_address").on('keyup blur', function(){
		$('#faculty_idcard .present-address').text($(this).val());
	});

	$('#faculty_idcard .permanent-address').text($("#faculty_permanent_address").val());
	$("#faculty_permanent_address").on('keyup blur', function(){
		$('#faculty_idcard .permanent-address').text($(this).val());
	});

	$('#faculty_idcard .phone-no').text($("#faculty_mobile").val());
	$("#faculty_mobile").on('keyup blur', function(){
		$('#faculty_idcard .phone-no').text($(this).val());
	});

	$("#faculty_idcard .blood-group").text($("#faculty_blood_group").val());
	$("#faculty_blood_group").on('change', function(){
		$("#faculty_idcard .blood-group").text($(this).val());
	});
});

function faculty_generate_barcode(faculty_barcode_string) {
	$("#faculty_idcard .idcard-barcode").barcode(faculty_barcode_string, 'code128', {barHeight:12, fontSize:10});
	$("#faculty_card_no").val(faculty_barcode_string);
}
</script>