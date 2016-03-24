<?php $bookEmptyWarning = Session::get('bookEmptyWarning'); ?>
@if(!empty($bookEmptyWarning))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{$bookEmptyWarning}}
	</div>
@endif

<div class="panel panel-default" id="add_book">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="toggle-view"><i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down hidden"></i></span> Book Items</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group">
					<div class="col-lg-12">
						{{ Form::text('barcode', Input::old('barcode'), array('placeholder'=>'Enter Barcode', 'class'=>'form-control', 'id'=>'barcode')) }}
					</div>
				</div>
				<div class="add-book-option hidden">
					<div class="form-group">
						{{ Form::label('due_date', 'Due Date', array('class'=>'control-label col-lg-3')) }}
						<div class="col-lg-9">
							{{ Form::text('due_date', date('d.m.Y'), array('placeholder'=>'', 'class'=>'form-control', 'id'=>'due_date')) }}
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-3 col-sm-9 text-right">
							<button type="button" class="add-item btn btn-primary" name="add">Add</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-6">
				<h5 class="badge badge-primary">BOOK DETAIL</h5>
				<div class="book-preview">
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<table class="table book-list">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<!-- <th>Copies</th> -->
							<th>Due Date</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php 
							$books = Input::old('book'); 
							$key = 0;
						?>
						@if(!empty($books))
						@foreach($books as $book)
						<?php $key++; ?>
						<tr id="{{$book['barcode']}}">
							<td>
								<input type="hidden" name="book[{{$key}}][book_id]" value="{{$book['book_id']}}" />
								<input type="hidden" name="book[{{$key}}][barcode]" value="{{$book['barcode']}}" />{{$key}}
							</td>
							<td><input type="hidden" name="book[{{$key}}][title]" value="{{$book['title']}}" />{{$book['title']}}</td>
							<td width="110px"><input class="form-control input-sm" type="text" name="book[{{$key}}][due_date]" value="{{$book['due_date']}}" /></td>
							<td><a class="btn btn-primary btn-xs remove-item" href="#" onclick="return removeItem('{{$book['barcode']}}')"><i class="fa fa-times"></i></a></td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<button class="btn btn-success" onclick="return validateForm()" name="submit">Submit</button>
			</div>
		</div>
		{{ Form::hidden('book_count', 0, array("id"=>'book_count')) }}
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#due_date').datepicker({
		format: 'dd.mm.yyyy',
		todayBtn: 'linked'
	}).on('changeDate', function(ev){
		$('#due_date').datepicker('hide');
	});

	if($("#add_book #barcode").val().length) {
		loadBook();
	}

	
	$("#add_book #barcode").on('blur', function(){
		if($(this).val().length) {
			loadBook();
		}
		else {

		}
		
	}).on('keyup', function(){
		// $("#add_book .book-preview").removeClass('hidden').html('<h1 class="text-center"><i class="fa fa-spinner fa-spin"></i></h1><p class="text-center"><em>loading book</em></p>');
		// $("#add_book .add-book-option").addClass('hidden');
	});

	$("#add_book .add-item").on('click', function(){
		// $("#add_book #barcode").focus();

		insertRow();
	});

	$(".book-list tbody input").on('keyup', function(){
		console.log('asd');
		if($(this).val() != 0 && $(this).val() != "")
			$(this).removeAttr("style");
	});
});

function loadBook() {
	$("#add_book .book-preview").removeClass('hidden').html('<h1 class="text-center"><i class="fa fa-spinner fa-spin"></i></h1><p class="text-center"><em>loading book</em></p>');
	$.get('/book-preview/' + $("#add_book #barcode").val(), function(data){
		if(data == 'notfound') {
			$("#add_book .book-preview").html("<h5 class='text-danger text-center'>Book not found</h5>");
			$("#add_book .add-book-option").addClass('hidden');
		}
		else {
			
			$("#add_book .book-preview").html(data);
			$("#add_book .add-book-option").removeClass('hidden');
			$("#add_book .add-item").focus();
		}
	});
}

function validateForm()
{
	var valid = true;
	$(".book-list tbody input").each(function(){
		$(this).removeAttr("style");
		if($(this).val() == 0 || $(this).val() == "") {
			$(this).css("border", "1px solid red");
			valid = valid && false;
		}
	});
	
	if(!valid)
		alert('Please correct the highlighted errors.');

	return valid;
}

function removeItem(barcode) {
	$("#" + barcode).remove();
	$('#book_count').val(parseInt($('#book_count').val()) - 1);
	return false;
}

var ctr = {{(!empty($books))?sizeof($books):0}};
var faculty_allowed = {{get_setting('faculty_allowed')}};
var staff_allowed = {{get_setting('staff_allowed')}};
var student_allowed = {{get_setting('student_allowed')}};
var temporary_allowed = {{get_setting('temporary_allowed')}};

function insertRow () {
	var currentCount = $(".member-history table.table tbody tr").size();
	var itemCount = $("table.book-list tbody tr").size();
	var allowedSize;
	if(currentMemberType == 'faculty')
		allowedSize = parseInt(faculty_allowed) - parseInt(currentCount);
	else if(currentMemberType == 'staff')
		allowedSize = parseInt(staff_allowed) - parseInt(currentCount);
	else if(currentMemberType == 'student')
		allowedSize = parseInt(student_allowed) - parseInt(currentCount);
	else if(currentMemberType == 'temporary')
		allowedSize = parseInt(temporary_allowed) - parseInt(currentCount);

	if( parseInt($('#available').text()) <= 0 ) {
		alert("This book cannot be added.");
		return false;
	}

	// console.log("st"+staff_allowed);
	// console.log("ite"+itemCount);
	// console.log("curre"+currentCount);
	// console.log(allowedSize);

	if(itemCount >= allowedSize) {
		alert("You can add only "+allowedSize+" books.");
		return false;
	}

	var barcode = $("#barcode").val();
	var book_id = $("#book_id").val();
	var book_title = $("#book_title").text();
	var copies = $("#copies").val();
	var due_date = $("#due_date").val();
	ctr += 1;

	var newRow = '<tr id="'+barcode+'">';
	newRow += '<td><input type="hidden" name="book['+ctr+'][book_id]" value="'+book_id+'" />';
	newRow += '<input type="hidden" name="book['+ctr+'][barcode]" value="'+barcode+'" />'+ctr+'</td>';
	newRow += '<td><input type="hidden" name="book['+ctr+'][title]" value="'+book_title+'" />'+book_title+'</td>';
	newRow += '<td width="160px"><input class="form-control input-sm" type="text" name="book['+ctr+'][due_date]" value="'+due_date+'" /></td>';
	newRow += '<td><a class="btn btn-primary btn-xs remove-item" href="#" onclick="return removeItem(\''+barcode+'\')"><i class="fa fa-times"></i></a></td>';
	newRow += '</tr>';

	$('#add_book .book-list tbody').append(newRow);
	$('#book_count').val(parseInt($('#book_count').val()) + 1);
}
</script>