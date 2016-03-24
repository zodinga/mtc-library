<div class="sidebar">
	<div class="wrapper">
		<div class="profile">
			<a href="{{ url('user/profile') }}">
				<img src="{{ asset(Auth::user()->avatar) }}" class="avatar pull-left" width="30" style="margin-right: 15px; border-radius: 4px">
				{{ Auth::user()->fullname }}
			</a>
			<a class="pull-right" title="Sign Out" href="{{ url('auth/logout') }}"><span class="icon-signout"></span></a>
		</div>

		<ul class="nav nav-list">
			<li class="nav-header">ID Card</li>
			<li>
				<a href="{{ url('idcard/create') }}"><i class="icon-credit-card"></i>New ID Card</a>
			</li>
			<li>
				<a href="{{ url('idcard') }}"><i class="icon-credit-card"></i>ID Cards</a>
			</li>
			<li>
				<a href="{{ url('idcard/print') }}"><i class="icon-print"></i>Print ID Card</a>
			</li>

			<li class="nav-header">Profile</li>
			<li class="active">
				<a href="index.html"><i class="icon-user"></i>Update Profile</a>
			</li>
			<li>
				<a href="index.html"><i class="icon-key"></i>Change Password</a>
			</li>
		</ul>
	</div>
</div>