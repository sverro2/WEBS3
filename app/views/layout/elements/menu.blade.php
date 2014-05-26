<header class="navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href= {{ url('/') }} class="navbar-brand">Aircentral</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="#">Category</a>
        </li>
        <li>
          <a href="#">Category</a>
        </li>
        <li>
          <a href="#">Category</a>
        </li>
        <li>
          <a href="#">Category</a>
        </li>
      </ul>
      <ul class="nav navbar-right navbar-nav">
      	<li class="dropdown">
          @if (! is_null($user))
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-cog"></span> Welkom, {{ Session::get('user')->username }} </a>
            <ul class="dropdown-menu">
              <li class="divider"></li>
              @if ($user->isAdmin())
                <li><a href={{ url('admin') }}>Administratie<span class="glyphicon glyphicon-wrench"></span></a></li>
                <li class="divider"></li>
              @endif
              @if ($user->organisations->count() > 0)
                <li class="divider"></li>
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
      	</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-search"></i></a>
          <ul class="dropdown-menu" style="padding:12px;">
            <form class="form-inline">
              <button type="submit" class="btn btn-default pull-right"><i class="glyphicon glyphicon-search"></i></button><input type="text" class="form-control pull-left" placeholder="Search">
            </form>
          </ul>
        </li>
      </ul>
    </nav>

  </div>
</header>