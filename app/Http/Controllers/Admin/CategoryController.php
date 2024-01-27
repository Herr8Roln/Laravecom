<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
        public function index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }


    public function create()
    {
        return view('admin.category.create');
    }



    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new category instance
        $category = new Category;

        // Assign values from the request to the category instance
        $category->name = $request->name;

        // Check if a file was uploaded
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
            $category->icon = $iconPath;
        }

        // Save the category to the database
        $category->save();

        // Redirect to the index page or show a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }



    public function show($id)
    {
        $category = Category::find($id); //Eloquent ORM (Object-Relational Mapping)
        return view('admin.category.show',compact('category'));
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }


    public function update(Request $request, $id) //doesn't work
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update other fields
        $category->name = $request->input('name');

        // Update icon if a new one is provided
        if ($request->hasFile('icon')) {
            // Delete the previous icon file if it exists
            if ($category->icon) {
                File::delete(public_path($category->icon));
            }

            // Upload the new icon file
            $iconPath = $request->file('icon')->storeAs('','category_icons/'. $category->id . '.' . $request->file('icon')->extension(), 'public');
            $category->icon = 'category_icons/' .$category->id . '.' . $request->file('icon')->extension();
        }

        // Save the updated category to the database
        $category->save();
	$flashMessage = 'Category Updated!';
        return redirect()->route('categories.index', compact('flashMessage'));
    }
        public function destroy($id)
    {
        // Find the category by ID
    $category = Category::find($id);

    // Delete all products associated with this category
    $category->products()->delete();

    if ($category->icon) {
        // Use the File facade to delete the picture
        File::delete(storage_path('app/public/' . $category->icon));
    }

    // Delete the category
    $category->delete();

    $flash_message = 'Category and associated products deleted!';

        return redirect()->route('categories.index', compact('flash_message'));
    }
    public function showDropdown()
    {
        $category = Category::all();
        return view('admin.category.dropdown', compact('category'));
    }
}
