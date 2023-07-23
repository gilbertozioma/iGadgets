{{-- Outer container for the product listing --}}
<div>
    <div class="row">
        {{-- Column for displaying filters (brands and price sorting) --}}
        <div class="col-md-3">
            {{-- Brands filter --}}
            @if ($category->brands)
            <div class="card">
                <div class="card-header"><h4>Brands</h4></div>
                <div class="card-body">
                    {{-- Display checkboxes for each brand item in the category --}}
                    @foreach ($category->brands as $brandItem)
                    <label class="d-block">
                        <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->name}}" /> {{$brandItem->name}}
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Price sorting filter --}}
            <div class="card mt-3">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    {{-- Radio buttons for selecting price sorting (high to low or low to high) --}}
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> High to Low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> Low to High
                    </label>
                </div>
            </div>

        </div>
        {{-- Column for displaying product cards --}}
        <div class="col-md-9">

            <div class="row">
                {{-- Loop through the products and display product cards --}}
                @forelse ($products as $productItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            {{-- Display product stock status (In Stock or Out of Stock) --}}
                            <div class="product-card-img">
                                @if ($productItem->quantity > 0)
                                <label class="stock bg-success">In Stock</label>
                                @else
                                <label class="stock bg-danger">Out of Stock</label>
                                @endif

                                {{-- Display product image (if available) with a link to the product details page --}}
                                @if ($productItem->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                </a>
                                @endif
                            </div>
                            {{-- Display product details (brand, name, selling price, and original price) --}}
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                        {{$productItem->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{$productItem->selling_price}}</span>
                                    <span class="original-price">${{$productItem->original_price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                {{-- Display a message if there are no products available for the category --}}
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Products Available for {{ $category->name }}</h4>
                    </div>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
