@extends('layout.base')

@section('content')

{{ Form::open(array('url' => 'manage/edit-event/' . $organisation->url . '/' . $event->id)) }}
<div class="event-create">

	<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Facebook informatie</h3>
		  </div>
		  <div class="panel-body">
			<div class="input-group">
				<span class="input-group-addon">Facebook event-id</span>
				{{ Form::text('fb-event-id', $event->fb_id, array('placeholder'=>'ID', 'class'=>'form-control', 'id'=>'fb-event-id')) }}
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="fb-event-submit">Opslaan</button>
				</span>
			</div>
			<br/>
			<div class="alert alert-info">
				Elk facebook evenement heeft een unieke id die in de adresbalk te zien is. 
				Door hier je facebook id in te vullen kunnen wij al veel gegevens over je evenement
				automatisch invullen, mits je facebook evenement publiekelijk beschikbaar is.
			</div>
		  </div>
		</div>
		{{ Form::hidden('organisation-id', $organisation->id) }}
		<div class="panel panel-default create-event-info">
		  <div class="panel-heading">
			<h3 class="panel-title">Evenement informatie</h3>
		  </div>
		  <div class="panel-body">
			<div class="input-group input-group-lg">
				<span class="input-group-addon">Naam</span>
				{{ Form::text('event-name', $event->name, array('placeholder'=>'Naam', 'class'=>'form-control', 'required'=>'', 'id'=>'event-name')) }}
			</div>
			<br/>
			<div class="col-md-6 nopadding_left">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Start</span>
				{{ Form::text('event-start', $event->start, array('class'=>'datetimefield form-control', 'required'=>'', 'id'=>'event-start')) }}
				</div>
			</div>
			<div class="col-md-6 nopadding_right">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Eind</span>
					{{ Form::text('event-end', $event->end, array('class'=>'datetimefield form-control', 'required'=>'', 'id'=>'event-end')) }}
				</div>
			</div>
			<br/><br/><br/>
			<div class="input-group input-group-lg">
				<span class="input-group-addon">Locatie</span>
				<?php
					$select_locations = array();
					foreach($organisation->locations as $location)
					{
						$select_locations[$location->id] = $location->name;
					}
				?>
				{{ Form::select('event-location', $select_locations, $event->location->name, array('class'=>'form-control')) }}
			</div>
			<br/>
			<div class="input-group input-group-lg">
				<span class="input-group-addon">Maximum aantal deelnemers</span>
			{{ Form::text('event-participants', $event->max_participants, array('class'=>'form-control', 'required'=>'', 'id'=>'event-participants')) }}
		      <span class="input-group-addon">
		        vol: {{ Form::checkbox('event-full', null, $event->is_full)}}
		      </span>
			</div>
			<br/>
	  		{{ Form::textarea('event-description' , $event->description, array("class"=>"form-control", "id"=>"event-description")) }}
			<div class="alert alert-info">
				Schrijf hier een korte omschrijving van je evenement. Dit veld gebruiken om het reglement toe te lichten wordt afgeraden.
			</div>
		  </div>
		</div>


		<div class="panel panel-default create-event-info">
		  <div class="panel-heading">
			<h3 class="panel-title">Reglement</h3>
		  </div>
		  <div class="panel-body" id="rulepanel">
	  		{{ Form::textarea('event-rules', $event->ruleset->rules, array("class"=>"form-control", "id"=>"event-rules")) }}
			<div class="alert alert-info">
				In dit veld wordt het standaardreglement van je organisatie automatisch ingeladen.
				Alle aanpassingen die je maakt in dit veld worden wel voor dit evenement opgeslagen.
			</div>
		  </div>
		</div>
		{{ Form::submit('Evenement opslaan', array('class'=>'btn btn-primary btn-lg btn-block')) }}
		{{ Form::close() }}
	</div>
</div>

@stop