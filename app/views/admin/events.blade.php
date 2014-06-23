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

<script type="text/javascript">
	$(document).ready(function(){
		$('.removeEvent').click(function(event){
			var orgUrl = $(this).data('org-url');
			var clicked = $(this);
			event.preventDefault();
			if(confirm("Weet je zeker dat je dit evenement wil verwijderen?")){
				var eventId = $(this).data('eventid');
				
				$.post(orgUrl, {event_id: eventId}).done(function(status){
					if(status == 'done'){
						clicked.closest('tr').hide();
					}else{
						alert('Het evenement is niet verwijdert wegens een onbekende fout :-/');
					}
				});
			}

		});
	});

</script>
@stop