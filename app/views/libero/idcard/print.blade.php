@extends('layout.print')
@section('content')
<div id="student_idcard" class="idcard idcard-preview">
	<div class="idcard-front">
		<div class="idcard-header">
			<div class="idcard-pillar"><img src="{{ asset('images/ashoka-pillar.png') }}"></div>
			<span class="idcard-title">DISTRICT INSTITUTE OF EDUCATION AND TRAINING</span>
			<span>GOVERNMENT OF MIZORAM. {{ strtoupper(get_setting('district')) }} DISTRICT</span>
			<h3>IDENTITY CARD</h3>
		</div>
		<div class="idcard-body">
			<div class="idcard-photo">
				<!-- <i class="icon-user"></i> -->
				<img width="43px" src="{{asset('avatar/avatar-1.jpg')}}">
			</div>
			<div class="idcard-detail">
				<p><span class="idcard-label">Name</span><span class="idcard-separator">:</span><span class="idcard-value name">Alan Lalhriatpuia</span></p>
				<p><span class="idcard-label">Class</span><span class="idcard-separator">:</span><span class="idcard-value class">Pre Service</span></p>
				<p><span class="idcard-label">Session</span><span class="idcard-separator">:</span><span class="idcard-value session">2014 - 2016</span></p>
				<p><span class="idcard-label">Date of Issue</span><span class="idcard-separator">:</span><span class="idcard-value issue">20.01.2014</span></p>
				<p><span class="idcard-label">Valid Upto</span><span class="idcard-separator">:</span><span style="color:red" class="idcard-value validity">20.01.2016</span></p>
			</div>
		</div>
		<div class="idcard-footer">
			<div class="idcard-barcode"></div>
			<div class="idcard-signature">signature of issuing authority</div>
		</div>
	</div>
	<div class="idcard-back">
		<h4>Present Address:</h4>
		<pre class="present-address">C-95/A, Ramthar Tlangveng
Aizawl, Mizoram. Pin - 796001</pre>
		<h4>Phone No: <span class="phone-no">1234567890</span></h4>
		<h4>Permanent Address:</h4>
		<pre class="permanent-address">C-95/A, Ramthar Tlangveng
Aizawl, Mizoram. Pin - 796001</pre>
	</div>
</div>
@stop