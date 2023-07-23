{{-- This div contains the entire Wishlist view --}}
<div>
    {{-- This div sets the padding for the Wishlist section --}}
    <div class="py-3 py-md-5">
        <div class="container">
            {{-- Wishlist title --}}
            <h3>My Wishlist</h3>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        {{-- Cart header for larger screens --}}
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                {{-- Column for product names --}}
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                {{-- Column for product prices --}}
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                {{-- Column for the remove button --}}
                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Loop through each product in the wishlist --}}
                        @forelse ($wishlist as $wishlistItem)
                            {{-- Check if the wishlist item has a related product --}}
                            @if ($wishlistItem->product)
                            <div class="cart-item">
                                <div class="row">
                                    {{-- Column for product names --}}
                                    <div class="col-md-6 my-auto">
                                        {{-- Link to view the product details --}}
                                        <a href="{{ url('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug) }}">
                                            <label class="product-name">
                                                {{-- Check if the product has images --}}
                                                @if ($wishlistItem->product->productImages->count() > 0)
                                                {{-- Display the first product image --}}
                                                <img src="{{ asset($wishlistItem->product->productImages[0]->image) }}"
                                                    style="width: 50px; height: 50px"
                                                    alt="{{ $wishlistItem->product->name }}" />
                                                @else
                                                {{-- Display a default no-image image --}}
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" style="width: 50px; height: 50px"
                                                    alt="{{ $wishlistItem->product->name }}" />
                                                @endif

                                                {{-- Product name --}}
                                                {{ $wishlistItem->product->name }}
                                            </label>
                                        </a>
                                    </div>
                                    {{-- Column for product prices --}}
                                    <div class="col-md-2 my-auto">
                                        <label class="price">${{ $wishlistItem->product->selling_price }} </label>
                                    </div>
                                    {{-- Column for the remove button --}}
                                    <div class="col-md-4 col-12 my-auto">
                                        <div class="remove">
                                            {{-- Remove button with wire:click event to remove the item from the wishlist --}}
                                            <button type="button" wire:click="removeWishlistItem({{ $wishlistItem->id }})" class="btn btn-danger btn-sm">
                                                {{-- Show 'Remove' text when not removing --}}
                                                <span wire:loading.remove wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                {{-- Show 'Removing' text when removing --}}
                                                <span wire:loading wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                    <i class="fa fa-trash"></i> Removing
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        {{-- If the wishlist is empty, display a message --}}
                        @empty
                            <h4>No Wishlist Added</h4>
                        @endforelse

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
