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
    <!-- start comments section -->
    <div class="container">
        <div class="card text-center" style="padding-bottom: 30px;">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 30px; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
                <form class="d-flex flex-column align-items-center" action="{{ route('add_comment') }}" method="POST">
                    @csrf
                    <textarea class="form-control mb-3" name="comment" style="height: 150px; width: 600px;" placeholder=" Comment something here"></textarea>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Comment">
                </form>
            </div>
        </div>

        <div class="card" style="margin-top: 30px;">
            <div class="card-body">
                <h1 class="card-title" style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
                <div class="comment">
                    <b>Alex</b>
                    <p>This is my first time buying from this site, it was a good experience</p>
                    <a href="javascript:void(0);" class="reply-link" onclick="reply(this)">Reply</a>
                </div>
                <div class="comment">
                    <b>James</b>
                    <p>The delivery is a bit slow</p>
                    <a href="javascript:void(0);" class="reply-link" onclick="reply(this)">Reply</a>
                </div>
                <div class="comment">
                    <b>Max</b>
                    <p>Is there an option for delivery to New Jersey?</p>
                    <a href="javascript:void(0);" class="reply-link" onclick="reply(this)">Reply</a>
                </div>
                <div style="display: none;" class="replyDiv">
                    <textarea class="form-control mb-3" placeholder="Write something here" style="height: 100px; width: 500px;"></textarea>
                    <a href="#" class="btn btn-primary">Reply</a>
                </div>
                <br>
            </div>
            <br>
        </div>
        <!-- end comments section -->
        </section>
        <!-- end product section -->
        <script type="text/javascript">
            function reply(caller)
            {
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }
        </script>
