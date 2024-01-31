<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve cart items for the user with eager loading of the associated product
        $carts = Cart::with('product')->where('user_id', $userId)->get();

        // You may need to adjust the view name if it's different
        return view('home.cart.index', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        Cart::create([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'user_id' => $user->id,
            'product_title' => $product->name,
            'price' => $product->discount_price ?? $product->price,
            'picture' => $product->picture,
            'product_id' => $id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back();
    }



    public function update(Request $request, $id)
{
    $cart = Cart::findOrFail($id);
    $this->authorize('update', $cart);

    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cart->update([
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('home.cart.index')->with('message', 'Cart item updated successfully');
}

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
  

        $cart->delete();

        return redirect()->route('carts.index')->with('message', 'Cart item removed successfully');
    }
}
