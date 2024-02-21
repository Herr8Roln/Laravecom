@extends('admin.product.layout')

@section('content')

<div class="card">
  <div class="card-header">Product edit Page</div>
  <div class="card-body">

      <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")

        <input type="hidden" name="id" id="id" value="{{ $product->id }}" />

        <label>Name</label><br>
        <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control"><br>

        <label>Description</label><br>
        <input type="text" name="description" id="description" value="{{ $product->description }}" class="form-control"><br>

        <label>Price</label><br>
        <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control"><br>

        <label>Discount Price</label><br>
        <input type="text" name="discount_price" id="discount_price" value="{{ $product->discount_price }}" class="form-control"><br>

        <label>Quantity</label><br>
        <input type="text" name="available_qte" id="available_qte" value="{{ $product->available_qte }}" class="form-control"><br>

        <label for="subcategory">Select a subcategory:</label>
        <select id="subcategory" name="subcategory_id" class="form-control">
            <option value="">Select a subcategory</option>
            @foreach ($category as $category)
                <optgroup label="{{ $category->name }}">
                    @foreach ($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>

        <div class="form-group">
            <label for="picture">Product Picture:</label><br>
            <input type="file" name="picture" id="picture" class="form-control">
        </div><br>

        <input type="submit" value="Update" class="btn btn-success"><br>
    </form>

  </div>
</div>

@stop
<script lang="javascript">
    $('#category').change(function() {
        var categoryId = $(this).val();
        $('#subcategory').empty();
        $.each(categories, function(index, category) {
            if (category.id == categoryId) {
                $.each(category.subcategories, function(index, subcategory) {
                    $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            }
        });
    });
    </script lang="javascript">
