@extends('layout.base')

@section('content')

<div id="location" data-orgurl="{{$organisation_url}}" data-locid="{{@$location_id}}" data-latlng="{{@$location->coordinates}}">

    <div class="row">
        <div class="col-sm-12">
            <h2>Locatie {{ $ruleset->name or "Aanmaken" }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 contentbox">
            <div class="header">
                <div>Kaart</div>
                <div><a href="{{url('/manage/organisation/' . $organisation_url)}}"><span class="glyphicon glyphicon-remove" id="save_organisation_info"> Annuleren</span></a></div>
            </div>
            <table class="keyvaluetable">
                <form action="{{ url('manage/save-location/' . $organisation_url)}}" method="post">
                    <tr>
                        <td>Naam van locatie:</td>
                        <td><input type="text" id="locationNameInput" name="name" placeholder="Naam" value="{{@$location->name}}" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Adres:</td>
                        <td><input type="text" id="locationAdressInput" name="adress" placeholder="Adres" value="{{@$location->address}}" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>URL:</td>
                        <td><input type="text" id="locationUrlInput" name="url" placeholder="Url" value="{{@$location->url}}" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" id="locationIdInput" name="location_id" value="{{@$location_id}}" class="form-control">
                            <input type="hidden" id="locationLatInput" name="lat" value="" class="form-control" required>
                            <input type="hidden" id="locationLonInput" name="lng" value="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="input-group clickon">
                                <input type="submit" style="visibility:hidden;" class="btn btn-default right" id="saveLocationInfo" type="button" value="Locatie Opslaan">  
                            </div>
                            <br>
                        </td>

                    </tr>
                </form>
                <tr>
                    <td>Zoek locatie op kaart:</td>
                    <td>
                        <div class="input-group clickon">
                            <input type="text" id="locationInput" placeholder="Plaats, adres" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="adress_submit" type="button"><span class="glyphicon glyphicon-home"></span></button>
                            </span>
                        </div>
                    </td>              
                </tr>
            </table>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Klik op de kaart om het punt aan te geven waar evenement(en) worden georganiseerd.
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div id="map_canvas"></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

<style>
#map_canvas {
    width: 100%;
    height: 600px;
}

.right{
    margin-left: 20px;
}
</style>

<script type="text/javascript">
var latLngNetherlands = {'latN':52.5, 'latO':5.75};
var map, geocoder;
var marker;
var zoom = 7;

// Function for adding a marker to the page.

$(document).ready(function(){
    initialize();
    //start search in google maps
    $('#gotoButton').click(function(){
        search();
    });

    //start search when pressing enter
    $('#locationInput').keypress(function(e){
        if(e.which == 13) {
            search();
        }
    });

    //go to the location of the current event and show the pin
    var currentLocation = $('#location').data('latlng');

    if(currentLocation != ""){
        currentLocation = currentLocation.split(',');
        console.log(currentLocation[0]);
        var myLatlng = new google.maps.LatLng(currentLocation[0], currentLocation[1]);
        goTo(myLatlng);
        addMarker(myLatlng);
    }

    $('#deleteLocation').click(function(){
        if(confirm('Weet je zeker dat deze locatie moet worden verwijderd?')){
            //verwijder locatie
        }
    });


});

function initialize() {
    var map_canvas = document.getElementById('map_canvas');
    var myLatlng = new google.maps.LatLng(latLngNetherlands['latN'], latLngNetherlands['latO']);
    geocoder = new google.maps.Geocoder();
    
    var mapOptions = {
        center: myLatlng,
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };
    map = new google.maps.Map(map_canvas, mapOptions);
    google.maps.event.addListener(map, 'click', function(event){
        addMarker(event.latLng);
    });

}

function search(){
    var address = $('#locationInput').val();
    geocoder.geocode({'address' : address}, function(results, status){
        if(status == "OK"){
            goTo(results[0].geometry.location);
        }else{
            alert("Locatie niet gevonden!");
        }
    });
}

function goTo(latLong, zoomLvl){
    zoomLvl = typeof zoomLvl !== 'undefined' ? zoomLvl : 13;
    map.panTo(latLong);
    map.setZoom(zoomLvl);
}

function addMarker(location) {
    if(marker){
        marker.setMap(null);   
    }
    marker = new google.maps.Marker({
        position: location,
        map: map
    });
    $('#locationLatInput').val(marker.getPosition().lat());
    $('#locationLonInput').val(marker.getPosition().lng());
    $('#saveLocationInfo').css('visibility', 'visible');
   
}


</script>


@stop