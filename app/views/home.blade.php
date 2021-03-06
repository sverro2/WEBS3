@extends('layout.base')
@section('map')
	@include('layout.elements.map')
@stop

@section('search')
    <div class="input-group input-group">
       <input type="text" class="form-control" placeholder="Zoek" id="searchfield">
          <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
    </div>
@stop

@section('bodycontent')
    <div id="yt" data-url="{{ @$ytURL->value }}"></div>
    <div id="raster"></div>
@stop

@section('content')
	@foreach($events as $event)
		@include('organisation.event.elements.eventrow_textual', $event)
	@endforeach
	<div class="eventrow_text" id="divloading">
		<div class="row">
			<div class="col-sm-2 left-bar centered">
				<div class="borderright">
					<h1><span class="glyphicon glyphicon-repeat" id="refresh_rotate"></span></h1>
				</div>
			</div>
			<div class="col-sm-10 hidden-xs">
				<h1 id="text">Scroll naar beneden om meer events te laden</h1>
			</div>
		</div>
	</div>
@stop