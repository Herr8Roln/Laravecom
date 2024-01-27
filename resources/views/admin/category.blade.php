<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center
        {
        text-align: center;
        padding-top: 40px;
        }
        .h2_font
        {
        font-size: 40px;
        padding-bottom: 40px;
        }

        </style>


  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
            <div class="div_center">
            <h2 class="h2_font">Add Catagory</h2>
            <div class="card">
                <div class="card-header">new category</div>
                <div class="card-body">

                    <form action="{{}}"  method="POST" enctype="multipart/form-data">
                      @csrf

                      <label>Name</label></br>
                      <input type="text" name="name" id="name" class="form-control"></br>
                      <label>ICON</label></br>
                      <input type="file" name="icon" id="icon" class="form-control"></br>
                      <input type="submit" value="Save" class="btn btn-success"></br>
                  </form>

                </div>
              </div>



            </div>


        </div>
        @include('admin.script')

  </body>
</html>
