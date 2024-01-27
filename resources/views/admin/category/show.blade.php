
@extends('admin.category.layout')
@section('content')


<div class="card">
  <div class="card-header">Category Page</div>
  <div class="card-body">


        <div class="card-body">
        <h5 class="card-title">Name : {{ $category->name }}</h5>
        @if($category->icon)
        <img src="{{ asset('storage/' . $category->icon) }}" alt="Category Icon" width="50" height="50">

      @else
        <p>No image available</p>
      @endif
  </div>


    </div>
    <hr>

  </div>
</div>
