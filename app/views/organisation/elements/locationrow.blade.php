<a href={{ url('organisation/location/' . $location->url) }} class="bannerlink">
  <div class="row eventrow" style="background-image:url( {{$location->banner}} )">
    <div class="col-sm-12 row-content">
        <div class="row bar-container">
          </div>
      <div class="row bottom-bar">
        <div class="col-sm-12">
          <h4>{{ $location->name }}</h4>
        </div>
      </div>
    </div>
  </div>
</a>