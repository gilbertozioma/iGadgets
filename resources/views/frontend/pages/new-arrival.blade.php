{{-- Extends the 'app' layout file, which usually contains the common HTML structure for the application. --}}
@extends('layouts.app')

{{-- Sets the content for the 'title' section with the value 'New Arrivals Product'. --}}
@section('title', 'New Arrivals Product')

{{-- Defines the 'content' section, where the main content of the page will be placed. --}}
@section('content')

<div class="py-5 new-arrival">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline mb-4"></div>
            </div>

            {{-- Loop through the $newArrivalsProducts collection to display each product item. --}}
            @forelse ($newArrivalsProducts as $productItem)
            <div class="col-md-3">
                <div class="product-card">
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

                    <div class="product-card-body">
                        {{-- Product details such as brand, name, and price. --}}
                        <p class="product-brand">{{ $productItem->brand }}</p>
                        {{-- Display the product brand. --}}
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
            {{-- If there are no new arrival products available, display a message. --}}
            @empty
            <div class="col-md-12 p-2">
                <h4>No Products Available</h4>
            </div>
            @endforelse

            {{-- A button with class 'btn btn-warning' and class 'more' to link to the 'collections' page. --}}
            <div class="text-center">
                <a href="{{ url('collections') }}" class="btn btn-warning more px-3">Shop More</a>
            </div>

        </div>
    </div>
</div>

@endsection
{{-- Ends the 'content' section. --}}
