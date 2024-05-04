<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $users = User::where('usertype', '!=', 1)->get();
        return view('admin.user.index', compact('users'));
    }

    // Show the form for creating a new resource.

    // Store a newly created resource in storage.


    

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'usertype' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'email_verified_at' => 'nullable|date',
            'profile_photo_path' => 'nullable|image|max:2048', // Assuming profile_photo_path is the field for storing profile photo
        ]);

        // Update the user details
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'usertype' => $validatedData['usertype'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'email_verified_at' => $validatedData['email_verified_at'],
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo_path')) {
            $profilePhotoPath = $request->file('profile_photo_path')->store('profile_photos', 'public');
            $user->update(['profile_photo_path' => $profilePhotoPath]);
        }

        // Redirect back or wherever you wish
        return redirect()->back()->with('success', 'User updated successfully');
    }


    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        // Delete the user's profile photo if it exists
        if ($user->profile_photo_path) {
            File::delete(storage_path('app/public/' . $user->picture));

        }

        // Delete the user
        $user->delete();

        // Redirect back or wherever you wish
        return redirect()->back()->with('success', 'User deleted successfully');
    }
    public function search(Request $request)
    {
        // Access the specific query parameter from the InputBag object
        $searchText = $request->query('search');

        // Use query builder with dynamic 'orWhere' clauses for better readability
        $users = User::where(function($query) use ($searchText) {
            $query->where('name', 'LIKE', "%$searchText%")
                  ->orWhere('email', 'LIKE', "%$searchText%")
                  ->orWhere('phone', 'LIKE', "%$searchText%")
                  ->orWhere('address', 'LIKE', "%$searchText%");
        })
        ->get();

        return view('admin.user.index', compact('users'));
    }



}
