<!DOCTYPE html>
<html lang="en">
  <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            .nav-item {
                position: relative;
                display: inline-block;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #f8f9fa;
                color: #212529;
                text-decoration: none;
                border: 1px solid #dee2e6;
                border-radius: 4px;
            }

            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: #ffffff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            .nav-item:hover .dropdown-menu {
                display: block;
            }

            .dropdown-item {
                display: block;
                padding: 10px;
                color: #212529;
                text-decoration: none;
            }

            .dropdown-item:hover {
                background-color: #f8f9fa;
            }
        </style>

    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.header')
      @include('admin.body')
      @include('admin.script')

  </body>
</html>
