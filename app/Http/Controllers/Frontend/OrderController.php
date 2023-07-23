<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display the list of orders for the authenticated user.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Get orders for the authenticated user, ordered by created_at in descending order, 10 orders per page.
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        // Return the view 'frontend.orders.index' with the user's orders.
        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Display the details of a specific order for the authenticated user.
     *
     * @param  int  $orderId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($orderId)
    {
        // Find the order for the authenticated user with the provided orderId.
        $order = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->first();

        // Check if the order exists.
        if ($order) {
            // Return the view 'frontend.orders.view' with the order details.
            return view('frontend.orders.view', compact('order'));
        } else {
            // If the order does not exist, redirect back with a message.
            return redirect()->back()->with('message', 'No Order Found');
        }
    }
}
