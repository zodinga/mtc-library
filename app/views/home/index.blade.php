@extends('layout.main')
@section('content')
<div class="page-header">
	<h1>Browse Books</h1>
</div>

<div id="content">
	<div class="container">

		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-default browse-books">
					<div class="panel-heading">
						<h3 class="panel-title">Books Recently Added</h3>
						<span title="Expand All"  class="expand-all tooltip-top pull-right btn btn-success btn-xs"><i class="fa fa-level-down"></i></span>
						<span title="Collapse All" class="collapse-all tooltip-top pull-right btn btn-primary btn-xs hidden"><i class="fa fa-level-up"></i></span>
					</div>
					<div class="panel-body">
						@if($books->count())
						<ol>
							@foreach($books as $book)
							<li>
								<p class="book-title">
									<b>
									<?php 
										$booktitle = Booktitle::find($book->title);  
										$trans = Transaction::where('book_id','=',$book->id)->whereRaw("returned_at is null")->first();
										$bookBarcode = Book::find($book->id);
										$bookings = Booking::where('barcode','=',$bookBarcode->barcode)->first();
										//var_dump($bookings);
										//var_dump($trans);
										echo $booktitle->title_name." : ";
										if($trans != NULL)
										{
											echo " <button type=\"button\" class=\"tooltip-top btn-xs btn btn-danger\">Issued</button>";
										}
										else
										{
											echo " <button type=\"button\" class=\"tooltip-top btn-xs btn btn-primary\">Available</button>";
										}
										
										if($trans != null && $bookings == NULL)
										{
											?>
											<button  type="button" onClick="location.href='/bookingCreate/{{$bookBarcode->barcode}}'" class="tooltip-top btn-xs btn btn-info">Booking</button>
											<?php
										}
										if($trans && $bookings != NULL)
										{
											echo " <button  type=\"button\" class=\"tooltip-top btn-xs btn btn-warning\">Booked</button>";
										}
									
									?>
									</b>
									<small class="created_at">added on {{date('d M Y, h:iA', strtotime($book->created_at))}}</small>
								</p>
								<div class="row book-detail hidden">
									<div class="col-sm-6">
										<table width="100%">
											<tr>
												<td align="right" width="20%"><i>Author</i></td>
												<td align="center" width="10px">:</td>
												<td>{{isset($book->author)?$book->author->author_name:'N/A'}}</td>
											</tr>
											<tr>
												<td align="right" width="20%"><i>Category</i></td>
												<td align="center" width="10px">:</td>
												<td>{{isset($book->category)?$book->category->category_name:'N/A'}}</td>
											</tr>
											<tr>
												<td align="right" width="20%"><i>Edition</i></td>
												<td align="center" width="10px">:</td>
												<td>{{$book->edition}}</td>
											</tr>
											<tr>
												<td align="right" width="20%"><i>Publisher</i></td>
												<td align="center" width="10px">:</td>
												<td>{{isset($book->publisher)?$book->publisher->publisher_name:'N/A'}}</td>
											</tr>
											<tr>
												<td align="right" width="20%"><i>Volume</i></td>
												<td align="center" width="10px">:</td>
												<td>{{$book->volume}}</td>
											</tr>
										</table>
									</div>
									<div class="col-sm-6">
										<table>
											<tr>
												<td align="right"><i>Shelf No</i></td>
												<td align="center" width="10px">:</td>
												<td>{{$book->shelf_no}}</td>
											</tr>
											<tr>
												<td align="right"><i>Row No</i></td>
												<td align="center" width="10px">:</td>
												<td>{{$book->row_no}}</td>
											</tr>
											<tr>
												<td align="right"><i>ISBN No</i></td>
												<td align="center" width="10px">:</td>
												<td>{{$book->isbn_no}}</td>
											</tr>
											<tr><td colspan="3"></td></tr>
											<tr>
												<td colspan="3">
													<a data-toggle="modal" data-target="#book{{$book->id}}_modal" href="javascript:;" class="btn btn-success btn-xs" href="#">View Status</a>

													<div class="modal fade book-status-view" id="book{{$book->id}}_modal" tabindex="-1" role="dialog" aria-labelledby="book{{$book->id}}_label" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="book{{$book->id}}_label">Status: <?php $booktitle = Booktitle::find($book->title); ?>{{$booktitle->title_name}}</h4>
																</div>
																<div class="modal-body">
																	<div class="row">
																		<div class="col-sm-12">
																			<?php 
																			$issues = Transaction::whereBookId($book->id)->whereRaw("returned_at is null")->get();
																			?>
																			<table class="table">
																				<thead>
																					<tr>
																						<th>#</th>
																						<th>Name</th>
																						<th>Issue Date</th>
																						<th>Due Date</th>
																					</tr>
																				</thead>
																				<tbody>
																					@if($issues->count())
																					@foreach($issues as $key=>$issue)
																					<tr>
																						<td>{{$key+1}}</td>
																						<td>
																							{{Idcard::whereCardNo($issue->card_no)->pluck('name')}} ({{$issue->card_no}})
																						</td>
																						<td>{{date('d M Y', strtotime($issue->issued_at))}}</td>
																						<td>{{date('d M Y', strtotime($issue->due_at))}}</td>
																					</tr>
																					@endforeach
																					@else
																					<tr>
																						<td colspan="4" class="text-center"><i>All copies are in library.</i></td>
																					</tr>
																					@endif
																					
																				</tbody>
																			</table>
																			
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</div><!-- /.modal-content -->
														</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->

												</td>
											</tr>
										</table>
									</div>
								</div>
							</li>
							@endforeach
						</ol>
						@else
						<p class="text-center"><i>No new books at the moment</i></p>
						@endif
					</div>
				</div>
			</div>



			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Search Books</h3>
					</div>
					<div class="panel-body">
						{{ Form::open(array('url'=>'/', 'method'=>'post', 'class'=>'form form-vertical')) }}
						<div class="form-group">
							{{ Form::label('category_id', 'Category') }}
							{{ Form::select('category_id', $categories, Input::old('category_id', 0), array('id'=>'category_id', 'class'=>'form-control')) }}
						</div>

						<div class="form-group">
							{{ Form::label('publisher_id', 'Publisher') }}
							{{ Form::select('publisher_id', $publishers, Input::old('publisher_id', 0), array('id'=>'publisher_id', 'class'=>'form-control')) }}
						</div>

						<div class="form-group">
							{{ Form::text('search', Input::get('search'), array('placeholder'=>'Book Title or Author', 'id'=>'search_string', 'class'=>'form-control')) }}
						</div>

					  	<button type="submit" class="btn btn-primary" name="find">Find</button>

						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop