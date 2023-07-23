
<div class="outer-container">
    {{-- Actions for adding the product to the cart and wishlist --}}
    <div class="actions">
        {{-- Add to Cart button --}}
        <a class="add-to-cart" wire:click="addToCart({{$productId}})">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
        {{-- Add to Wishlist button --}}
        <a class="add-to-wishlist" wire:click="addToWishlist({{ $productId }})">
            <i class="fa-solid fa-heart"></i>
        </a>
    </div>
</div>
