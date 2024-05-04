<!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="{{ route('redirect') }}"><img style="padding-left: 25px;" src="/home/images/adminlogo.png" alt="logo" />          </a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('redirect') }}"><img src="admin/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="admin/assets/images/faces/face000.png" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                  <span>Admin Member</span>
                </div>
              </div>
             </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('redirect') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('products.index') }}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Product</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Category</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('orders.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Order</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('subcategories.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Subcategory</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('users.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Clients</span>
            </a>
        </li>
        <li class="nav-item menu-items">

        </li>
        </ul>
      </nav>
      <!-- partial -->
