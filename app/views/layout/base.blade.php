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

	    {{-- load in fonts --}}
		{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans') }}

	    {{-- load in custom css --}}
	    {{ HTML::style('css/calendarstyle.css') }}
	    {{ HTML::style('css/style.css') }}

	    {{-- load in custom javascripts --}}
	    {{ HTML::script('js/login.js') }}
	</head> 
	<body  >
        
        @include('layout.elements.menu')
        @section('title')
		 
		</div>

		@section('container')


		<div class="container" id="content">
		  <div class="row">
		    
		    <div class="col-md-12"> 
		      
		      <div class="panel">
		        <div class="panel-body">
		        
		          @yield('content')
		          
		        
		          
		        </div>
		      </div>
		                                                                                       
			                                                
		                                                      
		   	</div><!--/col-12-->
		  </div>
		</div>
		@show  
		@include('account.elements.login')                                             
		 
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
		          <p class="pull-right">By Sven Brettschneider &amp; Yannik Hegge</a><br/>

		          </p>      
		      </div>
		    </div>
		  </div>
		</footer>
        
        
    </body>
</html>