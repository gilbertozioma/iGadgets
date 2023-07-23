<?php

namespace App\Http\Livewire\Frontend\ProdCard;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Action extends Component
{
    // Variables to store product data
    public $productId, $product, $quantityCount = 1;

    // Method to add a product to the cart
    public function addToCart(int $productId)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Check if the product exists and has status '0' (active)
            if ($this->product && $this->product->where('id', $productId)->where('status', '0')->exists()) {
                // Check if the product's quantity is greater than the selected quantity
                if ($this->product->quantity > $this->quantityCount) {
                    // Create a new cart item for the user
                    Cart::create([
                        'user_id' => auth()->user()->id,
                        'product_id' => $productId,
                        'quantity' => $this->quantityCount
                    ]);

                    // Emit an event to update the cart count
                    $this->emit('CartAddedUpdated');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Added to Cart',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    // Product quantity is not available
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Already Added',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
            } else {
                // Product does not exist or is not active
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Does not exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            // User is not logged in
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    // Method to add a product to the wishlist
    public function addToWishlist($productId)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Check if the product is already in the wishlist
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                // Product is already in the wishlist
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            } else {
                // Add the product to the wishlist
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                // Emit an event to update the wishlist count
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            // User is not logged in
            session()->flash('message', 'Please Login to add to wishlist');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to wishlist',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    // Method to set the product data on component mount
    public function mount($productId, $product)
    {
        $this->productId = $productId;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.prod-card.action');
    }
}
