@extends('layout.base')

@section('content')

	<div class="row eventrow" style="background-image:url( {{$organisation->banner}} )">
		<div class="col-sm-12 row-content">
		    <div class="row bar-container">
	      	</div>
			<div class="row bottom-bar">
				<div class="col-sm-12">
		 	 		<h4> New event </h4>
		 	 		By {{ $organisation->name }}
				</div>
			</div>
		</div>
	</div>

	{{ Form::open(array('url' => 'account/register', 'class'=>'form col-md-12 center-block')) }}
	    <div class="form-group">
	      {{ Form::text('username', null, array('placeholder'=>'Gebruikersnaam', 'class'=>'form-control input-lg', 'required'=>'')) }}
	    </div>
	    <div class="form-group">
	      {{ Form::password('password', array('placeholder' => 'Wachtwoord', 'class'=>'form-control input-lg', 'required'=>'')) }}
	    </div>
	    <div class="form-group">
	      {{ Form::password('passwordconfirm', array('placeholder' => 'Wachtwoord bevestigen', 'class'=>'form-control input-lg', 'required'=>'')) }}
	    </div>
	    <div class="form-group">
	      {{ Form::submit('Registreren', array('class'=>'btn btn-primary btn-lg btn-block')) }}
		<span class="pull-right"><a href={{ url('account/login') }}>Ik heb al een account</a></span>
	    </div>
	{{ Form::close() }}

@stop