@extends('admin.order.layout')

@section('content')

<div class="card">
    <div class="card-header">Order Edit Page</div>
    <div class="card-body">

        <form action="{{ route('orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $order->id }}" />
            <label>Customer Name</label><br>
            <input type="text" name="name" id="name" value="{{ $order->name }}" class="form-control"><br>
            <label>Email</label><br>
            <input type="text" name="email" id="email" value="{{ $order->email }}" class="form-control"><br>
            <label>Phone</label><br>
            <input type="text" name="phone" id="phone" value="{{ $order->phone }}" class="form-control"><br>
            <label>Address</label><br>
            <input type="text" name="address" id="address" value="{{ $order->address }}" class="form-control"><br>

            <label>Product Title</label><br>
            <input type="text" name="product_title" id="product_title" value="{{ $order->product_title }}" class="form-control"><br>
            <label>Quantity</label><br>
            <input type="text" name="quantity" id="quantity" value="{{ $order->quantity }}" class="form-control"><br>
            <label>Price</label><br>
            <input type="text" name="price" id="price" value="{{ $order->price }}" class="form-control"><br>

            <label for="picture">Product Picture:</label>
            <br>
            <input type="file" name="picture" id="picture" class="form-control">
            <br>
            <br>
            <label>Product ID</label><br>
            <input type="text" name="product_id" id="product_id" value="{{ $order->product_id }}" class="form-control"><br>

            <label>Payment Status</label><br>
            <input type="text" name="payment_status" id="payment_status" value="{{ $order->payment_status }}" class="form-control"><br>

            <label>Delivery Status</label><br>
            <input type="text" name="delivery_status" id="delivery_status" value="{{ $order->delivery_status }}" class="form-control"><br>

            <input type="submit" value="Update" class="btn btn-success"><br>
        </form>

    </div>
</div>

@stop
