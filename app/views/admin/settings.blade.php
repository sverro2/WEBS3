@extends('admin.home')

@section('admincontent')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#change_ytURL_button').click(function(){
				var link = $('#change_ytURL_input').val();

				$.ajax({
				  type: "POST",
				  url: "set-settings",
				  data: {linkvalue:link}
				}).success(function(data){
					alert("De Youtube URL is geupdate!");
				});
			});
		});
	</script>

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
	    		Verander de Youtube Achtergrond
	    	</div>
	    	<div class="panel-body">
	    		<div class="col-md-9">
	    			<input type="text" id="change_ytURL_input" class="form-control" value="{{ $ytURL['value'] }}">
	    		</div>
	    		<div class="col-md-3">
	    			<input type="button" id="change_ytURL_button" class="form-control" value="Update Achtergrond">
	    		</div>
	    	</div>
  		</div>
	</div>
	
	
@stop