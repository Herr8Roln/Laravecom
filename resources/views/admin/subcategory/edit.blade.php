@extends('admin.subcategory.layout')

@section('content')

<div class="card">
  <div class="card-header">Edit Subcategory Page</div>
  <div class="card-body">

        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
		<input type="hidden" name="id" id="id" value="{{ $subcategory->id }}" />
            <div class="form-group">
                 <label for="subcategory">Subcategory Name</label>
            <input type="text" name="name" value="{{ $subcategory->name }}" class="form-control">
            </div>

            <div class="form-group">
            <label for="category_id">Category</label><br>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($category as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select><br>
        </div>

        <div class="form-group">
            <label for="picture">Picture</label><br>
            <input type="file" name="picture" id="picture" class="form-control"><br>
        </div>
            <input type="submit" value="Save" class="btn btn-success"><br>
        </form>

  </div>
</div>

@stop
