<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4 ">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('product.details', $products->id) }}" class="option1">Product Details</a>
                                <form action="{{ route('carts.store', ['product' => $products->id]) }}" method="post">
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
                        <div class="detail-box">
                            <h5>{{ $products->name }}</h5>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('storage/' . $products->picture) }}" alt="Product Image" >
                        </div>
                        <div class="detail-box text-center">
                            <h5>
                                @if($products->discount_price != null)
                                    <span class="text-danger" ><s>${{$products->price}}</s> </span>
                                    <br>
                                    <span class="text-success">
                                        ${{$products->discount_price}}
                                        ({{ number_format((($products->price - $products->discount_price) / $products->price) * 100, 2) }}% off)
                                    </span>
                                @else
                                    ${{$products->price}}
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $product->appends(request()->all())->links('pagination::bootstrap-5') }}        </div>
    </div>
</section>
<!-- end product section -->
