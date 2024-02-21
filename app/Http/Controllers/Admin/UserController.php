<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $users = User::where('usertype', '!=', 1)->get();
        return view('admin.user.index', compact('users'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Logic for creating a new user (if needed)
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Logic for storing a new user (if needed)
    }

    // Display the specified resource.
    public function show(User $user)
    {
        // Logic for showing a specific user (if needed)
    }

    // Show the form for editing the specified resource.
    public function edit(User $user)
    {
        // Logic for editing a specific user (if needed)
    }

    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        // Logic for updating a specific user (if needed)
    }

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        // Logic for deleting a specific user (if needed)
    }
}
