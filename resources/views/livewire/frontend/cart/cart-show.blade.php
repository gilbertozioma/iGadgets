<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>

            {{-- Shopping Cart Items --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        {{-- Cart Header (Visible only on larger screens) --}}
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Cart Items Loop --}}
                        @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}">
                                                <label class="product-name">

                                                    {{-- Display product image --}}
                                                    @if ($cartItem->product->productImages->count() > 0)
                                                        <img src="{{ asset($cartItem->product->productImages[0]->image) }}"
                                                            style="width: 50px; height: 50px" alt="">
                                                    @else
                                                        <img src="" style="width: 50px; height: 50px" alt="">
                                                    @endif

                                                    {{-- Display product name --}}
                                                    {{ $cartItem->product->name }}

                                                    {{-- Display product color (if available) --}}
                                                    @if ($cartItem->productColor)
                                                        @if ($cartItem->productColor->color)
                                                            <span>- Color: {{ $cartItem->productColor->color->name }}</span>
                                                        @endif
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            {{-- Display product price --}}
                                            <label class="price">${{ $cartItem->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            {{-- Quantity Input --}}
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <button type="button" wire:loading.attr="disabled"
                                                        wire:click="decrementQuantity({{ $cartItem->id }})"
                                                        class="btn btn1"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $cartItem->quantity }}"
                                                        class="input-quantity" />
                                                    <button type="button" wire:loading.attr="disabled"
                                                        wire:click="incrementQuantity({{ $cartItem->id }})"
                                                        class="btn btn1"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            {{-- Display total price for the quantity --}}
                                            <label class="price">${{ $cartItem->product->selling_price * $cartItem->quantity }}</label>
                                            @php $totalPrice += $cartItem->product->selling_price * $cartItem->quantity @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            {{-- Remove Button --}}
                                            <div class="remove">
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="removeCartItem({{ $cartItem->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    {{-- Show 'Remove' text when not removing, and 'Removing' when removing --}}
                                                    <span wire:loading.remove wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa fa-trash"></i> Remove
                                                    </span>
                                                    <span wire:loading wire:target="removeCartItem({{ $cartItem->id }})">
                                                        <i class="fa fa-trash"></i> Removing
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            {{-- Show a message when there are no cart items --}}
                            <div>No Cart Items available</div>
                        @endforelse

                    </div>
                </div>
            </div>

            {{-- Continue Shopping and Checkout Buttons --}}
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>
                        {{-- Button to continue shopping --}}
                        <a href="{{ url('/collections') }}" class="btn btn-primary text-decoration-none">Continue Shopping</a>
                    </h5>
                </div>
                <div class="col-md-4 mt-3">
                    {{-- Cart Total and Checkout Button --}}
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span class="float-end">${{ $totalPrice }}</span>
                        </h4>
                        <hr>
                        {{-- Button to proceed to checkout --}}
                        <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
