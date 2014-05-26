@extends('layout.base')

@section('content')
<div class="row eventrow" id="banner" style="background-image:url( {{$event->banner}} )">
	<div class="col-sm-12 row-content">
      <div class="row bar-container">
        <div class="col-xs-10 left-bar">
          <div class="dateday">
            <span class="date">{{ $event->getSimpleStartDate() }}</span><br/>
            <span class="day">{{ $event->getDay()}}</span>
          </div>
        </div>
        <div class="col-xs-2 visible-xs">
          <div class="mobile-arrow">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </div>
        </div>
      </div>
      <div class="row bottom-bar">
        <div class="col-sm-6">
          <h4>{{ $event->name }}</h4>
          <span class="subtitle">
            </a>
            <a href= {{ url('organisation/index/' . $event->organisation->url) }} class="organisation-link">By {{ $event->organisation->name }}</a>
          </span>
        </div>
        @if($event->fb_visible())
	        <div class="col-sm-2 hidden-xs">
	        	<h4>{{$event->fb_event()->attending()}}</h4>
	        	Gaan
	        </div>
	        <div class="col-sm-2 hidden-xs">
	        	<h4>{{$event->fb_event()->maybe()}}</h4>
	        	Misschien
	        </div>
	        <div class="col-sm-2 hidden-xs">
	        	<h4>{{$event->fb_event()->invited()}}</h4>
	        	Uitgenodigd
	        </div>
        @endif
      </div>
    </div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{$event->name}}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<p>
					<h4>Informatie:</h4>
					Begin: {{ $event->getSimpleStart() }}<br/>
					Eind: {{ $event->getSimpleEnd() }}<br/>
					Locatie: {{ $event->location->name }}<br/>
				</p>
				<p>
					Type: {{ $event->type->type }}<br/>
					@if(!is_null($event->signup_url))
						Inschrijven: <a href={{ url($event->signup_url) }}> inschrijfpagina </a><br/>
					@endif
				</p>

			</div>
			<div class="col-sm-5">
				<p>
					<h4>Regels:</h4>
					@foreach($event->ruleSet->rules as $rule)
						{{ $rule->rule }} : {{ $rule->value }} 
							@if(!is_null($rule->description))
								<span class="glyphicon glyphicon-comment"></span>
							@endif
						<br/>
					@endforeach
				</p>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<p>{{ $event->description }}</p>
	</div>
</div>

@stop