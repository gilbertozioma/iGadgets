<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    // This function is responsible for removing an item from the wishlist based on its ID.
    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        // After removing the item from the wishlist, we emit an event to update the wishlist count.
        $this->emit('wishlistAddedUpdated');
        // We also dispatch a browser event to display a success message to the user.
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Item Removed Successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }

    // This function is responsible for rendering the wishlist items for the currently logged-in user.
    public function render()
    {
        // Fetch the wishlist items for the current user from the database.
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        // Return the view 'livewire.frontend.wishlist-show' and pass the wishlist data to it.
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}
