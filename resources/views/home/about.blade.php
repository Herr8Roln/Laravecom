<!DOCTYPE html>
<html>
    <head>
        @include('home.head')
         </head>
   <body class="sub_page">
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->
      </div>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>About us</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      @include('home.why');
      <!-- end why section -->
      <!-- arrival section -->
      <section class="arrival_section">
        <div class="container">
           <div class="box">
              <div class="arrival_bg_box">
                 <img src="home/images/arrival-bg.png" alt="">
              </div>
              <div class="row">
                 <div class="col-md-6 ml-auto">
                    <div class="heading_container remove_line_bt">
                       <h2>
                          #NewArrivals
                       </h2>
                    </div>
                    <p style="margin-top: 20px;margin-bottom: 30px;">
                       Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
                    </p>
                    <a href="">
                    Shop Now
                    </a>
                 </div>
              </div>
           </div>
        </div>
     </section>
      <!-- end arrival section -->
      <!-- footer section -->
      @include('home.footer');
      <!-- footer section -->
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>
