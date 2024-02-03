<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        // Assuming you might need some data for order creation, add necessary logic here
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'product_title' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_id' => 'required|exists:products,id', // Assuming you have a products table
            // Add any other validation rules for your order attributes
        ]);

        $input = $request->all();

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('order_pictures', 'public');
            $input['picture'] = $picturePath;
        }

        Order::create($input);

        $flash_message = "Order added";
        return redirect()->route('orders.index')->with("flash_message");
    }

    public function delivered($id)
    {


        $order = Order::findOrFail($id);

        $order->delivery_status="delivered";
        $order->save();

        $flash_message = 'Order Updated!';
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order->picture) {
            File::delete(storage_path('app/public/' . $order->picture));
        }

        $order->delete();

        $flash_message = 'Order Deleted!';
        return redirect()->route('orders.index', compact('flash_message'));
    }
}
