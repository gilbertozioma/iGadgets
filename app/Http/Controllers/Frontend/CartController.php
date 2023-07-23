<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Load the view 'frontend.cart.index' to display the shopping cart page.
        return view('frontend.cart.index');
    }
}
