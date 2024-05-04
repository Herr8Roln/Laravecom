<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="admin/index.html"><img src="\home\images\logo.png" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        

        <ul class="navbar-nav navbar-nav-right">
            <li>
              @include('admin.logout')
            </li>
        </ul>
      </div>
    </nav>
