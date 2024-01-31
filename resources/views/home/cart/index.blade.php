<!DOCTYPE html>
<html>
   @include('home.head')
   <body>
      <div class="hero_area">
        @include('home.header');
        @if(session()->has('message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
        @endif




    <div class="container" >
        <div class="row">
            <div class="col-md-9" >
                <div class="card" style="width: 1300px">
                    <div class="card-header">Shopping Cart</div>
                    <div class="card-body">



                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th >Quantity</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th style="width: 180px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $totalPrice = 0;
                                    @endphp
                                @foreach($carts as $item)
                                <tr>
                                    <td>{{ $item->product_title}}</td>
                                    <td>
                                        @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No Image
                                        @endif
                                        <td style="width: 200px;">
                                            <form action="{{ route('carts.update', ['cart' => $item->id]) }}" method="post">
                                                @csrf
                                                @method('PUT') <!-- Use PUT method for update -->
                                                {{ $item->quantity }}
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 75px;">
                                                    </div>
                                                    <br>
                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-success" style="width: 75px; padding:15px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                                                <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z"/>
                                                              </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    <td>{{ $item->product->description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        @if($item->product->category && $item->product->category->icon)
                                            <img src="{{ asset('storage/' . $item->product->category->icon) }}" alt="Category Icon" class="img-fluid" style="max-width: 50px; max-height: 50px;">
                                        @else
                                            No Category Icon
                                        @endif
                                    </td>
                                        <td>
                                            <a href="{{ route('product.details', $item->product_id) }}" title="View product" style="text-decoration: none;">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                            </a>

                                            <form method="POST" action="{{ route('carts.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                @method("DELETE")
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete " onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    $totalPrice += $item->price * $item->quantity;
                                    @endphp
                                @endforeach



                                </tbody>
                            </table>
                        </div>

                        <!-- Display the total price -->
                            <div class="text-end">
                                <strong>Total Price: ${{ number_format($totalPrice, 2) }}</strong>
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <h2 style="font-size: 25px;padding-bottom: 15px;">Proceed to Order</h2>
                                <a href="{{ route('cash.order') }}" class="btn btn-danger">Cash On Delivery</a>
                                <br>
                                <a href="{{ route('stripe',$totalPrice) }}" class="btn btn-danger">Pay Using Card</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <br>
        <br>
        @include('home.footer');
        <div class="cpy_">

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
