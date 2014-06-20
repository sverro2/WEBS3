function fb_process(fb_id)
{
	$.get("../../organisation/facebook-event", {id : fb_id}, function( data ) {
		var vis = data.visible;
		if(vis)
		{
			console.log(data);
			var name = data.name;
			var start_time = fb_parseDT(data.start_time);
			var end_time = fb_parseDT(data.end_time);
			var description = data.description;
	 		$('#event-name').val(name);
	 		$('#event-start').val(start_time);
	 		$('#event-end').val(end_time);
	 		$('#event-description').val(description);

			var location = data.location;
			$('#event-location > option').each(function(){
					console.log($(this).html().toLowerCase());
					console.log(location.toLowerCase());
				if(location.toLowerCase() == $(this).html().toLowerCase()){
					console.log('match');
					$('#event-location').val($(this).val());
				}

			});
		}else{
			alert("Je evenement kon niet uitgelezen worden, check alstublieft of het evenement wel openbaar is, en of de id wel correct is.");
		}
	});
}

function fb_parseDT(datetime)
{
	var timeRegExp = /T(\d{2}:){2}\d{2}\+\d{4}$/;
	var dateRegExp = /^\d{4}-\d{2}-\d{2}T/;
	var timeZoneRegExp = /:\d{2}\+\d{4}/;
	var date = datetime.replace(timeRegExp,'');
	var time = datetime.replace(dateRegExp,'');
	var time = time.replace(timeZoneRegExp,'');

	return date + " " + time;

}

function event_open(id)
{
	var parent = $('#' + id).show();
    var child = parent.find('.row-details');
    child.show();
    $('html, body').animate({
        scrollTop: parent.offset().top
    });
}