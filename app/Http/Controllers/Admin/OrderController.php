<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Fetch orders from the Order model based on the filters provided in the request
        $orders = Order::when($request->date, function ($q) use ($request) {
            // If a specific date is provided, filter orders for that date
            return $q->whereDate('created_at', $request->date);
        })
        ->when(!$request->date, function ($q) {
            // If no specific date is provided, do not filter by date (show all orders)
            return $q;
        })
        ->when($request->status, function ($q) use ($request) {
            // Filter orders based on the status message provided in the request
            return $q->where('status_message', $request->status);
        })
        ->paginate(10);

        // Display the index view for orders and pass the orders data to the view
        return view('admin.orders.index', compact('orders'));
    }


    public function show(int $orderId)
    {
        // Find the order with the given orderId
        $order = Order::where('id', $orderId)->first();

        // If the order is found, display the view for the specific order and pass the order data to the view
        // Otherwise, redirect back to the orders index view with a message
        return $order ? view('admin.orders.view', compact('order')) : redirect('admin/orders')->with('message', 'Order Id not found');
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        // Find the order with the given orderId
        $order = Order::find($orderId);

        // If the order is found, update its status_message with the new order_status value from the request
        if ($order) {
            $request->validate([
                'order_status' => 'required|in:in progress,completed,pending,cancelled,out-for-delivery',
            ]);

            $order->update([
                'status_message' => $request->input('order_status'),
            ]);

            // Redirect back to the specific order view with a success message
            return redirect('admin/orders/' . $orderId)->with('message', 'Order Status Updated');
        } else {
            // If the order is not found, redirect back to the specific order view with an error message
            return redirect('admin/orders/' . $orderId)->with('message', 'Order Id not found');
        }
    }


    public function viewInvoice(int $orderId)
    {
        // Find the order with the given orderId
        $order = Order::findOrFail($orderId);

        // Display the view to generate the invoice and pass the order data to the view
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId)
    {
        // Find the order with the given orderId
        $order = Order::findOrFail($orderId);

        // Prepare the data to be passed to the PDF view
        $data = ['order' => $order];

        // Generate the PDF using the specified view and data
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        // Get the current date in 'd-m-Y' format
        $todayDate = Carbon::now()->format('d-m-Y');

        // Download the PDF with a filename containing the order id and current date
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        try {
            // Find the order with the given orderId
            $order = Order::findOrFail($orderId);

            // Send the invoice email to the order's email using the InvoiceOrderMailable
            Mail::to($order->email)->send(new InvoiceOrderMailable($order));

            // If the email is sent successfully, redirect back to the specific order view with a success message
            // Otherwise, redirect back to the specific order view with an error message
            return redirect('admin/orders/' . $orderId)->with('message', 'Invoice Mail has been sent to ' . $order->email);
        } catch (\Exception $e) {
            return redirect('admin/orders/' . $orderId)->with('message', 'Something Went Wrong.!');
        }
    }
}
