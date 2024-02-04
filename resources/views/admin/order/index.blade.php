<!DOCTYPE html>
<html lang="en">
<head>


    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .custom-container {
            margin: 20px; /* Adjust the margin as needed */
        }

        .custom-card {
            /* Adjust the top margin as needed */
        }

    </style>
</head>
<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        <div class="main-panel" style="align: center">
            <div class="content-wrapper">
                <div class="div_center">
                    @extends('admin.order.layout')

                    @section('content')

                            <div class="row">
                                <div class="col-md-9" style="width: 1000px; margin-top: 20px; ">
                                    <div class="card"><br>
                                        <br>
                                        <br>
                                        <div class="card-header">Orders</div>
                                        <div class="card-body">

                                            <a href="{{ route('orders.create') }}" class="btn btn-success btn-sm" title="Add New Order">
                                                <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                            </a>
                                            <br/>
                                            <br/>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                            <th>Product Title</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Picture</th>
                                                            <th>Product ID</th>
                                                            <th>Payment Status</th>
                                                            <th>Delivery Status</th>
                                                            <th style="width: 180px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>{{ $order->id }}</td>
                                                                <td>{{ $order->name }}</td>
                                                                <td>{{ $order->email }}</td>
                                                                <td>{{ $order->phone }}</td>
                                                                <td>{{ $order->address }}</td>
                                                                <td>{{ $order->product_title }}</td>
                                                                <td>{{ $order->quantity }}</td>
                                                                <td>{{ $order->price }}</td>
                                                                <td>
                                                                    @if($order->picture)
                                                                        <img src="{{ asset('storage/' . $order->picture) }}" alt="Order Image" style="max-width: 100px; max-height: 100px;">
                                                                    @else
                                                                        No Image
                                                                    @endif
                                                                </td>
                                                                <td>{{ $order->product_id }}</td>
                                                                <td>{{ $order->payment_status }}</td>
                                                                <td>{{ $order->delivery_status }}</td>
                                                                <td>

                                                                    <form action="{{ route('orders.delivered', ['id' => $order->id]) }}" method="POST">
                                                                        @method('PUT')
                                                                        <input type="hidden" name="_method" value="PUT">
                                                                        <button type="submit" class="btn btn-success btn-sm">
                                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Deliver
                                                                        </button>
                                                                    </form>

                                                                    <form method="POST" action="{{ route('orders.destroy', $order->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                        @method("DELETE")
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                                    </form>
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

                    @endsection
                </div>
            </div>
        </div>
    </div>
</body>
</html>
