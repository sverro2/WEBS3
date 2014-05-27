@extends('layout.base')

@section('content')
<div class="event-create">
	<div class="row eventrow" style="background-image:url( {{$organisation->banner}} )">
		<div class="col-sm-12 row-content">
			<div class="row bar-container">
			</div>
			<div class="row bottom-bar">
				<div class="col-sm-12">
					<h4> New event </h4>
					By {{ $organisation->name }}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">Facebook informatie</h3>
		  </div>
		  <div class="panel-body">
			<div class="input-group">
				<span class="input-group-addon">Facebook event-id</span>
				<input type="text" class="form-control" id="fb-event-id" placeholder="ID">
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

		<div class="panel panel-default create-event-info">
		  <div class="panel-heading">
			<h3 class="panel-title">Evenement informatie</h3>
		  </div>
		  <div class="panel-body">
			<div class="input-group input-group-lg">
				<span class="input-group-addon">Naam</span>
				<input type="text" class="form-control" placeholder="naam" id="event-name">
			</div>
			<br/>
			<div class="col-md-6 nopadding_left">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Start</span>
					<input class="datetimefield form-control" type="text" readonly="readonly" id="event-start">
				</div>
			</div>
			<div class="col-md-6 nopadding_right">
				<div class="input-group input-group-lg">
					<span class="input-group-addon">Eind</span>
					<input class="datetimefield form-control" type="text" readonly="readonly" id="event-end">
				</div>
			</div>
			<br/><br/><br/>
			<div class="input-group input-group-lg">
				<span class="input-group-addon">Locatie</span>
				<select class="form-control" id="event-location">
					@foreach($organisation->locations as $location)
						<option value={{$location->url}}>{{$location->name}}</option>
					@endforeach
				</select>
			</div>
			<br/>
			<textarea class="form-control" id="event-description"></textarea>
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
		  	<div id="addedrules">
		  	</div>
		  	<div class="row rulerow">
				<div class="col-md-5">
					<div class="input-group input-group-lg">
						<span class="input-group-addon">Regel</span>
						<input class="form-control rulecomplete" type="text" id="addRule">
					</div>
				</div>
				<div class="col-md-5">
					<div class="input-group input-group-lg">
						<span class="input-group-addon">Waarde</span>
						<input class="form-control valuecomplete" type="text" id="addVal">
					</div>
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-default btn-lg" id="addrulebtn">
					  <span class="glyphicon glyphicon-plus"></span>
					</button>
				</div>
			</div>
			@include('organisation.event.elements.autocomplete', $rules)
		  </div>
		</div>
	</div>
</div>

@stop