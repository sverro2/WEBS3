@extends('layout.base')

@section('content')

<script type="text/javascript">

$(document).ready(function(){
	$('#organisation').on('click', '#edit_organisation_info.glyphicon-wrench', function(event){
		event.preventDefault();
		$(this).removeClass('glyphicon-wrench');
		$(this).addClass('glyphicon-ok');
		$(this).id = 'apply_organisation_info';

		
		$('.organisation_info_edit').each(function(){
			var currentSpan = $(this).children('span');
			var textOfField = currentSpan.text();
			currentSpan.replaceWith('<input type="text" value="' + textOfField + '">');

		});

	});

	$('#organisation').on('click', '#edit_organisation_info.glyphicon-ok', function(event){
		event.preventDefault();
		$(this).removeClass('glyphicon-ok');
		$(this).addClass('glyphicon-wrench');

		var input = {};
		
		$('.organisation_info_edit').each(function(){
			var currentInput = $(this).children('input');
			var textOfField = currentInput.val();
			input[$(this)[0].id] = textOfField;
			currentInput.replaceWith('<span>' + textOfField + '</span>');

		});

		//add id
		input['id'] = $('#organisation').data('id');

		$.post('{{url("manage/update-organisation-info")}}', input, function(status){

			if(status !== "succes"){
				alert("Changes are not saved! An error occured...")
			}
		});



		
	});

	$('#organisation').on('click', '.removeLocation', function(event){
		event.preventDefault();
		alert("clicked location" + $(this).data('locationid'));
	});

	$('#organisation').on('click', '.removeEvent', function(event){
		event.preventDefault();
		alert("clicked evnent" + $(this).data('eventid'));

	});


});

</script>

<div id="organisation" data-id="{{ $organisation->id }}">

	<div class="row">
		<div class="col-sm-12">
			<h2>Control panel {{ $organisation->name }}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 contentbox">

			<div class="row">
				<div class="col-sm-12">
					<div class="header">
						<div>Informatie</div>
						<div><a href="#"><span class="glyphicon glyphicon-wrench" id="edit_organisation_info"></span></a></div>
					</div>
					<table class="keyvaluetable">
						<tr><td>Naam:</td><td id="orgname_edit" class="organisation_info_edit"><span>{{$organisation->name}}</span></td></tr>
						<tr><td>Facebook:</td><td id="facebook_edit" class="organisation_info_edit"><span>{{$organisation->facebook}}</span></td></tr>
						<tr><td>Website:</td><td id="website_edit" class="organisation_info_edit"><span>{{$organisation->website}}</span></td></tr>
						<tr><td>URL:</td><td id="url_edit" class="organisation_info_edit"><span>{{$organisation->url}}</span></td></tr>
						<tr><td>Standaardreglement:</td>
						
						@if(!is_null($organisation->defaultRules))
							<td id="ruleset_edit" class="organisation_info_edit"><span>{{($organisation->defaultRules->name)}}</span></td>
						@else
							<td id="ruleset_edit" class="organisation_info_edit"><span>geen</span></td>
						@endif
						
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 contentbox">
			<div class="header">
				<div>Locaties</div>
				<div><a href="{{ url ('manage/create-location/' . $organisation->id)}}"><span class="glyphicon glyphicon-plus" id="addLocation"></span></a></div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-list"></span>
				</div>
				<div class="panel-body">
				<?php 
				$event_table_content = array(
					"Event" => "{name}",
					"Adres" => "{address}",
					"Edit" => "<span class='glyphicon glyphicon-wrench'></span>,#!manage/create-location/$organisation->id/{id}",
					"Remove" => "<a href='#' class='removeLocation' data-locationid='{id}'><span class='glyphicon glyphicon-remove'></span></a>"
				);

				echo DataTable::create_data_table($organisation->locations, $event_table_content, "location_table");
				?>
				</div>
			</div>

			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 contentbox">
			<div class="header">
				<div>Mijn evenementen</div>
				<div><a href="{{url('manage/create-event/' . $organisation->url)}}"><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-list"></span>
				</div>
				<div class="panel-body">
				<?php 
				$event_table_content = array(
					"Event" => "{name}",
					"Start" => "{getSimpleStartDate()}, {getDay()}",
					"Vol?" => "{is_full},,0=>Plaatsen Vrij|1=>Vol",
					"Toon" => "<span class='glyphicon glyphicon-search'></span>,#!/#displaymap={id}",
					"Bewerk" => "<span class='glyphicon glyphicon-wrench'></span>,#!manage/create-event/{id}",
					"Remove" => "<a href='#' class='removeEvent' data-eventid='{id}'><span class='glyphicon glyphicon-remove'></span></a>"
				);

				echo DataTable::create_data_table($organisation->events, $event_table_content, "event_table");
				?>
				</div>
			</div>
			
		</div>

	</div>

	<div id="locationeditor">
		<div>
			<span class="glyphicon glyphicon-remove close2"></span>
			<div class="row">
				<div class="col-sm-12">
					<h2>Edit Location</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					simple text
				</div>
			</div>
		</div>
	</div>
</div>
@stop