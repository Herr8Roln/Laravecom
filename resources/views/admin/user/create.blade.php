@extends('admin.product.layout')
@section('content')

<div class="card">
  <div class="card-header">product Page</div>
  <div class="card-body">

      <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>description</label></br>
        <input type="text" name="description" id="description" class="form-control"></br>
        <label>price</label></br>
        <input type="text" name="price" id="price" class="form-control"></br>

        <label>discount price</label></br>
        <input type="text" name="discount_price" id="discount_price" class="form-control"></br>
        <label>Quantity </label></br>
        <input type="text" name="available_qte" id="available_qte" class="form-control"></br>
        <label for="subcategory">Select a subcategory:</label>
        <select id="subcategory" name="subcategory_id" class="form-control">
            <option value="">Select a subcategory</option>
            @foreach ($categories as $category)
                <optgroup label="{{ $category->name }}">
                    @foreach ($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>

        </br>
        <div class="form-group">
            <label for="picture">Product Picture:</label>
            <br>
            <input type="file" name="picture" id="picture" class="form-control">
        </div>
        </br>
        </br>
        <input type="submit" value="Save" class="btn btn-success"></br>
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

