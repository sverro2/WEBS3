function livesearch()
{
	var value = $('#searchfield').val();
	console.log('val = ' + value);
	$('.eventrow_text').each(function(){
		var row = $(this);
		var hasVal = false;
		var searchString = 'div:contains(' + value + ')';
		row.children(searchString).each(function(){hasVal = true;});
		if(!hasVal){
				row.hide("slide",{axis:'x'});
		}else{			
				row.show("slide");
		}
	});
}