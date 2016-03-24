<?php $idcard = Idcard::where('card_no', '=', $card_no)->first(); ?>
	
<div class="row">
	<div class="col-lg-12">
	@if($idcard)
		@if($idcard->type == 'regular student' || $idcard->type == 'short course')
		@include('idcard.detail.student-idcard', array('data'=>$idcard))

		@elseif($idcard->type == 'staff')
		@include('idcard.detail.staff-idcard', array('data'=>$idcard))

		@endif
		<script type="text/javascript">
		$(function(){
			$("#idcard_{{$idcard->id}} .idcard-barcode").barcode('{{$idcard->card_no}}', 'code128', {barHeight:12, fontSize:10});
		});
		</script>		
	@else
		<p>Invalid ID Card or ID Card not found!</p>
	@endif
	
	</div>
</div>
