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

<!-- <nav class="navbar navbar-inverse user-notification">
	<div class="">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="tooltip" title="Friend Requests" data-placement="bottom" data-trigger="hover">
					<i class="fa fa-users"></i>
				</a>
			</li>
			<li class="dropdown">
				<a href="tasks.html" class="dropdown-toggle" data-toggle="tooltip" title="My Tasks" data-placement="bottom" data-trigger="hover">
					<i class="fa fa-th-list"></i>
					<span class="badge badge-info">1</span>
				</a>
			</li>
			<li class="dropdown">
				<a href="messages.html" class="dropdown-toggle" data-toggle="tooltip" title="Messages" data-placement="bottom" data-trigger="hover">
					<i class="fa fa-envelope"></i>
					<span class="badge badge-danger">4</span>
				</a>
			</li>
		</ul>
	</div>
</nav> -->

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
		<!--
		<li {{Request::path() == 'backup'?'class="active"':''}}>
			<a href="{{url('backup')}}">
				<i class="fa fa-list"></i>
				Database Backup
			</a>
		</li>
		-->
		
		<li {{Request::path() == 'issue/new'?'class="active"':''}}><a href="{{url('issue/new')}}"><i class="fa fa-cogs"></i> New Issue</a></li>

		<li {{Request::path() == 'issue'?'class="active"':''}}><a href="{{url('issue?page=1&amp;limit=30&amp;status=active&amp;search=')}}"><i class="fa fa-list"></i> Issue Records</a></li>
		
		<!-- <li {{Request::path() == 'issue/return'?'class="active"':''}}><a href="{{url('issue/return')}}"><i class="fa fa-reply"></i> Return</a></li> -->
		
		
		<li>
			<a href="#book_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-book"></i>
				Book <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('book*')?'in':''}}" id="book_menu">
				<li {{Request::path() == 'title/create'?'class="active"':''}}><a href="{{url('title/create')}}"><i class="fa fa-arrow-right"></i> New Entry</a></li>
				<li {{Request::path() == 'book'?'class="active"':''}}><a href="{{url('book')}}"><i class="fa fa-arrow-right"></i> Book List</a></li>
			</ul>
		</li>

		<li>
			<a href="#category_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-star"></i>
				Category <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('category*')?'in':''}}" id="category_menu">
				<li {{Request::path() == 'category/create'?'class="active"':''}}><a href="{{url('category/create')}}"><i class="fa fa-arrow-right"></i> New Category</a></li>
				<li {{Request::path() == 'category'?'class="active"':''}}><a href="{{url('category')}}"><i class="fa fa-arrow-right"></i> Category List</a></li>
			</ul>
		</li>

		<li>
			<a href="#author_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-user"></i>
				Author <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('author*')?'in':''}}" id="author_menu">
				<li {{Request::path() == 'author/create'?'class="active"':''}}><a href="{{url('author/create')}}"><i class="fa fa-arrow-right"></i> New Author</a></li>
				<li {{Request::path() == 'author'?'class="active"':''}}><a href="{{url('author')}}"><i class="fa fa-arrow-right"></i> Author List</a></li>
			</ul>
		</li>

		<li>
			<a href="#publisher_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-rocket"></i>
				Publisher <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('publisher*')?'in':''}}" id="publisher_menu">
				<li {{Request::path() == 'publisher/create'?'class="active"':''}}><a href="{{url('publisher/create')}}"><i class="fa fa-arrow-right"></i> New publisher</a></li>
				<li {{Request::path() == 'publisher'?'class="active"':''}}><a href="{{url('publisher')}}"><i class="fa fa-arrow-right"></i> Publisher List</a></li>
			</ul>
		</li>

		<li>
			<a href="#member_menu" data-toggle="collapse" data-parent=".side-nav" class="collapsed">
				<i class="fa fa-group"></i>
				Member <b class="caret"></b>
			</a>
			<ul class="panel-collapse collapse {{Request::is('member*')?'in':''}}" id="member_menu">
				<li {{Request::path() == 'idcard/create'?'class="active"':''}}><a href="{{url('idcard/create')}}"><i class="fa fa-arrow-right"></i> Create ID Card</a></li>
				<li {{Request::path() == 'idcard'?'class="active"':''}}><a href="{{url('idcard')}}"><i class="fa fa-arrow-right"></i> ID Card List</a></li>
				<li {{Request::path() == 'member/create'?'class="active"':''}}><a href="{{url('member/create')}}"><i class="fa fa-arrow-right"></i> Create Member</a></li>
			</ul>
		</li>
	</ul>
</nav>