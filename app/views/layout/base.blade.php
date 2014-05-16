<!doctype html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    {{-- set the page title, if not specified, revert to default --}}
	    <title>{{ isset($pageTitle) ? $pageTitle : 'AirCentral' }}</title>

	    {{-- Load in twitter bootstrap --}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css') }}
		{{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css') }}

	    {{-- load in jquery --}}
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}
		{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js') }}

	    {{-- load in custom css --}}
	    {{ HTML::style('css/calendarstyle.css') }}
	</head> 
	<body  >
        
        @include('layout.elements.menu')

		<div id="masthead">  
		  <div class="container">
		    <div class="row">
		      <div class="col-md-7">
		        <h1>AirCentral
		          <p class="lead">Event calendar</p>
		        </h1>
		      </div>
		      <div class="col-md-5">
		        <div class="well well-lg"> 
		          <div class="row">
		            <div class="col-sm-12">
		              Ad Space			
		            </div>
		          </div>
		        </div>
		      </div>
		    </div> 
		  </div><!-- /cont -->
		  
		 
		</div>


		<div class="container">
		  <div class="row">
		    
		    <div class="col-md-12"> 
		      
		      <div class="panel">
		        <div class="panel-body">
		        
		          @yield('events')
		          
		          
		          <a href="/" class="btn btn-primary pull-right btnNext">More <i class="glyphicon glyphicon-chevron-right"></i></a>
		        
		          
		        </div>
		      </div>
		                                                                                       
			                                                
		                                                      
		   	</div><!--/col-12-->
		  </div>
		</div>
		                                                
		                                                                                
		<hr>

		<div class="container" id="footer">
		  <div class="row">
		    <div class="col col-sm-12">
		      
		      <h1>Follow Us</h1>
		      <div class="btn-group">
		       <a class="btn btn-twitter btn-lg" href="#"><i class="icon-twitter icon-large"></i> Twitter</a>
			   <a class="btn btn-facebook btn-lg" href="#"><i class="icon-facebook icon-large"></i> Facebook</a>
			   <a class="btn btn-google-plus btn-lg" href="#"><i class="icon-google-plus icon-large"></i> Google+</a>
		      </div>
		      
		    </div>
		  </div>
		</div>

		<hr>

		<footer>
		  <div class="container">
		    <div class="row">
		      <div class="col-sm-6">
		        <ul class="list-inline">
		          <li><i class="icon-facebook icon-2x"></i></li>
		          <li><i class="icon-twitter icon-2x"></i></li>
		          <li><i class="icon-google-plus icon-2x"></i></li>
		          <li><i class="icon-pinterest icon-2x"></i></li>
		        </ul>
		        
		      </div>
		      <div class="col-sm-6">
		          <p class="pull-right">Built with <i class="icon-heart-empty"></i> at <a href="http://www.bootply.com">Bootply</a></p>      
		      </div>
		    </div>
		  </div>
		</footer>
        
        
    </body>
</html>