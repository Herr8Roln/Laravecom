@extends('admin.product.layout')
@section('content')

<div class="card">
    <div class="card-header">Product Page</div>
    <div class="card-body">
      <div class="card-body">
        <h5 class="card-title">Name: {{ $product->name }}</h5>
        <p class="card-text">Description: {{ $product->description }}</p>
        <p class="card-text">Price: {{ $product->price }}</p>
        <p class="card-text">discount price: {{ $product->discount_price }}</p>
        <p class="card-text">available qte: {{ $product->available_qte }}</p>
        @if($product->picture)
          <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
        @else
          <p>No image available</p>
        @endif
      </div>

      <hr>
    </div>
  </div>

  @stop
