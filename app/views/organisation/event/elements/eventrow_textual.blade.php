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
        {{$event->description}}
      </div>
    </div>
  </div>
</div>