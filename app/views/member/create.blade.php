@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Create Library Member</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row row-demo">
			<div class="col-lg-12 col-md-12">
				@include('layout.partial.alert')
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Member</h3>
					</div>

					<div class="panel-body">
						<div class="row">

							<div class="col-lg-8">
								{{ Form::open(array('url'=>'member', 'method'=>'post', 'class'=>'form-horizontal member-form', 'enctype'=>'multipart/form-data')) }}
									
									{{ Form::hidden('card_no', '', array('id'=>'card_no')) }}
									
									<div class="form-group">
										<div class="col-sm-12">
											<div class="input-group">
												{{ Form::text('card_no_query', Input::get('card_no'), array('placeholder'=>'Enter Card Number', 'class'=>'form-control', 'id'=>'card_no_query')) }}
												<span class="input-group-btn">
													<button class="btn btn-success btn-disabled" id="check_id_card" type="button">Check ID Card</button>
												</span>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
											<div class="panel panel-outline idcard-detail hidden">
												<div class="panel-heading">
													<h3 class="panel-title">ID Card Detail</h3>
												</div>
												<div class="panel-body">
												</div>
											</div>
										</div>
									</div>

									<div class="form-group">
									    <div class="col-sm-offset-5 col-sm-7">
											<button type="submit" class="create-button hidden btn btn-primary" name="create">Create</button>
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
$(function(){
	if($("#card_no_query").val().length)
		fetchIdCard();

	$("#check_id_card").on('click', function(ev){
		fetchIdCard();
	});

	$("#card_no_query").on('blur', function(ev){
		fetchIdCard();
	});

	$("#card_no_query").on("keyup", function(){
		if($(this).val().length)
			$('.member-form #check_id_card').removeClass('btn-disabled');
		else
			$('.member-form #check_id_card').addClass('btn-disabled');
	});
});

function fetchIdCard() {
	$('.idcard-detail').addClass('hidden');
	$('.member-form .create-button').addClass('hidden');
	if($("#card_no_query").val().length) {
		$('.idcard-detail').removeClass('hidden');
		$('.idcard-detail .panel-body').html('<h1 class="text-center"><i class="fa fa-spinner fa-spin"></i></h1><p class="text-center"><em>fetching id card detail...</em></p>');
		$.get('/idcard-detail/' + $("#card_no_query").val(), function(data){
			$('.idcard-detail .panel-body').html(data);
			if( $(data).text().trim() != 'Invalid ID Card or ID Card not found!') {
				$('.member-form .create-button').removeClass('hidden');
				$("#card_no").val($("#card_no_query").val().toUpperCase());
			}
		});
	}
}
</script>
@stop