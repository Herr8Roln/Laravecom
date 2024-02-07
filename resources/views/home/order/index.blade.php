<!DOCTYPE html>
<html>
@include('home.head')
<body>
<div class="hero_area">
    @include('home.header')
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Shopping Orders</div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{  route('order_search') }}" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search" placeholder="Search For Something" aria-label="Search" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Cancel Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $item)
                                    <tr>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->product_title }}</td>
                                        <td>
                                            @if($item->picture)
                                            <img src="{{ asset('storage/' . $item->picture) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->delivery_status }}</td>
                                        <td>
                                            @if ($item->delivery_status == 'delivered')
                                            <p style="color: red"> order already delivered</p>
                                            @elseif ($item->delivery_status == 'canceled')
                                            <p style="color: red"> You canceled this order</p>
                                            @else
                                            <form method="POST" action="{{ route('order.update', $item->id) }}" style="display:inline" id="cancelOrderForm">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-danger btn-sm" title="Cancel Order" data-toggle="modal" data-target="#cancelConfirmationModal">
                                                    Cancel Order
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@include('home.footer')
<div class="cpy_"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="/home/js/jquery-3.4.1.min.js"></script>
<script src="/home/js/popper.min.js"></script>
<script src="/home/js/bootstrap.js"></script>
<script src="/home/js/custom.js"></script>
<div class="modal fade" id="cancelConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="cancelConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelConfirmationModalLabel">Cancel Order Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Cancel Order</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
