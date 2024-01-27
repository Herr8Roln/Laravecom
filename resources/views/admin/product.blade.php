<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        @yield('content')
        @include('admin.script')

  </body>
</html>
