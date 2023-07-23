{{-- Extends the 'app' layout file, which usually contains the common HTML structure for the application. --}}
@extends('layouts.app')

{{-- Sets the content for the 'title' section with the value 'Search Products'. --}}
@section('title', 'Search Products')

{{-- Defines the 'content' section, where the main content of the page will be placed. --}}
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Search Results</h4>
                <div class="underline mb-4"></div>
            </div>

            {{-- Loop through the $searchProducts collection to display each product item. --}}
            @forelse ($searchProducts as $productItem)
            <div class="col-md-10">
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-card-img">
                                <label class="stock bg-success">New</label>
                                {{-- If the product has images, display the first image as a link to the product details page. --}}
                                @if ($productItem->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                    {{-- Livewire component for product actions, such as adding to cart or wishlist. --}}
                                    <livewire:frontend.prod-card.action :productId="$productItem->id" :product="$productItem" />
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <h5 class="product-name">
                                    {{-- Display the product name as a link to the product details page. --}}
                                    <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                        {{$productItem->name}}
                                    </a>
                                </h5>
                                <div>
                                    {{-- Display the selling price of the product. --}}
                                    <span class="selling-price">${{$productItem->selling_price}}</span>
                                    {{-- Display the original price of the product. --}}
                                    <span class="original-price">${{$productItem->original_price}}</span>
                                </div>
                                <p style="height: 45px; overflow: hidden">
                                    <b>Description : </b> {{ $productItem->description }}
                                    {{-- Display the product description. --}}
                                </p>
                                <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}"
                                    class="text-light px-3 more">
                                    {{-- A link to the product details page. --}}
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- If there are no products found in the search results, display a message. --}}
            @empty
            <div class="col-md-12 p-2">
                <h4>No such Products Found</h4>
            </div>
            @endforelse

            {{-- Display pagination links for search results. --}}
            <div class="col-md-10">
                {{ $searchProducts->appends(request()->input())->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
{{-- Ends the 'content' section. --}}
