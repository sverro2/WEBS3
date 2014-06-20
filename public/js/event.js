function fb_process(fb_id)
{
	var url = '/organisation/facebook-event'; 
	$.get(url, {id : fb_id}, function( data ) {
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

function fb_load(element, fb_id)
{
	$.get("/organisation/facebook-event", {id : fb_id}, function( data ) {
		var vis = data.visible;
		if(vis)
		{
			var details = element.find('.extra_details:first');
			var text = '<h3>Facebook</h3>'                    
            +'    <a href="https://www.facebook.com/events/' +  fb_id + '" title="Event facebook" target="_blank">'
            +'      <img src="assets/social/facebook_16.png" alt="Facebook icon" />'
            +'      <span class="site">Evenement pagina</span>'
            +'    </a>'
            +'  <br/>'
            +'  Gaat: ' + data.attending
            +'   Misschien: ' + data.maybe
            +'   Uitgenodigd: ' + data.invited;
			details.append(text);
			element.data('fb_loaded', 'true');
		}
	});
	element.data('fb_loaded', "true");
}

function event_open(id)
{
	var parent = $('#' + id).show();
	if(parent.length == 0){return;}
    var child = parent.find('.row-details');
    child.show();
    $('html, body').animate({
        scrollTop: parent.offset().top
    });
}

function event_display(start, stop)
{	
	loading = true;
	$('#refresh_rotate').addClass('spinning');
	$("#divloading #text").html('Meer events worden geladen');
	$.get("/home/events", {first : (nEvents + 1), count: 8}, function( events ) {
		$('#refresh_rotate').removeClass('spinning');
		$(events).insertBefore("#divloading");
		nEvents +=8;
		loading = false;
		$("#divloading #text").html('Scroll naar beneden om meer events te laden');
	});
	$('.eventrow_text').each(function(){
          var fb_id = $(this).data('fb_id');
          var loaded = $(this).data('fb_loaded');
          console.log(loaded);
          if(loaded != "true"){
        	  fb_load($(this), fb_id);
  			}
      });
}