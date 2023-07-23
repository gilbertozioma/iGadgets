<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\Orderitem;
use Illuminate\Support\Str;
use App\Mail\PlaceOrderMailable;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    // Variables to store cart data and total product amount
    public $carts, $totalProductAmount = 0;

    // Variables for user details and payment
    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    // Livewire listeners
    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    // Method to handle the 'paidOnlineOrder' event
    public function paidOnlineOrder($value)
    {
        // Update payment details for online order
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';

        // Place the order
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            // Clear the user's cart after successful order
            Cart::where('user_id', auth()->user()->id)->delete();

            try {
                // Send the order confirmation email
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                // Mail Sent Successfully
            } catch (\Exception $e) {
                // Something went wrong
            }

            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
            
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    // Method to validate all input fields
    public function validationForAll()
    {
        $this->validate();
    }

    // Validation rules for user details
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|digits:10',
            'pincode' => 'required|digits:6',
            'address' => 'required|string|max:500',
        ];
    }

    // Method to place an order
    public function placeOrder()
    {
        // Validate user details
        $this->validate();

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'iGadgets-' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        // Create order items for each cart item
        foreach ($this->carts as $cartItem) {
            $orderItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

            // Decrement the product quantity after placing the order
            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }

        return $order;
    }

    // Method to place a cash on delivery order
    public function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder) {
            // Clear the user's cart after successful order
            Cart::where('user_id', auth()->user()->id)->delete();

            try {
                // Send the order confirmation email
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlaceOrderMailable($order));
                // Mail Sent Successfully
            } catch (\Exception $e) {
                // Something went wrong
            }

            session()->flash('message', 'Order Placed Successfully');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Order Placed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something went wrong',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    // Method to calculate the total product amount in the cart
    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }

    // Method to set default user details
    public function mount()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->phone = auth()->user()->userDetail->phone ?? "";
        $this->pincode = auth()->user()->userDetail->pin_code ?? "";
        $this->address = auth()->user()->userDetail->address ?? "";
    }

    public function render()
    {
        // Calculate the total product amount
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
