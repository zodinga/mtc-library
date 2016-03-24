<div class="panel panel-default" id="member_detail">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="toggle-view"><i class="fa fa-chevron-up hidden"></i><i class="fa fa-chevron-down"></i></span> Member Detail</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group {{($errors->has('member_card_no'))?'has-error':''}}">
					<div class="col-lg-12">
						{{ Form::text('member_card_no', Input::old('member_card_no'), array('placeholder'=>'Card number', 'id'=>'member_card_no', 'class'=>'form-control')) }}

						@if($errors->has('member_card_no'))
						<p class="help-block text-danger">{{$errors->first('member_card_no')}}</p>
						@endif
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

			</div>
			
			<div class="col-sm-7">
				<div class="membership text-center hidden">
					<h3 class="text-danger text-center"><i class="fa fa-warning"></i> Not a member yet</h3>
					<hr>
					<a href="{{url('member/create')}}" class="btn btn-success">Register Now</a>
				</div>

				<div class="member-status hidden">
					<table style="width:100%">
						<tr>
							<td>
								<h5 class="faculty-allowed hidden"><span class="badge badge-primary"><i class="fa fa-info"></i></span> Member is allowed to borrow <b>{{get_setting('faculty_allowed')}}</b> book(s) at a time.</h5>
								<h5 class="staff-allowed hidden"><span class="badge badge-primary"><i class="fa fa-info"></i></span> Member is allowed to borrow <b>{{get_setting('staff_allowed')}}</b> book(s) at a time.</h5>
								<h5 class="student-allowed hidden"><span class="badge badge-primary"><i class="fa fa-info"></i></span> Member is allowed to borrow <b>{{get_setting('student_allowed')}}</b> book(s) at a time.</h5>
								<h5 class="temporary-allowed hidden"><span class="badge badge-primary"><i class="fa fa-info"></i></span> Member is allowed to borrow <b>{{get_setting('temporary_allowed')}}</b> book(s) at a time.</h5>
							</td>
						</tr>
					</table>
				</div>

				<div class="member-history hidden">
					
				</div>
			</div>
		</div>
	</div>
</div>	