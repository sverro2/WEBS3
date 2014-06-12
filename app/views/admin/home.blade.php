@extends('layout.base')

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
		<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>  
		<hr>

		@section('admincontent')
		<div class="row">
			<!-- center left-->	
			<div class="col-md-7">
				<div class="well">Inbox Messages <span class="badge pull-right">3</span></div>

				<hr>

				<div class="panel panel-default">
					<div class="panel-heading"><h4>Processing Status</h4></div>
					<div class="panel-body">

						<small>Complete</small>
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%">
								<span class="sr-only">72% Complete</span>
							</div>
						</div>

						<small>In Progress</small>
						<div class="progress">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
								<span class="sr-only">20% Complete</span>
							</div>
						</div>

						<small>At Risk</small>
						<div class="progress">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
								<span class="sr-only">80% Complete</span>
							</div>
						</div>

					</div><!--/panel-body-->
				</div><!--/panel-->                     

			</div><!--/col-->
		</div>
		@show
	</div>
</div>
@stop