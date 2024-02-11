<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Retrieve cart items for the user with eager loading of the associated product,
        //ani tawa nfaser el product yitjbed m3a el cart b une requete additioner bech nitfadaw N+1 appel
        $carts = Cart::with('product')->where('user_id', $userId)->get();

        // You may need to adjust the view name if it's different
        return view('home.cart.index', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        if (Auth::id()) {
        $user=Auth::user();
        $userid=$user->id;
        $product=product::find($id);
        $product_exist_id=cart::where('Product_id', '=', $id)->where('user_id' ,'=', $userid)->get('id')->first();


        if ($product_exist_id) {
            $cart=cart::find($product_exist_id)->first();
            $quantity=$cart->quantity;
            $cart->quantity=$quantity+$request->quantity;
            if($product->discount_price!=null) {
            $cart->price= $product->discount_price* $request-> quantity;
            }
            else {
            $cart->price= $product->price* $request->quantity;
             }
            $cart->save();
            Alert::success('Product Added Successfully', 'We have addeed product to the cart' );
            return redirect()->back();

        }
        else
        {
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
            Alert::success('Product Added Successfully', 'We have addeed product to the cart' );

            return redirect()->back();
            }
        }
        else
        {
            return redirect('login');
        }

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
