
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Project </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @if(Route::has('login'))
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/Avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
         <a href="#" class="d-block">{{Auth::user()->name}}</a> 
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             
               
                   @if(Auth::user()->utype === 'ADM')
          <li class="nav-item">
            <a href="{{route('task')}}" class="nav-link ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Tasks
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('show.users')}}" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('settings')}}" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              Settings
              </p>
            </a>
          </li>

          @elseif(Auth::user()->utype === 'USR')

          <li class="nav-item">
            <a href="{{route('show.task')}}" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Task
              </p>
            </a>
          </li>

              @endif
            


          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
              <i class="nav-icon far fa-circle text-success"></i>
              <p class="text">Finished</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Rejected</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
              <i class="nav-icon far fa-circle text-secondary"></i>
              <p class="text">Pending</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
              <i class="nav-icon far fa-circle text-primary"></i>
              <p class="text">Processing</p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="#"  class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p class="text">Late</p>
            </a>
            
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      @endauth
              @endif

    </div>
    <!-- /.sidebar -->
  </aside>
