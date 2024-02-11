<!DOCTYPE html>
<html>
    <head>
   @include('home.head')
    </head>
   <body>
    @include('sweetalert::alert');
      <div class="hero_area">
        @include('home.header');


      @include('home.product_view');

      <div class="cpy_">

      </div>
      <!-- jQery -->
      <script src="/home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="/home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="/home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="/home/js/custom.js"></script>
   </body>
</html>
