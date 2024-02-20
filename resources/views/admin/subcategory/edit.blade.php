@extends('admin.category.layout')
@section('content')

<div class="card">
  <div class="card-header">edit category Page</div>
  <div class="card-body">

      <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <input type="hidden" name="id" id="id" value="{{$category->id}}" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control"></br>
        </br>
        <label>Icon</label></br>
        <input type="file" name="icon" id="icon" class="form-control"></br>
            </br><input type="submit" value="Update" class="btn btn-success"></br>
    </form>

  </div>
</div>

@stop
