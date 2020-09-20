<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  @if(Sentinel::check())
  <a class="navbar-brand" href="#">Welcome {{ Sentinel::getUser()->first_name}}</a>
  @else
  <a class="navbar-brand" href="#">Authentication</a>
  @endif
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        @if(Sentinel::check())
        <li class="nav-item">
          <form action="/logout" method="POST" id="logout-form">
            {{csrf_field()}}
            <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit()" >Logout</a>
          </form>
          
        </li>
        @else
        <li class="nav-item ">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>