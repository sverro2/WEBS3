var map;
var userpos;
var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
var directionsService = new google.maps.DirectionsService();
var rendererOptions = {
  draggable: true
};


/*---------------------------MAP MOVEMENT-----------------------------*/
function movement_openmap(minimap){
	var latlng = latlng_convert(minimap.data('latlng'));
	var event_id = minimap.data('event');
	load_mapoverlay_location(event_id);
	$('.slideleft').hide('slide',function(){
	  $('#map-wrapper').show('slide', {direction: 'right'}, function(){
	    //map.setCenter(latlng);
	    //map.setZoom(16);
	    google.maps.event.trigger(map, 'resize');
		calcRoute(latlng);
	  });
	});
}

function movement_closemap(){
	$('#map-wrapper').hide('slide', {direction: 'right'},function(){
	  $('.slideleft').show('slide');
	});
}

/*---------------------------MAP CREATION-----------------------------*/
function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 8
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

		  directionsDisplay.setMap(map);
		  directionsDisplay.setPanel(document.getElementById("directionsPanel"));

		  google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
		    computeTotalDistance(directionsDisplay.directions);
		  });

        loadMarkers();
        getClientPos();
}
google.maps.event.addDomListener(window, 'load', initialize);

/*---------------------------MAP POPULATION-----------------------------*/
function loadMarkers(){
	$.get('index.php/organisation/all-locations', function(response){
		for(i = 0; i < response.length; i++)
		{
			var location = response[i];
			console.log(location);
			var marker = new google.maps.Marker({
				position: latlng_convert(location.coordinates),
				map: map,
				title: 'location.name'
    		});
		}
	});
}

function load_mapoverlay_location(event){
	$('#sidebar-content').load('index.php/organisation/event-overlay/' + event);
}

function latlng_convert(latlng){
	var lat = latlng.replace(/\s*\,.*/, ''); // first 123
    var lng = latlng.replace(/.*,\s*/, ''); // second ,456
    return new google.maps.LatLng(lat, lng);
}

function getClientPos(){
	var loc = {};
    var geocoder = new google.maps.Geocoder();
    if(google.loader.ClientLocation) {
        loc.lat = google.loader.ClientLocation.latitude;
        loc.lng = google.loader.ClientLocation.longitude;

        var latlng = new google.maps.LatLng(loc.lat, loc.lng);
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
                userpos = latlng;
            };
        });
    }
}

/*---------------------------NAVIGATION-----------------------------*/
function calcRoute(destination) {

  var request = {
    origin: userpos,
    destination: destination,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
centerRoute(destination);
}

function computeTotalDistance(result) {
  var total = 0;
  var myroute = result.routes[0];
  for (i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }
  total = total / 1000.
  document.getElementById("total").innerHTML = total + " km";
}

function centerRoute(latlng){
	var latlngbounds = new google.maps.LatLngBounds();
   	latlngbounds.extend(latlng);
   	latlngbounds.extend(userpos);
	map.setCenter(latlngbounds.getCenter());
	map.fitBounds(latlngbounds); 
}