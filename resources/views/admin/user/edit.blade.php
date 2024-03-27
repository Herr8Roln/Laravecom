@extends('admin.user.layout')

@section('content')

<div class="card">
  <div class="card-header">User Edit Page</div>
  <div class="card-body">

      <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method("PATCH")

        <input type="hidden" name="id" id="id" value="{{ $user->id }}" />

        <label>Name</label><br>
        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control"><br>

        <label>Email</label><br>
        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control"><br>

        <label>User Type</label><br>
        <input type="text" name="usertype" id="usertype" value="{{ $user->usertype }}" class="form-control"><br>

        <label>Phone</label><br>
        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control"><br>

        <label>Address</label><br>
        <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control"><br>

        <label>Email Verified At</label><br>
        <input type="text" name="email_verified_at" id="email_verified_at" value="{{ $user->email_verified_at }}" class="form-control"><br>

        <div class="form-group">
            <label for="profile_photo_path">Profile Photo:</label><br>
            <input type="file" name="profile_photo_path" id="profile_photo_path" class="form-control">
        </div><br>

        <input type="submit" value="Update" class="btn btn-success"><br>
    </form>

  </div>
</div>

@stop
