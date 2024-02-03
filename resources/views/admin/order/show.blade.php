@extends('admin.order.layout')

@section('content')

<div class="card">
    <div class="card-header">Order Details</div>
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title">Customer Name: {{ $order->name }}</h5>
            <p class="card-text">Email: {{ $order->email }}</p>
            <p class="card-text">Phone: {{ $order->phone }}</p>
            <p class="card-text">Address: {{ $order->address }}</p>
            <p class="card-text">Product Title: {{ $order->product_title }}</p>
            <p class="card-text">Quantity: {{ $order->quantity }}</p>
            <p class="card-text">Price: {{ $order->price }}</p>
            @if($order->picture)
                <img src="{{ asset('storage/' . $order->picture) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
            @else
                <p>No image available</p>
            @endif
            <p class="card-text">Product ID: {{ $order->product_id }}</p>
            <p class="card-text">Payment Status: {{ $order->payment_status }}</p>
            <p class="card-text">Delivery Status: {{ $order->delivery_status }}</p>
        </div>
        <hr>
    </div>
</div>

@stop
