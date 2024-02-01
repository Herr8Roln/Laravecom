<!DOCTYPE html>
<html>
    <head>
   @include('home.head')
    </head>
   <body>
      <div class="hero_area">
        @include('home.header');

        <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50; padding: 30px">
            <div class="img-box">
                <img src="{{ asset('storage/' . $product->picture) }}" alt="" style="max-width: 400px; max-height: 400px;">
            </div>
            <div class="detail-box">
                <h5>
                    {{ $product->title }}
                </h5>
                @if($product->discount_price != null)
                    <h6 style="color: red">
                        Discount price
                        <br>
                        ${{ $product->discount_price }}
                    </h6>
                    <h6 style="text-decoration: line-through; color: blue">
                        Price
                        <br>
                        ${{ $product->price }}
                    </h6>
                @else
                    <h6 style="color: blue">
                        Price
                        <br>
                        ${{ $product->price }}
                    </h6>
                @endif
                <h6>Product Category:     <img src="{{ asset('storage/' . $product->category->icon) }}" alt="" style="max-width: 50px; max-height: 50px;"> {{ $product->category->name  }}</h6>
                <h6>Product Details: {{ $product->description }}</h6>
                <h6>Available Quantity: {{ $product->quantity }}</h6>
                <form action="{{ route('carts.store', ['product' => $product->id]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                        </div>
                        <div class="col-md-4/">
                            <input type="submit" value="Add To Cart">
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
