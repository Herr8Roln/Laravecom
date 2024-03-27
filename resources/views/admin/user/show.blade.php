@extends('admin.product.layout')
@section('content')

<div class="card">
    <div class="card-header">User Details</div>
    <div class="card-body">
        <h5 class="card-title">Name: {{ $user->name }}</h5>
        <p class="card-text">Email: {{ $user->email }}</p>
        <p class="card-text">User Type: {{ $user->usertype }}</p>
        <p class="card-text">Phone: {{ $user->phone ?? 'N/A' }}</p>
        <p class="card-text">Address: {{ $user->address ?? 'N/A' }}</p>
        <p class="card-text">Email Verified At: {{ $user->email_verified_at ?? 'N/A' }}</p>
        <p class="card-text">Created At: {{ $user->created_at }}</p>
        <p class="card-text">Updated At: {{ $user->updated_at }}</p>
        @if($user->profile_photo_path)
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo" style="max-width: 100px; max-height: 100px;">
        @else
            <p>No profile photo available</p>
        @endif
    </div>
  </div>

  @stop
