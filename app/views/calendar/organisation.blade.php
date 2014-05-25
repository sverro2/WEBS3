@extends('layout.base')

@section('title') @stop

@section('content')
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
@stop