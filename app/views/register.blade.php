@extends('layout.base')

@section('content')
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
	      {{ Form::submit('Aanmelden', array('class'=>'btn btn-primary btn-lg btn-block')) }}
	      <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
	    </div>
	{{ Form::close() }}
@stop