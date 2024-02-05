<!DOCTYPE html>
<html lang="en">
  <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <style>
            #whitecolor {
                color: white;
            }
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
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <h1 style="text-align: center; font-size: 25px; " >Send Email to {{ $order->email }}</h1>

                <br>
                <form action="{{ route('send_user_email',$order->id ) }}" method="POST">
                    @csrf
                     <div class="form-group">
                        <label>Email Greeting :</label>
                        <input id="whitecolor" type="text" name="greeting" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Subject :</label>
                        <input id="whitecolor" type="text" name="firstline" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Body:</label>
                        <input id="whitecolor" type="text" name="body" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Button Name:</label>
                        <input id="whitecolor" type="text" name="button" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email URL:</label>
                        <input id="whitecolor" type="text" name="url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Last Line:</label>
                        <input id="whitecolor" type="text" name="lastline" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Send Email" class="btn btn-danger btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
      @include('admin.script')

  </body>
</html>
