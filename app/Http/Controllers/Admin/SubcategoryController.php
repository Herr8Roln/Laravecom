<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $subcategory = Subcategory::create($request->all());

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $imageName = time() . '.' . $picture->extension();
            $picture->move(public_path('images/subcategories'), $imageName);
            $subcategory->picture = $imageName;
            $subcategory->save();
        }

        return redirect()->route('admin.subcategory.index')
            ->with('success', 'Subcategory created successfully.');
    }

    public function show($id)
{
    $subcategory = Subcategory::findOrFail($id);
    return view('admin.subcategories.show', compact('subcategory'));
}


    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $subcategory->update($request->all());

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $imageName = time() . '.' . $picture->extension();
            $picture->move(public_path('images/subcategories'), $imageName);
            $subcategory->picture = $imageName;
            $subcategory->save();
        }

        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }
    public function showDropdown()
    {
        $subcategory = Subcategory::all();
        return view('admin.category.dropdown', compact('subcategory'));
    }

}
