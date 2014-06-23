<div class="row header" id="wrapper">

  <div class="col-md-3" id="title">
    <a href={{url('/')}}>
      <h1>AirCentral
      </h1>
      <p id="lead">
        @section('subtitle')
        Your airsoft resource
        @show
      </p>
    </a>
  </div>
  <div class="col-md-9" id="titleright">
    <div class="row">
      <div class="col-md-6">
        @yield('search')
      </div>
      <div class="col-md-2">
         @if (! is_null($user))
         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          </span> Welkom, {{ Session::get('user')->username }}</span>
        </button>
            <ul class="dropdown-menu">
              @if ($user->isAdmin())
                <li><a href={{ url('admin') }}>Administratie<span class="glyphicon glyphicon-wrench"></span></a></li>
                <li class="divider"></li>
              @endif
              @if ($user->organisations->count() > 0)
                @foreach($user->organisations as $organisation)
                  <li><a href={{ url('manage/organisation/' . $organisation->url) }}>{{ $organisation->name }}<span class="glyphicon glyphicon-cog"></span></a></li>
                @endforeach
              <li class="divider"></li>
              @endif
              <li><a href={{ url('account/logout') }}>Afmelden<span class="glyphicon glyphicon-off"></span></a></li>
            </ul>
          @else
           <button type="button" id="signin" class="btn btn-default navbar-btn">Sign in</button>
          @endif
      </div>
    </div>
  </div>
</div>