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
			<li class="nav-header">Issue</li>
			<li>
				<a href="{{ url('issue/create') }}"><i class="icon-laptop"></i>Issue Book</a>
			</li>
			<li>
				<a href="{{ url('issue/create') }}"><i class="icon-reply"></i>Return Book</a>
			</li>
			<li>
				<a href="{{ url('issue') }}"><i class="icon-group"></i>Issues</a>
			</li>

			<li class="nav-header">Records</li>
			<li>
				<a href="{{ url('record/create') }}"><i class="icon-file-alt"></i>New Record</a>
			</li>
			<li>
				<a href="{{ url('record') }}"><i class="icon-book"></i>Records</a>
			</li>
			<li>
				<a href="{{ url('record') }}"><i class="icon-print"></i>Print Barcode</a>
			</li>

			<li class="nav-header">Members</li>
			<li>
				<a href="{{ url('member/create') }}"><i class="icon-laptop"></i>Member Registration</a>
			</li>
			<li>
				<a href="{{ url('member') }}"><i class="icon-group"></i>Members</a>
			</li>

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