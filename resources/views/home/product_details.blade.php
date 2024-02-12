<!DOCTYPE html>
<html>
    <head>
   @include('home.head')
   <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="this must be the description and other stuff">
    <meta name="description" content="">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{ asset('interface/nicepage.css') }}" media="screen">
<link rel="stylesheet" href="{{ asset('Accueil.css" media="screen')}}">
    <script class="u-script" type="text/javascript" src="{{ asset('interface/jquery.js')}}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset('interface/nicepage.js')}}" defer=""></script>
    <meta name="generator" content="Nicepage 6.0.3, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">



    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/default-logo.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Accueil">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
    </head>
   <body>
      <div class="hero_area">
        @include('home.header')
        <div class="container" style="background-image: url('{{ asset('interface/images/1659954800_windows_365_-_5.jpg') }}'); background-size: cover; background-position: center; padding: 50px;">
            <div class="card mx-auto" style="max-width: 1200px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>{{ $product->name }}</h5>
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
                            <h6>Product Category: <img src="{{ asset('storage/' . $product->category->icon) }}" alt="" style="max-width: 50px; max-height: 50px;"> {{ $product->category->name }}</h6>
                            <h6>Product Details: {{ $product->description }}</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="img-box">
                                <img src="{{ asset('storage/' . $product->picture) }}" alt="" style="width: 100%; height: auto;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-box">
                                <h6>Available Quantity: {{ $product->available_qte }}</h6>
                                <form action="{{ route('carts.store', ['product' => $product->id]) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                                            <input type="submit" value="Add To Cart" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @include('home.footer')
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
