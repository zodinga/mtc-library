@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Add New Issue</h1>
</div>

<div id="content">
	<div class="container new-issue">

		@include('layout.partial.alert')
		
		{{ Form::open(array('url'=>'issue/new', 'method'=>'post', 'class'=>'form-horizontal')) }}
		
		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include("issue.new.member-detail")
			</div>

			<div class="col-lg-12 col-md-12">
				@include("issue.new.add-book")
			</div>
		</div>

		{{ Form::close() }}

	</div>
</div>

<script type="text/javascript">
$(function(){
	if($("#member_card_no").val().length)
		fetchIdCard();
		
	$("#member_card_no").on('blur', function(ev){
		if($(this).val().length)
			fetchIdCard();
		else {
			$('#member_detail .idcard-detail').addClass('hidden');
			$('#member_detail .membership').addClass('hidden');
			$('#member_detail .idcard-detail .panel-body').html("");
			
			// $("#member_detail").removeClass('panel-danger').removeClass('panel-info').addClass('panel-default');
			$("#member_detail").removeClass('panel-danger').addClass('panel-default');

			// $("#add_book, #book_list").removeClass("hidden");
			// $("#add_book").removeClass('panel-success').addClass('panel-default');

			$('#member_detail .membership, #member_detail .member-status, #member_detail .member-history').addClass('hidden');
		}
	});

	$(".panel-heading").on('click', function(){
		var panel = $(this).closest('.panel');
		var panelBody = panel.find('.panel-body');
		
		panelBody.toggleClass('hidden');

		if(panelBody.is(':visible')) {
			panel.find('.fa-chevron-up').addClass('hidden');
			panel.find('.fa-chevron-down').removeClass('hidden');
		}
		else {
			panel.find('.fa-chevron-up').removeClass('hidden');
			panel.find('.fa-chevron-down').addClass('hidden');
		}
	});
});

var currentMemberType;

function fetchIdCard() {
	$('#member_detail .idcard-detail').addClass('hidden');

	if($("#member_card_no").val().length) {
		$('#member_detail .idcard-detail').removeClass('hidden');
		$('#member_detail .idcard-detail .panel-body').html('<h1 class="text-center"><i class="fa fa-spinner fa-spin"></i></h1><p class="text-center"><em>fetching id card detail...</em></p>');
		
		$.get('/idcard-detail/' + $("#member_card_no").val(), function(data){
			$('#member_detail .idcard-detail .panel-body').html(data);
			
			$("#member_detail .membership").addClass('hidden');
			$("#member_detail .member-status").addClass('hidden');
			$("#member_detail .member-history").addClass('hidden');

			if( $(data).text().trim() != 'Invalid ID Card or ID Card not found!') {
				
				$.getJSON('/member-status/' + $("#member_card_no").val(), function(memberData){
					if($.isEmptyObject(memberData)) {
						
						// Hightlight member detail panel with red
						// $("#member_detail").removeClass('panel-info').removeClass('panel-default').addClass('panel-danger');
						$("#member_detail").removeClass('panel-default').addClass('panel-danger');
						
						// Show membership status
						$("#member_detail .membership").removeClass('hidden');
						
						// Update the register now button to autopopulate the card no
						var createHref = $("#member_detail .membership .btn").attr('href');
						createHref += "?card_no=" + $("#member_card_no").val();
						$("#member_detail .membership .btn").attr('href', createHref);
						
						// Hide add book and book list panel
						// $("#add_book, #book_list").addClass("hidden");

						// Hide member status
						$("#member_detail .member-status").addClass('hidden');

						// Hide member history
						$("#member_detail .member-history").addClass('hidden');
					}
					else {
						currentMemberType = memberData.idcards.type;

						// First highlight the member detail panel with blue.
						// $("#member_detail").removeClass('panel-default').addClass('panel-info');
						$("#member_detail").removeClass('panel-danger').addClass('panel-default');

						// Next open add book panel and highlight green
						// $("#add_book .panel-heading").trigger("click");
						// $("#add_book").removeClass('panel-default').addClass('panel-success');
						$("#add_book").removeClass('panel-default');

						// Hide membership
						$("#member_detail .membership").addClass('hidden');

						// Show member status
						$("#member_detail .member-status").removeClass('hidden');
						$("#member_detail .member-status h5").addClass('hidden');
						if(memberData.idcards.type == 'faculty')
							$("#member_detail .member-status .faculty-allowed").removeClass('hidden');
						else if(memberData.idcards.type == 'staff')
							$("#member_detail .member-status .staff-allowed").removeClass('hidden');
						else if(memberData.idcards.type == 'student')
							$("#member_detail .member-status .student-allowed").removeClass('hidden');
						else if(memberData.idcards.type == 'temporary')
							$("#member_detail .member-status .temporary-allowed").removeClass('hidden');

						// Get pending history list and display
						$("#member_detail .member-history").html('<h1 class="text-center"><i class="fa fa-spinner fa-spin"></i></h1><p class="text-center"><em>fetching history...</em></p>');
						$.get('/pending-issue/' + $("#member_card_no").val(), function(pendingBooks){
							// console.log(pendingBooks);
							$("#member_detail .member-history").removeClass('hidden').html(pendingBooks);
						});
					}
				});
			}
		});
	}
}
</script>
@stop