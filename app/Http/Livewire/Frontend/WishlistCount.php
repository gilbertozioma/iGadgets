<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    // Public property to store the wishlist count
    public $wishlistCount;

    // This property defines the listeners for this component
    // It listens for the event 'wishlistAddedUpdated' and triggers the method 'checkWishlistCount'
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];

    // Method to check the number of items in the user's wishlist
    public function checkWishlistCount()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If the user is authenticated, get the count of items in their wishlist
            // and store it in the $wishlistCount property
            return $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        } else {
            // If the user is not authenticated, set the $wishlistCount property to 0
            return $this->wishlistCount = 0;
        }
    }

    // The 'render' method is called whenever the component is rendered
    // It updates the wishlist count by calling 'checkWishlistCount' method
    // and returns the view 'livewire.frontend.wishlist-count' with 'wishlistCount' data
    public function render()
    {
        // Call the 'checkWishlistCount' method to get the updated wishlist count
        $this->wishlistCount = $this->checkWishlistCount();

        // Pass the 'wishlistCount' data to the view
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
