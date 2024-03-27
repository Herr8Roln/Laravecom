<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Admin\Subcategory;
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
        $categories = Category::with('subcategories')->get();

        return view('admin.product.create', compact('categories'));
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

    public function update(Request $request, Product $product)
{
    $requestData = $request->only(['name', 'description', 'price', 'discount_price', 'available_qte', 'category_id', 'subcategory_id']);

    // Check if picture is uploaded and update it if necessary
    if ($request->hasFile('picture')) {
        $picturePath = $request->file('picture')->store('products', 'public');
        $requestData['picture'] = $picturePath;
    }

    // Update the product with the extracted attributes
    $product->update($requestData);

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

    public function search(Request $request)
{
    $searchText = $request->search;

    // Perform the search query
    $product = Product::where(function($query) use ($searchText) {
            $query->where('name', 'LIKE', "%$searchText%")
                ->orWhere('description', 'LIKE', "%$searchText%")
                ->orWhere('price', 'LIKE', "%$searchText%")
                ->orWhere('discount_price', 'LIKE', "%$searchText%")
                ->orWhere('available_qte', 'LIKE', "%$searchText%");
        })->get();

    // Pass the search results to the index view
    return view('admin.product.index', compact('product'));
}

}
