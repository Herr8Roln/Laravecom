@extends('admin.category.layout')
@section('content')

<div class="card">
  <div class="card-header">new category</div>
  <div class="card-body">

      <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Icon</label></br>
        <input type="file" name="icon" id="icon" class="form-control"></br>
    </br>
</br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>

  </div>
</div>

@stop

