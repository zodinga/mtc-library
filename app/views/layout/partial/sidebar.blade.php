<nav class="side-nav">
	<ul class="nav nav-pills nav-stacked user-bar">
		<li>
			<a href="#user-menu" data-toggle="collapse" class="dropdown-toggle">
				<!-- <span class="pull-left">
					<img src="img/samples/avatar-4.jpg">
				</span> -->
				<span>
					<span class="user-name">Guest</span>
					<span class="connection online"><i class="fa fa-circle"></i> Online</span>
				</span>

				<b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse" id="user-menu">
				<li><a href="{{url('auth')}}"><i class="fa fa-sign-in"></i> Sign In</a></li>
			</ul>
		</li>
	</ul>
</nav>

<nav class="side-nav">
	<ul class="nav nav-pills nav-stacked">
		<li  {{Request::path() == '/'?'class="active"':''}}>
			<a href="{{url('/')}}">
				<i class="fa fa-home"></i>
				Browse
			</a>
		</li>
	</ul>
</nav>
<nav class="side-nav">
	<ul class="nav nav-pills nav-stacked">
		<li {{Request::path() == '/vewProfile'?'class="active"':''}}>
			<a href="{{url('/viewProfile')}}">
				<i class="fa fa-user"></i>
				View Profile
			</a>
		</li>
	</ul>
</nav>