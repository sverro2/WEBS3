<div class="row eventrow" style="background-image:url( {{ $banner }} )">

    <div class="col-md-9 left-row">
      <div class="row bar-container">
        <div class="col-md-3 left-bar">
          <div class="dateday">
            <span class="date">{{ $event->getSimpleStartDate() }}</span><br/>
            <span class="day">{{ $event->getDay()}}</span>
          </div>
        </div>
        <div class="col-md-9"></div>
      </div>
      <div class="row bottom-bar">
        <h4>{{ $name }}</h4>
        <span class="subtitle">By {{ $event->getOrganisationName() }}</span>
      </div>
    </div>
    <div class="col-md-3 right-bar">
      <div class="row bar-container"></div>
      <div class="row bottom-bar">
        <h4>Bekijk details <span class="glyphicon glyphicon-chevron-right"></span></h4>
      </div>
    </div>
    <!--
    <br>
    <div class="col-md-2 col-sm-3 text-center">
      <a class="story-img" href="#"><img src="//placehold.it/100" style="width:100px;height:100px" class="img-circle"></a>
    </div>
    <div class="col-md-10 col-sm-9">
      <h3>{{ $name }}</h3>
      <div class="row">
        <div class="col-xs-9">
          <p>{{ $description }}</p>
          <p class="lead"><button class="btn btn-default">Details</button></p>
          <p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>
          <ul class="list-inline"><li><a href="#">2 Days Ago</a></li><li><a href="#"><i class="glyphicon glyphicon-comment"></i> 4 Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 34 Shares</a></li></ul>
          </div>
        <div class="col-xs-3"></div>
      </div>
      <br><br>
    </div>
  </div>
  <hr>
  -->
</div>