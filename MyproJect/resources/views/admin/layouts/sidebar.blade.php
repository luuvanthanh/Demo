<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="/admin_lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/admin_lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- menu for home page --}}
          <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'menu-open' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          {{-- menu of category module --}}
          @php
            $routeCategoryArr = [
              'admin.category.index',
              'admin.category.create',
              'admin.category.edit',
              'admin.category.show',
            ];
          @endphp
          <li class="nav-item {{ in_array(Route::currentRouteName(), $routeCategoryArr) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.category.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.category.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.category.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- menu of post module --}}
          @php
            $routePostArr = [
              'admin.post.index',
              'admin.post.create',
              'admin.post.edit',
              'admin.post.show',
            ];
          @endphp
          <li class="nav-item {{ in_array(Route::currentRouteName(), $routePostArr) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Post
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.post.index') }}" class="nav-link {{ Route::currentRouteName() == 'admin.post.index' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Post</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.post.create') }}" class="nav-link {{ Route::currentRouteName() == 'admin.post.create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Post</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" onclick="return confirm('Are you sure LOGOUT ?')">Logout</button>
        </form>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>