<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade as PDF;


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
        $order->payment_status= "Paid";
        $order->save();


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
    public function print_pdf($id) {
        // Fetch data for the PDF
        $order = Order::findOrFail($id);

        // Create an instance of TCPDF
        $pdf = new \TCPDF();

        // Set document information
        $pdf->SetCreator('Your Application');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Order Details');
        $pdf->SetSubject('Order Details');
        $pdf->SetKeywords('Order, Details');

        // Add a page to the PDF
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('times', 'B', 12);

        // Add logo to the top left
        $logoPath = public_path('home/images/logo.png');
        $pdf->Image($logoPath, 10, 10, 30, 30, 'PNG');

        // Add text to the top right
        $pdf->SetX(-60);
        $pdf->Cell(0, 10, 'Administration Document', 0, 1, 'R');

        // Add title in the center
        $pdf->Ln(30);
        $pdf->Cell(0, 10, 'Order Bill', 0, 1, 'C');
        $pdf->Ln(10);

        // Add order details in a table
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, 'Order ID: ' . $order->id, 0, 1);
        $pdf->Cell(0, 10, 'Customer Name: ' . $order->name, 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $order->email, 0, 1);
        $pdf->Cell(0, 10, 'Phone: ' . $order->phone, 0, 1);
        $pdf->Cell(0, 10, 'Address: ' . $order->address, 0, 1);
        $pdf->Cell(0, 10, 'Product: ' . $order->product_title, 0, 1);
        $pdf->Cell(0, 10, 'Quantity: ' . $order->quantity, 0, 1);
        $pdf->Cell(0, 10, 'Price: ' . $order->price, 0, 1);

        // Add more cells for other order details...

        // Add image at the bottom
        $imagePath = public_path('storage/' . $order->picture);
        $pdf->Image($imagePath, 10, $pdf->GetY() + 10, 60, 60, 'PNG');

        // Output the PDF to the browser for download
        $pdf->Output('order_details.pdf', 'D');
    }
}
