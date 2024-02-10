<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <br><br>
<div>
<form action="{{ route('product_search') }}" method="GET">
@csrf
<input style="width: 500px;" type="text" name="search" placeholder="Search for Something">
<input type="submit" value="search">
</form>
</div>
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

            {{ $product->appends(request()->all())->links('pagination::bootstrap-5') }}
    </div>
    <br>
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

                @foreach ( $comment as $comment)
                    <div class="comment">
                        <b>{{ $comment->name }}</b>
                        <p>{{ $comment->comment }}</p>
                       {{-- ok the data-commentId : data is part html5 designation   --}}
                        <a href="javascript:void(0);" class="reply-link" onclick="reply(this)" style="text-decoration: none;" data-commentid="{{ $comment->id }}">Reply</a>
                    @foreach($reply as $rep)
                        @if($rep->comment_id==$comment->id)
                        <div style="padding-left: 3%; padding-bottom: 10px; padding-bottom: 10px;">
                        <b>{{$rep->name}}</b>
                        <p>{{$rep->reply}}</p>
                        <a href="javascript:void(0);" class="reply-link" onclick="reply(this)" style="text-decoration: none;" data-commentid="{{ $comment->id }}">Reply</a>
                        </div>
                        @endif
                    @endforeach
                    </div>
                @endforeach

                <!-- Reply text Box-->
                <div style="display: none;" class="replyDiv">

                    <form action="{{url('add_reply')}}" method="POST">
                        @csrf
                        <input type="hidden" id="commentId" name="commentId" >
                        <textarea style="height: 100px; width: 500px;" name="reply" placeholder="write something here"></textarea>

                        <button type="submit" class="btn btn-dark">Reply</button>
                        <button  onclick="reply_close(this)" class="btn btn-danger">Close</button>
                </div>
                <form>
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
            {{-- fetches the value of the data-commentid attribute from the element that button and then it sets that value as the value of an input element with the id commentId. --}}

                document.getElementById('commentId').value=$(caller).attr('data-Commentid');
                $('.replyDiv').insertAfter($(caller));
                $('.replyDiv').show();
            }
            function reply_close(caller)
            {
                $('.replyDiv').hide();
            }

        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function(e) {
                var scrollpos = window.scrollY || window.pageYOffset;
                localStorage.setItem('scrollpos', scrollpos);
            };

            </script>
