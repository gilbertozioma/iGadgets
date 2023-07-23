<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Load the view 'frontend.checkout.index' to display the checkout page.
        return view('frontend.checkout.index');
    }
}
