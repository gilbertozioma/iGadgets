<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    // Variable to store the cart count
    public $cartCount;

    // Define the listeners for Livewire events
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    // Method to check the cart count
    public function checkCartCount()
    {
        if (Auth::check()) {
            // If user is logged in, retrieve the cart count for the authenticated user
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        } else {
            // If user is not logged in, set the cart count to 0
            return $this->cartCount = 0;
        }
    }

    public function render()
    {
        // Call the checkCartCount method to update the cart count
        $this->cartCount = $this->checkCartCount();

        // Render the view and pass the cart count to it
        return view('livewire.frontend.cart.cart-count', [
            'cartCount' => $this->cartCount
        ]);
    }
}
