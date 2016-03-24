@extends('layout.main')
@section('content')
<div class="container">

	<div class="row error-page">
		
		<p class="code"><i class="fa fa-frown-o"></i><i class="fa fa-warning"></i></p>
		<p class="description">You are denied access to this page!</p>

		<a href="{{url('/dashboard')}}" class="btn btn-danger btn-block btn-lg">&laquo; Retun to Dashboard</a>
	</div><!-- /.row -->

</div>
@stop