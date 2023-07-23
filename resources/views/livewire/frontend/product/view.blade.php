{{-- Product Details Section --}}
<div class="py-3 py-md-5">
    <div class="container">

        {{-- Product Image and Information --}}
        <div class="row">
            {{-- Product Image Section --}}
            <div class="col-md-5 mt-3">
                <div class="bg-white border" wire:ignore>
                    {{-- Display product images using exzoom plugin --}}
                    @if($product->productImages->count() > 0)
                    <div class="exzoom" id="exzoom">
                        <div class="exzoom_img_box">
                            <ul class='exzoom_img_ul'>
                                {{-- Loop through product images and display each image in a list --}}
                                @foreach ($product->productImages as $itemImg)
                                <li><img src="{{ asset($itemImg->image) }}" /></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> &lt; </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> &gt; </a>
                        </p>
                    </div>
                    @else
                    {{-- Display message if no image is available for the product --}}
                    No Image Added
                    @endif
                </div>
            </div>

            {{-- Product Information Section --}}
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    {{-- Product Name --}}
                    <h4 class="product-name">
                        {{ $product->name }}
                    </h4>
                    <hr>
                    {{-- Product Path (category and product name) --}}
                    <p class="product-path">
                        Home / {{ $product->category->name }} / {{ $product->name }}
                    </p>
                    {{-- Product Brand --}}
                    <p class="product-path">Brand : {{ $product->brand }}</p>
                    <div>
                        {{-- Product Selling Price and Original Price --}}
                        <span class="selling-price">${{ $product->selling_price }}</span>
                        <span class="original-price">${{ $product->original_price }}</span>
                    </div>
                    <div>
                        {{-- Check if the product has color options --}}
                        @if($product->productColors->count() > 0)
                            @if($product->productColors)
                                {{-- Loop through product colors and display color labels --}}
                                @foreach($product->productColors as $colorItem)
                                <label class="colorSelectionLabel" style="background-color: {{ $colorItem->color->code }}"
                                    wire:click="colorSelected({{ $colorItem->id }})"
                                    >
                                    {{ $colorItem->color->name }}
                                </label>
                                @endforeach
                            @endif
                            <div>
                                {{-- Show stock status based on the selected color --}}
                                @if ($this->prodColorSelectedQuantity == 'outOfStock')
                                <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                @elseif($this->prodColorSelectedQuantity > 0)
                                <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @endif
                            </div>
                        @else
                            {{-- Show stock status if the product does not have color options --}}
                            @if($product->quantity)
                            <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                            @else
                            <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                            @endif
                        @endif
                    </div>
                    <div class="mt-2">
                        {{-- Quantity Input Section with Increment and Decrement Buttons --}}
                        <div class="input-group">
                            <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                            <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                            <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        {{-- Add to Cart and Add to Wishlist Buttons --}}
                        <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                            <i class="fa fa-shopping-cart"></i> Add To Cart
                        </button>
                        <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                            <span wire:loading.remove wire:target="addToWishList">
                                <i class="fa fa-heart"></i> Add To Wishlist
                            </span>
                            <span wire:loading wire:target="addToWishList">Adding...</span>
                        </button>
                    </div>
                    <div class="mt-3">
                        {{-- Product Small Description --}}
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {!! $product->small_description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Description --}}
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Related Category Products Section --}}
<div class="py-3 py-md-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3>
                    Related
                    @if($category) {{ $category->name }} @endif
                    Products
                </h3>
                <div class="underline"></div>
            </div>

            <div class="col-md-12">
                @if ($category)
                {{-- Owl Carousel to display related products --}}
                <div class="owl-carousel owl-theme four-carousel">
                    {{-- Loop through related products and display each product card --}}
                    @foreach ($category->relatedProducts as $relatedProductItem)
                    <div class="item mb-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($relatedProductItem->productImages->count() > 0)
                                {{-- Display product image with a link to the product details page --}}
                                <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                    <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                        {{$relatedProductItem->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{$relatedProductItem->selling_price}}</span>
                                    <span class="original-price">${{$relatedProductItem->original_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                {{-- Display a message if no related products are available --}}
                <div class="p-2">
                    <h4>No Related Products Available</h4>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- Related Brand Products Section --}}
<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3>
                    Related
                    @if($product) {{ $product->brand }} @endif
                    Products
                </h3>
                <div class="underline"></div>
            </div>

            <div class="col-md-12">
                @if ($category)
                {{-- Owl Carousel to display related products from the same brand --}}
                <div class="owl-carousel owl-theme four-carousel">
                    {{-- Loop through related products from the same brand and display each product card --}}
                    @foreach ($category->relatedProducts as $relatedProductItem)
                        @if ($relatedProductItem->brand == "$product->brand")
                        <div class="item mb-3">
                            <div class="product-card">
                                <div class="product-card-img">
                                    @if ($relatedProductItem->productImages->count() > 0)
                                    {{-- Display product image with a link to the product details page --}}
                                    <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                        <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                    </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            {{$relatedProductItem->name}}
                                        </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">${{$relatedProductItem->selling_price}}</span>
                                        <span class="original-price">${{$relatedProductItem->original_price}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @else
                {{-- Display a message if no related products from the same brand are available --}}
                <div class="p-2">
                    <h4>No Related Products Available</h4>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

</div>

{{-- JavaScript Scripts Section --}}
@push('scripts')

<script>
    $(function(){

        // Initialize exzoom plugin for product image gallery
        $("#exzoom").exzoom({
            "navWidth": 60,
            "navHeight": 60,
            "navItemNum": 5,
            "navItemMargin": 7,
            "navBorder": 1,
            "autoPlay": false,
            "autoPlayTimeout": 2000
        });

    });

    // Initialize Owl Carousel for related products
    $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        dots:true,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
</script>

@endpush
