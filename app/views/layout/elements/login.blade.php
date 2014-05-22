<!--login modal-->
<div id="loginModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close closeform" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Login</h1>
      </div>
      <div class="modal-body">
          {{ Form::open(array('url' => 'account/login', 'class'=>'form col-md-12 center-block')) }}
            <div class="form-group">
              {{ Form::text('username', null, array('placeholder'=>'Gebruikersnaam', 'class'=>'form-control input-lg', 'required'=>'')) }}
            </div>
            <div class="form-group">
              {{ Form::password('password', array('placeholder' => 'Wachtwoord', 'class'=>'form-control input-lg', 'required'=>'')) }}
            </div>
            <div class="form-group">
              {{ Form::submit('Aanmelden', array('class'=>'btn btn-primary btn-lg btn-block')) }}
              <span class="pull-right"><a href={{ url('account/register') }}>Register</a></span><span><a href="#">Need help?</a></span>
            </div>
          {{ Form::close() }}
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn closeform" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>