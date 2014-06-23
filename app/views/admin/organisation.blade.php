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
				<div class="input-group clickon">
				<input type="text" list="userlist" class="form-control" id="organisationuser_select">
				<datalist id="userlist">
				@foreach ($users as $user)
					<option value="{{$user->username}}">
				@endforeach

				</datalist>
				<div class="input-group-btn">
					<input type="button" class="btn btn-default" value="Toevoegen" id="applyAccounts">
				</div>
			</div>


		</div>

	</div>

</div>

<script type="text/javascript">
var selectedOrganisation;
$(document).ready(function(){
	$('.editOrganisationUsers').click(function(event){
		var selectedOrganisationName = $(this).data('org-name');
		selectedOrganisation = $(this).data('org-id');

		event.preventDefault();
		$('#userEdit').slideUp();
		$('#org-name').text(selectedOrganisationName);
		//$('#organisations').load('{{url("admin/organisation-user/9")}}')
		$('#userEdit').slideDown();

		$('html,body').delay(300).animate({
   			scrollTop: $("#userEdit").offset().top + 10
		});

	});

	$('#applyAccounts').click(function(){
		var selectedUser = $('#organisationuser_select').val();
		$.post("{{url('admin/apply-account')}}", {user: selectedUser, organisation:selectedOrganisation}).done(function(status){
			alert(status);
		});
	});


});
</script>


@stop