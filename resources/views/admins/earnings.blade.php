Total earnings 19200100

<form action="/logout" method="POST" id="logout-form">
    {{csrf_field()}}
    <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit()" >Logout</a>
  </form>