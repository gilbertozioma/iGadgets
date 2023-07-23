<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Return the view 'frontend.wishlist.index'.
        return view('frontend.wishlist.index');
    }
}
