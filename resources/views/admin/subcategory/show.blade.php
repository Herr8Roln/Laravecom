@extends('admin.category.layout')
@section('content')


<div class="card">
  <div class="card-header">Category Page</div>
  <div class="card-body">


        <div class="card-body">
        <h5 class="card-title">Name: {{ $subcategory->name }}</h5>
        <br>
        <h5 class="card-title">Picture:</h5>
        @if($subcategory->picture)
            <img src="{{ asset('storage/subcategories/' . $subcategory->picture) }}" alt="Subcategory image" width="50" height="50">
        @else
            <p>No image available</p>
        @endif
            <br>
            <br>
            <h5 class="card-title">Picture:</h5>
            <br>
        @if($subcategory->category && $subcategory->category->icon)
            <img src="{{ asset('storage/' . $subcategory->category->icon) }}" alt="Category Icon" width="50" height="50">
        @else
            <p>No icon available</p>
        @endif
    </div>
</div>

@stop
