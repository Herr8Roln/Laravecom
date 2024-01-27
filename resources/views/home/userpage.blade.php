<!DOCTYPE html>
<html>
   @include('home.head')
   <body>
      <div class="hero_area">
        @include('home.header');
         @include('home.slider');
      </div>
      @include('home.why');
      @include('home.new_arrival');
      @include('home.product');
      @include('home.subscribe');
      @include('home.client');
      @include('home.footer');
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
