@extends('layout.base')

@section('subtitle')
Admin panel
@stop

@section('content')
<!-- upper section -->
<div class="row">
	<div class="col-md-3">
	    <!-- left -->
	    <a href="#"><strong><i class="glyphicon glyphicon-briefcase"></i> Toolbox</strong></a>
	    <hr>
	    
	    <ul class="nav nav-pills nav-stacked">
	      <li><a href="{{ url('admin') }}"><i class="glyphicon glyphicon-user"></i> Admin</a></li>
	      <li><a href="{{ url('admin/organisation') }}"><i class="glyphicon glyphicon-book"></i> Organisatie</a></li>
	      <li><a href="{{ url('admin/event') }}"><i class="glyphicon glyphicon-flash"></i> Evenementen</a></li>
	      <li><a href="{{ url('admin/setting') }}"><i class="glyphicon glyphicon-plus"></i> Website Instellingen</a></li>
	    </ul>
	    
    	<hr>
    
	</div><!-- /span-3 -->

	<div class="col-md-9">
    	
<!-- column 2 -->	
		<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> {{ $title or "Admin" }}</strong></a>  
		<hr>

		@section('admincontent')
		<div class="row">
			<!-- center left-->	
			<div class="col-md-7">

				<div class="panel panel-default">
					<div class="panel-heading">
						Good day! Your are logged in as Admin.
					</div>
					<div class="panel-body">
						
					</div>
				    
				</div>          

			</div><!--/col-->
		</div>
		@show
	</div>
</div>
@stop