<!DOCTYPE html>
<html lang="en">
<head>


    @include('admin.css')
    <style type="text/css">
        .button-container {
            display: flex;
            gap: 10px; /* Adjust the value to set the desired space between buttons */
        }
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
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                {{session()->get('message')}}
                                </div>
                                @endif
                                <div class="col-md-9" style="width: 1000px; margin-top: 20px; ">
                                    <div class="card"><br>
                                        <br>
                                        <br>
                                        <div class="card-header">Orders</div>
                                        <br>
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

                                        <br>
                                        <div class="card-body">
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
                                                            <th>PDF</th>
                                                            <th style="width: 180px">Send Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($orders as $order)
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
                                                                <td class="button-container">
                                                                    @if($order->delivery_status == 'processing')
                                                                        <form action="{{ route('orders.delivered', ['id' => $order->id]) }}" method="POST">
                                                                            @method('PUT')
                                                                            @csrf
                                                                            <input type="hidden" name="_method" value="PUT">
                                                                            <button type="submit" onclick="return confirm('Are you sure the product is delivered?')" class="btn btn-success btn-sm">
                                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Deliver
                                                                            </button>
                                                                        </form>

                                                                        <form method="POST" action="{{ route('orders.destroy', $order->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                            @method("DELETE")
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete order" onclick="return confirm('Confirm delete?')">
                                                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <p style="color: green">Delivered</p>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('print_pdf',$order->id) }}" class="btn btn-secondary">Print PDF</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('send_email',$order->id) }}" class="btn btn-info">Send Email</a>
                                                                </td>
                                                            </tr>

                                                            @empty
                                                            <tr>
                                                                <td > No data found</td>
                                                            </tr>
                                                        @endforelse
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
