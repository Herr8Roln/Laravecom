<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Comment;
use App\Models\Reply;

class HomeController extends Controller
{


    public function index() {
        $product = Product::paginate(10);
        $reply = Reply::all();
        $comment=Comment::orderby('id', 'desc')->get();
        return view('home.userpage',compact('product','comment','reply'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            // Counting directly from the database without retrieving all records
            $total_product = product::count();
            $total_order = order::count();
            $total_user = user::count();

            // Using sum() to calculate total revenue directly in the database
            $total_revenue = order::sum('price');

            // Counting specific conditions directly in the database
            $total_delivered = order::where('delivery_status', 'delivered')->count();
            $total_processing = order::where('delivery_status', 'processing')->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        }
        else
        {
            $reply = Reply::all();
            $product = Product::paginate(10);
            $comment=Comment::orderby('id', 'desc')->get();

        return view('home.userpage',compact('product','comment','reply'));
        }

    }
    public function user()
    {
        $usertype=Auth::user()->usertype;
        if ($usertype=='0') {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function product_details($id)
{
    $product = Product::findOrFail($id);
    return view('home.product_details', compact('product'));
}
public function cash_order() //works fine
{
    $user = Auth::user();
    $userId = $user->id;
    $cartItems = Cart::where('user_id', $userId)->get();

    foreach ($cartItems as $cartItem) {
        Order::create([
            'name' => $cartItem->name,
            'email' => $cartItem->email,
            'phone' => $cartItem->phone,
            'address' => $cartItem->address,
            'user_id' => $cartItem->user_id,
            'product_title' => $cartItem->product_title,
            'price' => $cartItem->price,
            'quantity' => $cartItem->quantity,
            'image' => $cartItem->image,
            'product_id' => $cartItem->product_id,
            'payment_status' => 'cash on delivery',
            'delivery_status' => 'processing',
        ]);
    }
    Cart::where('user_id', $userId)->delete();

    // Redirect to a meaningful page or provide a feedback message
    return redirect()->back()->with('message', 'we have Received Your Order. We will contact you soon');
}
public function stripe($totalprice) { //works fine
    return view('home.stripe',compact('totalprice'));
}
public function stripePost(Request $request, $totalprice) //works fine
{
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment made successfully"
    ]);
    $user = Auth::user();
    $userId = $user->id;

    $cartItems = Cart::where('user_id', $userId)->get();

    foreach ($cartItems as $cartItem) {
        Order::create([
            'name' => $cartItem->name,
            'email' => $cartItem->email,
            'phone' => $cartItem->phone,
            'address' => $cartItem->address,
            'user_id' => $cartItem->user_id,
            'product_title' => $cartItem->product_title,
            'price' => $cartItem->price,
            'quantity' => $cartItem->quantity,
            'image' => $cartItem->picture,
            'product_id' => $cartItem->product_id,
            'payment_status' => 'Paid with credit card',
            'delivery_status' => 'processing',
        ]);
    }
    Cart::where('user_id', $userId)->delete();


    Session::flash('success', 'Payment successful!');

    return back();
}
public function add_comment(Request $request) //works fine
{
    // Ensure the user is authenticated
    if (Auth::check()) {
        // Create a new comment using the create method
        $comment = Comment::create([
            'name' => Auth::user()->name,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back();
    } else {
        // Redirect the user to the login page if they are not authenticated
        return redirect()->route('login');
    }
}
public function add_reply(Request $request) //works fine
{
    // Ensure the user is authenticated
        if (Auth::id()) {
            $reply = Reply::create([
                'name' => Auth::user()->name,
                'user_id' => Auth::id(),
                'comment_id' => $request->commentId,
                'reply' => $request->reply,
            ]);

            return redirect()->back();
        }
    else {
        // Redirect the user to the login page if they are not authenticated
        return redirect()->route('login');
    }
}
public function product_search(Request $request) //works fine
{
    $reply = Reply::all();
    $comment=Comment::orderby('id', 'desc')->get();
    //search process
    $search_text=$request->search;
    $product = Product::where('name', 'LIKE', "%$search_text%")
    ->orWhereHas('category', function($query) use ($search_text) {
        $query->where('name', 'LIKE', "%$search_text%"); })->paginate(10);
        // this research with % might cause confusion like men and women
    return view('home.userpage', compact('product','reply','comment'));
}
public function product() //works fine
{
    $product = Product::paginate(10);
    $reply = Reply::all();
    $comment=Comment::orderby('id', 'desc')->get();
    return view('home.all_product',compact('product','reply','comment'));

}
public function search_product(Request $request) //works fine
{
    $reply = Reply::all();
    $comment=Comment::orderby('id', 'desc')->get();
    //search process
    $search_text=$request->search;
    $product = Product::where('name', 'LIKE', "%$search_text%")
    ->orWhereHas('category', function($query) use ($search_text) {
        $query->where('name', 'LIKE', "%$search_text%"); })->paginate(10);
        // this research with % might cause confusion like men and women
    return view('home.all_product', compact('product','reply','comment'));
}
}


