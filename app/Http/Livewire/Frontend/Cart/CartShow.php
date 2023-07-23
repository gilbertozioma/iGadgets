<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    // Variable to store the cart data
    public $cart, $totalPrice = 0;

    // Method to decrement the quantity of a cart item
    public function decrementQuantity(int $cartId)
    {
        // Retrieve the cart data for the provided cart ID and authenticated user
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->quantity > 1) {
                // Decrement the quantity and show success message
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                ]);
            } else {
                // Show message when quantity cannot be less than 1
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Quantity cannot be less than 1',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            // Show error message if something went wrong
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    // Method to increment the quantity of a cart item
    public function incrementQuantity(int $cartId)
    {
        // Retrieve the cart data for the provided cart ID and authenticated user
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                // If the cart item has a specific color, check its quantity
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    // Increment the quantity and show success message
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    // Show message when the maximum quantity is reached for the color
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $productColor->quantity . ' Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                // If the cart item does not have a specific color, check its quantity
                if ($cartData->product->quantity > $cartData->quantity) {
                    // Increment the quantity and show success message
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    // Show message when the maximum quantity is reached for the product
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only ' . $cartData->product->quantity . ' Quantity Available',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            }
        } else {
            // Show error message if something went wrong
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 404
            ]);
        }
    }

    // Method to remove a cart item
    public function removeCartItem(int $cartId)
    {
        // Retrieve the cart data for the provided cart ID and authenticated user
        $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if ($cartRemoveData) {
            // Delete the cart item and emit the 'CartAddedUpdated' event
            $cartRemoveData->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Cart Item Removed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            // Show error message if something went wrong
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong!',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    public function render()
    {
        // Retrieve the cart data for the authenticated user
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
