		<div id="idcard_{{$data->id}}" class="idcard idcard-preview">
			<div class="idcard-front">
				<div class="idcard-header">
					<div class="idcard-pillar"><img src="{{ asset('images/logo.jpg') }}"></div>
					<span class="idcard-title">MISSIONARY TRAINING CENTRE <br> PREBYTERIAN CHURCH OF MIZORAM</span>
					<h3>IDENTITY CARD</h3>
				</div>
				<div class="idcard-body">
					<div class="idcard-photo">
						@if($data->picture != '')
						<img src="{{asset($idcard->picture)}}" width="100%">
						@else
						<i class="icon-user"></i>
						@endif
					</div>
					<div class="idcard-detail">
						<p><span class="idcard-label">Name</span><span class="idcard-separator">:</span><span class="idcard-value name">{{$data->name}}</span></p>
						<p><span class="idcard-label">Father's Name</span><span class="idcard-separator">:</span><span class="idcard-value father-name">{{$data->father_name}}</span></p>
						<p><span class="idcard-label">Designation</span><span class="idcard-separator">:</span><span class="idcard-value designation">{{$data->designation}}</span></p>
						<p><span class="idcard-label">Date of Issue</span><span class="idcard-separator">:</span><span class="idcard-value issue">{{$data->date_of_issue}}</span></p>
						<p><span class="idcard-label">Blood Group</span><span class="idcard-separator">:</span><span class="idcard-value blood-group">{{$data->blood_group}}</span></p>
						<p><span class="idcard-label">Date of Birth</span><span class="idcard-separator">:</span><span class="idcard-value dob">{{$data->date_of_birth}}</span></p>
						<p><span class="idcard-label">Identification Mark</span><span class="idcard-separator">:</span><span class="idcard-value id-mark">{{$data->id_mark}}</span></p>
					</div>
				</div>
				<div class="idcard-footer">
					<div class="idcard-barcode"></div>
				</div>
			</div>
			<div class="idcard-back">
				<h4>Present Address:</h4>
				<pre class="present-address">{{$data->present_address}}</pre>
				<h4>Permanent Address:</h4>
				<pre class="permanent-address">{{$data->permanent_address}}</pre>
				<h4>Phone No: <span class="phone-no">{{$data->contact}}</span></h4>
				<h4>Identification Mark: <span class="id-mark">{{$data->id_mark}}</span></h4>
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
<script type="text/javascript">
var tm = "{{$idcard->card_no}}";

$(function(){
	temporary_generate_barcode(tm);

	$('#temporary_idcard .validity').text($('#temporary_validity').val());
	$('#temporary_validity').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#temporary_idcard .validity').text($('#temporary_validity').val());
		$('#temporary_validity').datepicker('hide');
	});

	$('#temporary_idcard .issue').text($('#temporary_date_of_issue').val());
	$('#temporary_date_of_issue').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#temporary_idcard .issue').text($('#temporary_date_of_issue').val());
		$('#temporary_date_of_issue').datepicker('hide');
	});

	$('#temporary_idcard .name').text($("#temporary_name").val());
	$("#temporary_name").on('keyup blur', function(){
		$('#temporary_idcard .name').text($(this).val());
	});

	$('#temporary_idcard .school').text($("#temporary_school").val());
	$("#temporary_school").on('keyup blur', function(){
		$('#temporary_idcard .school').text($(this).val());
	});

	$('#temporary_idcard .present-address').text($("#temporary_present_address").val());
	$("#temporary_present_address").on('keyup blur', function(){
		$('#temporary_idcard .present-address').text($(this).val());
	});

	$('#temporary_idcard .permanent-address').text($("#temporary_permanent_address").val());
	$("#temporary_permanent_address").on('keyup blur', function(){
		$('#temporary_idcard .permanent-address').text($(this).val());
	});

	$('#temporary_idcard .phone-no').text($("#temporary_mobile").val());
	$("#temporary_mobile").on('keyup blur', function(){
		$('#temporary_idcard .phone-no').text($(this).val());
	});

	$("#temporary_idcard .blood-group").text($("#temporary_blood_group").val());
	$("#temporary_blood_group").on('change', function(){
		$("#temporary_idcard .blood-group").text($(this).val());
	});
});

function temporary_generate_barcode(temporary_barcode_string) {
	$("#temporary_idcard .idcard-barcode").barcode(temporary_barcode_string, 'code128', {barHeight:12, fontSize:10});
	$("#temporary_card_no").val(temporary_barcode_string);
}
</script>
		