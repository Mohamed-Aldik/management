
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">



    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


    @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Log out</a>
                    <form id="logout-form" method="POST" action="{{route('logout')}}">
                        @csrf
                    </form>
                  </li>
                     @else

      
                     <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('register')}}" class="nav-link">Register</a>
      </li>
      <li class="nav-item">
        <a href="{{route('login')}}" class="nav-link">Login</a>
      </li>
            @endauth
            @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>     
    </ul>
  </nav>
  <!-- /.navbar -->
  @include('layouts.sidebar')
