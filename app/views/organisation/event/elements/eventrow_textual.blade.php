<div class="row eventrow_text">
  <div class="row">
    <div class="col-sm-12 row-content">
      <div class="row bar-container">
        <div class="col-xs-2 left-bar">
          <div class="dateday">
            <span class="date">{{ $event->getSimpleStartDay() }}</span><br/>
            <span class="day">{{ $event->getSimpleStartMonth()}}</span>
          </div>
        </div>
        <div class="col-xs-8">
          <div class="row">
            <div class="col-xs-12">
              <h3>{{ $name }}</h3>
              <span class="date">{{ $event->getSimpleStart() }}</span>, tot <span class="day">{{ $event->getSimpleEnd()}}</span>
            </div>
          </div >
          <div class="row">
            <div class="col-xs-12">
                <a href= {{ url('organisation/index/' . $event->organisation->url) }} class="organisation-link">By {{ $event->organisation->name }}</a>
              </span>
            </div>
          </div>  
        </div>
        <div class="col-xs-2 hidden-xs">
          <button type="button" class="btn btn-default">
            Details <span class="caret"></span>
          </button>
        </div>
        <div class="col-xs-2 visible-xs">
          <div class="mobile-arrow">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 row-details" style="display:none">
      <div class="details">
        <p>{{$event->description}}</p>
        <div class="row">
          <a href={{"#displaymap=" . $event->id}}>
          <div class="map col-md-6" data-location={{$event->location->id}} data-event={{$event->id}} data-latlng={{$event->location->coordinates}}>
            <img src={{ 'http://maps.googleapis.com/maps/api/staticmap?center=' . $event->location->coordinates . '&zoom=14&size=380x380&markers=' . $event->location->coordinates }} class="minimap"/>
          </div>
          </a>
          <div class="extra_details col-sm-6 col-md-3 borderright">
            <h3>Locatie</h3>
            {{ $event->location->name }}<br/>
            {{ $event->location->address }}
            <br/>
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
          <div class="extra_details col-sm-6 col-md-3">
            <h3>Maximum deelnemers</h3>
            @if(!is_null($event->max_participants))
              <h4>{{$event->max_participants}}</h4>
            @else
              <h4>Niet vermeld</h4>
            @endif
            <br/>

            <h3>Status</h3>
            @if($event->is_full)
            <h4>vol</h4>
            @else
            <h4>Open</h4>
            @endif
            <br/>

            <h3>Inschrijvingspagina</h3>
            @if(!is_null($event->signup_url))
              <h4><a href={{$event->signup_url}} target="_blank">Link</a></h4>
            @else
              <h4>Niet vermeld</h4>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>