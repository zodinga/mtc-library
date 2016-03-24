@extends('layout.main')
@section('content')
<script type="text/javascript" src="{{asset('lib/flowplayer/flowplayer-3.2.13.min.js')}}"></script>
<div class="page-header">
	<h1>Help Videos</h1>
</div>

<div id="content">
	<div class="container">
		<!-- Video Start -->
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/help.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player1"></a>
				<h5>Help</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/author-edit.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player2"></a>
				 <h5>Author Edit</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/book-add.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player3"></a>
				 <h5>Book Add</h5>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/book-edit.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player4"></a>
				<h5>Book Edit</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/id-create.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player5"></a>
				 <h5>I.D Create</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/student-id.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player6"></a>
				 <h5>Students I.D</h5>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/faculty-id.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player7"></a>
				<h5>Faculty I.D</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/staff-id.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player8"></a>
				 <h5>Staff I.D</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/temporary-id.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player9"></a>
				 <h5>Temporary I.D</h5>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/id-print.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player10"></a>
				<h5>Print I.D Card</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/settings.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player11"></a>
				 <h5>Settings</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/user-add.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player12"></a>
				 <h5>Add New User</h5>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/member-add.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player13"></a>
				<h5>Create Member</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/member-delete.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player14"></a>
				 <h5>Delete Member</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/member-restore.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player15"></a>
				 <h5>Restore Member</h5>
			</div>
		</div>
		
		<div class="row" style="margin-bottom:50px">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/member-forcedelete.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player16"></a>
				<h5>Force Delete Member</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/browse-books.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player17"></a>
				 <h5>Browse Books</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/author-add.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player18"></a>
				 <h5>Author Add</h5>
			</div>
		</div>
		
		<div class="row" style="margin-bottom:50px">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/new-category.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player19"></a>
				<h5>New Category</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/new-issue.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player20"></a>
				 <h5>New Issue</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/issue-return.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player21"></a>
				 <h5>Issue Return</h5>
			</div>
		</div>
		
		<div class="row" style="margin-bottom:50px">
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/issuerecord-cancelreturn.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player22"></a>
				<h5>Issue Record Canceled Return</h5>
			</div>
			<div class="col-lg-4 col-md-4">
				<a
				 href="{{asset('help-videos/new-publisher.flv')}}"
				 style="display:block;width:100%;height:250px"  
				 id="player23"></a>
				 <h5>New Publisher</h5>
			</div>	
		</div>
		<!-- Video End -->
	</div>
</div>

<script type="text/javascript">
$(function(){});
flowplayer("player1", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player2", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player3", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player4", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player5", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player6", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player7", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player8", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player9", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player10", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player11", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player12", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player13", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player14", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player15", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player16", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player17", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player18", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player19", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player20", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player21", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player22", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
flowplayer("player23", "{{asset('lib/flowplayer/flowplayer-3.2.18.swf')}}", {clip: {autoPlay: false,autoBuffering: true}});
</script>
@stop