<a href={{ url('organisation/event/' . $event->url) }} class="bannerlink">
<div class="row eventrow_text">
  <div class="row">
    <div class="col-sm-12 row-content">
      <div class="row bar-container">
        <div class="col-xs-2 left-bar">
          <div class="dateday">
            <span class="date">{{ $event->getSimpleStartDate() }}</span><br/>
            <span class="day">{{ $event->getDay()}}</span>
          </div>
        </div>
        <div class="col-xs-8 leftspacing">
          <div class="row">
            <div class="col-xs-12 leftspacing">
              <h3>{{ $name }}</h3>
              <span class="date">{{ $event->getSimpleStart() }}</span>, tot <span class="day">{{ $event->getSimpleEnd()}}</span>
            </div>
          </div >
          <div class="row">
            <div class="col-xs-12 leftspacing">
              <span class="subtitle">
                </a>
                <a href= {{ url('organisation/index/' . $event->organisation->url) }} class="organisation-link">By {{ $event->organisation->name }}</a>
                <a href={{ url('organisation/event/' . $event->url) }} class="bannerlink">
              </span>
            </div>
          </div>  
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
    <div class="col-sm-12 row-content">
    </div>
  </div>
</div>
</a>