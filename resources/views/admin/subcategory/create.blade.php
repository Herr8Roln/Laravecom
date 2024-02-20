@extends('admin.category.layout')

@section('content')

<div class="card">
  <div class="card-header">New Subcategory</div>
  <div class="card-body">

      <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" class="form-control"><br>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label><br>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
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
