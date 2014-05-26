@extends('layout.base')

@section('content')
<div id="organisation">
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
			<h2>Control panel {{$organisation->name}}</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 contentbox">
			<div class="row">
				<h4>
					<div class="col-xs-10">Informatie </div>
					<div class="col-xs-2">
						<span class="glyphicon glyphicon-wrench"></span>
					</div>
				</h4>
			</div>
			<div class="row">
				<div class="col-sm-12">
					Naam: {{$organisation->name}}<br/>
					Facebook: {{$organisation->facebook}}<br/>
					Website: {{$organisation->website}}<br/>
					URL: {{$organisation->url}}<br/>
					@if(!is_null($organisation->defaultRules))
						Standaardreglement: {{($organisation->defaultRules->name)}}
					@else
						Standaardreglement: geen
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<h4>
					<div class="col-xs-12">Locaties </div>
				</h4>
			</div>
			@if(!is_null($organisation->locations))
				@foreach($organisation->locations as $location)
					@include('organisation.elements.locationrow', $location)
				@endforeach
			@else
				Geen locaties beschikbaar
			@endif
			<a href={{url('manage/create-event/' . $organisation->url)}}>
				<button type="button" class="btn">
						Nieuwe locatie maken
				</button>
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4>Mijn evenementen</h4>
			@foreach($organisation->events as $event)
				@include('organisation.event.elements.eventrow', $event)
			@endforeach
			<a href={{url('manage/create-event/' . $organisation->url)}}>
				<button type="button" class="btn">
						Nieuw evenement maken
				</button>
			</a>
		</div>
	</div>
</div>
@stop