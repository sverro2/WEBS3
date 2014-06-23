@extends('admin.home')

@section('admincontent')

<div class="row">
	<div class="col-md-12 contentbox">
		<div class="header">
			<div>Organisatie Toevoegen</div>
			<div><span class="glyphicon glyphicon-ok"></span></div>
		</div>
		<form action="{{url('admin/create-organisation')}}" method="post">
			<table class="keyvaluetable">
				<tr><td>Naam Organisatie:</td><td><input type="text" class="form-control" placeholder="naam" name="org_name" required></td></tr>
				<tr><td>URL Organisatie:</td><td><input type="text" class="form-control" placeholder="url" name="org_url" required></td></tr>
				<tr><td></td><td><input type="submit" class="form-control" value="Aanmaken"></td></tr>
			</table>
		</form>
		
	</div>

</div>

<br>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
	    		Alle Organisaties:
	    </div>
    	<div class="panel-body">
			{{ $data_table }}
    	</div>
	</div>
</div>

<div class="row" style="display:none;" id="userEdit">
	<div class="col-md-12 contentbox">
		<div class="header">
			<div>Organisatie Accounts <span id="org-name"></span></div>
			<div><span class="glyphicon glyphicon-ok"></span></div>
		</div>
		<div id="organisations">
			<form>
				<select id="userlist">
				
				@foreach ($users as $user)
					<option value="{{$user->username}}">{{$user->username}}</option>
				@endforeach

				</select>
			</form>

		</div>
		
	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.editOrganisationUsers').click(function(event){
		event.preventDefault();
		$('#userEdit').slideUp();
		$('#org-name').text($(this).data('org-name'));
		$('#organisations').load('{{url("admin/organisation-user/9")}}')
		$('#userEdit').slideDown();

		$('html,body').delay(300).animate({
   			scrollTop: $("#userEdit").offset().top + 10
		});
		
	});
});
</script>


@stop