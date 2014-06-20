@extends('admin.home')

@section('admincontent')
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Alle Evenementen:
		</div>
		<div class="panel-body">
			{{ $data_table }}
		</div>
	</div>
</div>
@stop