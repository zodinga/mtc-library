<nav class="side-nav">
	<ul class="nav nav-pills nav-stacked user-bar">
		<li>
			<a href="#user-menu" data-toggle="collapse" class="dropdown-toggle">
				<!-- <span class="pull-left">
					<img src="img/samples/avatar-4.jpg">
				</span> -->
				<span>
					<span class="user-name">{{Auth::user()->fullname}}</span>
					<span class="connection online"><i class="fa fa-circle"></i> Online</span>
				</span>

				<b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse" id="user-menu">
				<li><a href="{{url('profile')}}"><i class="fa fa-user"></i> Profile</a></li>
				<li><a href="{{url('help')}}"><i class="fa fa-question-circle"></i> Help</a></li>
				<li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out"></i> Sign Out</a></li>
			</ul>
		</li>
	</ul>
</nav>

<nav class="side-nav">
	<ul class="nav nav-pills nav-stacked">
		<li {{Request::path() == '/'?'class="active"':''}}>
			<a href="{{url('/')}}">
				<i class="fa fa-home"></i>
				Browse
			</a>
		</li>
		
		<li {{Request::path() == 'dashboard'?'class="active"':''}}>
			<a href="{{url('dashboard')}}">
				<i class="fa fa-dashboard"></i>
				Dashboard
			</a>
		</li>

		<li>
			<a href="#idcard_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-credit-card"></i>
				ID Card <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('idcard*')?'in':''}}" id="idcard_menu">
				<li {{Request::path() == 'idcard/create'?'class="active"':''}}><a href="{{url('idcard/create')}}"><i class="fa fa-arrow-right"></i> Create ID Card</a></li>
				<li {{Request::path() == 'idcard'?'class="active"':''}}><a href="{{url('idcard')}}"><i class="fa fa-arrow-right"></i> ID Card List</a></li>
			</ul>
		</li>

	</ul>
</nav>