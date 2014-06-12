<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<a href="#" class="closemap">
					<span class="glyphicon glyphicon-chevron-left backbutton clickon"></span>
				</a>
				<h1>{{$event->location->name}}</h1>
				{{ $event->location->name }}<br/>
            	{{ $event->location->address }}<br/>
            	Geschatte afstand: <span id="estimatedDist"></span><br/>
            	<div class="alert alert-info">De schatting van de afstand is gebaseerd op een schatting van jouw locatie gemaakt door Google, hierdoor kan de afstand soms verschillen van de echte afstand. Het wordt aangeraden na te kijken of uw locatie klopt, en wanneer nodig hem aan te passen.</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1>{{$event->name}}</h1>
			</div>
		</div>
		<div class="row">
		  <div class="extra_details col-sm-6 borderright">
		    <h3>Maximum deelnemers</h3>
		    @if(!is_null($event->max_participants))
		      <h4>{{$event->max_participants}}</h4>
		    @else
		      <h4>Niet vermeld</h4>
		    @endif

		    <h3>Status</h3>
		    @if($event->is_full)
		    <h4>vol</h4>
		    @else
		    <h4>Open</h4>
		    @endif

		    <h3>Inschrijvingspagina</h3>
		    @if(!is_null($event->signup_url))
		      <h4><a href={{$event->signup_url}} target="_blank">Link</a></h4>
		    @else
		      <h4>Niet vermeld</h4>
		    @endif
		  </div>
		  <div class="extra_details col-sm-6">
		    <h3>Start</h3>
		    <h4>{{$event->getSimpleStart()}}</h4>
		    <h3>Eind</h3>
		    <h4>{{$event->getSimpleEnd()}}</h4>
		    @if(!is_null($event->fb_id))
		      <h3>Facebook</h3>                    
		        <a href={{'https://www.facebook.com/events/' . $event->fb_id}} title="Event facebook" target="_blank">
		          <img src="assets/social/facebook_16.png" alt="Facebook icon" />
		          <span class="site">Evenement pagina</span>
		        </a>
		    @endif
		    @if($event->fb_visible())
		      <br/>
		      Gaat: {{ $event->fb_event()->attending() }}
		       Misschien: {{ $event->fb_event()->maybe() }}
		       Uitgenodigd: {{ $event->fb_event()->invited() }}
		    @endif
		  </div>
		</div>
	</div>
</div>