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


		//TODO gegevens doorsturen via AJAX
		console.log(input);

		$.post('{{url("manage/update-organisation-info")}}', input, function(status){

			if(status !== "succes"){
				alert("Changes are not saved! An error occured...")
			}
		});

		
	});
});

</script>

<div id="organisation" data-id="{{ $organisation->id }}">
	<div class="row eventrow" id="banner" style="background-image:url( {{$organisation->banner}} )">
		<div class="col-sm-12 row-content">
		    <div class="row bar-container">
	      	</div>
			<div class="row bottom-bar">
				<div class="col-sm-12">
		 	 		<h4>{{ $organisation->name }}</h4>
				</div>
			</div>
		</div>
	</div>
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
				<div><a href={{url('manage/create-event/' . $organisation->url)}}><span class="glyphicon glyphicon-plus"></a></span></div>
			</div>
			@if(!is_null($organisation->locations))
				@foreach($organisation->locations as $location)
					@include('organisation.elements.locationrow', $location)
				@endforeach
			@else
				Geen locaties beschikbaar
			@endif
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 contentbox">
			<div class="header">
				<div>Mijn evenementen</div>
				<div><a href={{url('manage/create-event/' . $organisation->url)}}><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
			<?php 
				$event_table_content = array(
					"Event" => "{name}",
					"Start" => "{getSimpleStartDate()}, {getDay()}",
					"Vol?" => "{is_full},,0=>Plaatsen Vrij|1=>Vol",
					"Toon" => "<span class='glyphicon glyphicon-search'></span>,#!/#displaymap={id}",
					"Bewerk" => "<span class='glyphicon glyphicon-wrench'></span>,#!manage/edit-event/{url}",
					"Remove" => "<span class='glyphicon glyphicon-remove event' data-eventid='{id}'>,#</span>"
				);

				echo DataTable::create_data_table($organisation->events, $event_table_content, "event_table");
			?>
		</div>
	</div>
</div>
@stop