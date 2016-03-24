<div class="row-fluid">
	<div class="span6">
		{{ Form::open(array('url'=>'idcard', 'method'=>'POST', 'class'=>'form-horizontal')) }}
			{{ Form::hidden('type', 'student') }}
			<div class="control-group">
				{{ Form::label('student_name', 'Name', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::text('name', '', array('id'=>'student_name', 'placeholder'=>'Name of the student', 'class'=>'span10')) }}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('student_class', 'Class', array('class'=>'control-label')) }}
				<div class="controls">
					{{ Form::select('name', array('PSTE'=>'PSTE', 'In Service'=>'In Service'), '', array('id'=>'student_class', 'class'=>'span10')) }}
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="basicinput">Session</label>
				<div class="controls">
					<input type="text" id="basicinput" placeholder="Ex: {{ date('Y') . ' - ' . (date('Y')+1) }}" class="span8">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="basicinput">Valid Upto</label>
				<div class="controls">
					<input type="text" id="valid_upto" placeholder="Pick date..." class="span8">
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span12">
				<section class="module">
					<div class="module-head">
						<b>Front</b>
					</div><!--/.module-head-->
					<div class="module-body">
						
					</div><!--/.module-body-->
				</section>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<section class="module">
					<div class="module-head">
						<b>Back</b>
					</div><!--/.module-head-->
					<div class="module-body">
						
					</div><!--/.module-body-->
				</section>
			</div>
		</div>
	</div>
</div>