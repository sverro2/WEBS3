<a href={{ url('organisation/event/' . $event->url) }} class="bannerlink">
<div class="row eventrow">
  <div class="bg-banner"></div>
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
        <div class="col-sm-9">
          <h4>{{ $name }}</h4>
          <span class="subtitle">
            </a>
            <a href= {{ url('organisation/index/' . $event->organisation->url) }} class="organisation-link">By {{ $event->organisation->name }}</a>
            <a href={{ url('organisation/event/' . $event->url) }} class="bannerlink">
          </span>
        </div>
        <div class="col-sm-3 right-bar hidden-xs">
          <h4>Bekijk details <span class="glyphicon glyphicon-chevron-right"></span></h4>
        </div>
      </div>
    </div>
</div>
</a>