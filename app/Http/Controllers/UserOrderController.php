<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\SendEmailNotification;

class UserOrderController extends Controller
{
        public function index() {
        if(Auth::id())
            {
                $userId = Auth::id();

        // Retrieve cart items for the user with eager loading of the associated product
        //el fonction where timchi par défaut égalité =
        $order = order::where('user_id', $userId)->get();
            return view('home.order.index',compact('order'));
            }
        else
            {
            return redirect('login');
            }
        }
        public function show($id)
        {
            // Logic to retrieve and show a specific order
        }
        public function destroy($id)
        {
            try {
                // Find the order by its ID
                $order = Order::findOrFail($id);

                // Delete the order
                $order->delete();

                return redirect()->back()->with('message', 'Order deleted successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('message', 'Failed to delete the order. Error: ' . $e->getMessage());
            }
        }


        public function update($id)
        {
            // Find the order by its ID
            $order = Order::findOrFail($id);

            // Update the delivery status to "canceled"
            $order->update(['delivery_status' => 'canceled']);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Order canceled successfully.');
        }

}
