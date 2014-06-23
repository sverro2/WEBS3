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


@stop