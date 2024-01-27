<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();//getting all product from database
        return view('admin.product.index', compact('product'));//getting all category from database

    }

    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', compact('category'));
    }

    public function store(Request $request) //Updating store method according to picture attribute
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust file types and size as needed
        ]);

        $input = $request->all();

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('product_pictures', 'public');
            $input['picture'] = $picturePath;
        }

        Product::create($input);
        $flash_message="Product added" ;
        return redirect()->route('products.index')->with("flash_message");
    }

    public function show($id)
    {
        $product = Product::find($id);//Eloquent ORM (Object-Relational Mapping)
        return view('admin.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit', compact('product','category'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for the picture
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update other fields
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        // Update picture if a new one is provided
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = $picture->store('product_pictures', 'public');
            $product->picture = $picturePath;
        }

        $product->update($request);

        $flashMessage = 'Product Updated!';
        return redirect()->route('products.index', compact('flashMessage'));
    }

    public function destroy($id)
    {
            // Find the product by ID
        $product = Product::find($id);

        // Delete the product picture if it exists
        if ($product->picture) {
            // Use the File facade to delete the picture
            File::delete(storage_path('app/public/' . $product->picture));
        }

        // Delete the product
        $product->delete();
        $flash_message = 'Product Deleted!';
        return redirect()->route('products.index', compact('flash_message'));
    }
}
