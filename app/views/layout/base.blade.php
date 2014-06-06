<!doctype html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    {{-- set the page title, if not specified, revert to default --}}
	    <title>{{ isset($pageTitle) ? $pageTitle : 'AirCentral' }}</title>

	    {{-- import all external libraries --}}
	    @include('layout.elements.imports')
	</head> 
	<body>
        <div id="fb-root"></div>
        <div id="yt"></div>

		@section('container')

		<div id="wrap">
			<div class="container">
			  <div class="row">
			    
			    <div class="col-md-12" id="content"> 
    				@include('layout.elements.title')
		          	@yield('content')                       
			   	</div><!--/col-12-->
			  </div>                                    
			<div id="push"></div>
			</div>
			@show  
			@include('account.elements.login')       
		</div>  
		<footer>
		  <div class="container" id="footer">
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