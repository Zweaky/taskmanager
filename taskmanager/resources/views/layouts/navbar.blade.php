<nav class="navbar navbar-default">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="pull-left" style="padding-top:10px;padding-left: 5px;">
        <i class="material-icons" class="pull-left">assessment</i>
      </div>
      <a class="navbar-brand" href="/">
        {{ config('app.name', 'Laravel') }}
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li {{ setActive('/') }}><a href="/">Home</a></li>
        <li {{ setActive('features') }}><a href="/features">Features</a></li>
        <li {{ setActive('faq') }}><a href="/faq">Faq</a></li>
      </ul>
      
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input id="edit_search" type="text" class="form-control" placeholder="Search teams and users">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
        <li {{ setActive('login') }}><a href="/login">Login</a></li>
        <li {{ setActive('register') }}><a href="/register">Register</a></li>
        @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li {{ setActive('task') }}><a href="/task">Tasks <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
            <li {{ setActive('teams') }}><a href="/teams" style="color:red;">Teams (<span class="badge" style="background-color: red;">To do</span>)</a></li>
            <li role="separator" class="divider"></li>
            <li {{ setActive('home') }}><a href="/home">Profile<span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
            <li role="separator" class="divider"></li>
            <li {{ setActive('logout') }}><a href="/logout">Logout <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>