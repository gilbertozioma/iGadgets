@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
{{-- Start of the carousel section --}}
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
        {{-- Loop through the $sliders array to display each slider item --}}
        @foreach ($sliders as $key => $sliderItem)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            @if ($sliderItem->image)
            {{-- Display the slider image --}}
            <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
            @endif
            <div class="carousel-caption d-none d-md-block">
                {{-- Display the slider caption with title and description --}}
                <div class="custom-carousel-content">
                    <h1>{!! $sliderItem->title !!}</h1>
                    <p>{!! $sliderItem->description !!}</p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Carousel control buttons for navigation --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
{{-- End of the carousel section --}}

{{-- Start of the welcome section --}}
<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Welcome to iGadgets E-Commerce</h4>
                <div class="underline mx-auto"></div>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type
                    specimen book. It has survived not only five centuries, but also the leap
                    into electronic typesetting, remaining essentially unchanged.
                </p>
            </div>
        </div>
    </div>
</div>
{{-- End of the welcome section --}}

{{-- Start of the Trending Products section --}}
<div class="py-5 trending">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underline mb-4"></div>
            </div>

            {{-- Check if there are any trending products available --}}
            @if($trendingProducts)
            <div class="col-md-12">
                {{-- Display the trending products in a carousel --}}
                <div class="owl-carousel owl-theme four-carousel">
                    {{-- Loop through the $trendingProducts array to display each product item --}}
                    @foreach ($trendingProducts as $productItem)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-success new">New</label>
                                {{-- Display the product image --}}
                                @if ($productItem->productImages)
                                <a href="{{ url('collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                    {{-- Include the Livewire component for product actions --}}
                                    <livewire:frontend.prod-card.action :productId="$productItem->id" :product="$productItem" />
                                </a> 
                                @endif
                            </div>
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Products Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- End of the Trending Products section --}}

{{-- Start of the New Arrival section --}}
<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals
                    <a href="{{ url('new-arrivals') }}" class="btn more float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>

            {{-- Check if there are any new arrival products available --}}
            @if($newArrivalsProducts)
            <div class="col-md-12">
                {{-- Display the new arrival products in a carousel --}}
                <div class="owl-carousel owl-theme four-carousel">
                    {{-- Loop through the $newArrivalsProducts array to display each product item --}}
                    @foreach ($newArrivalsProducts as $productItem)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-success new">New</label>
                                {{-- Display the product image --}}
                                @if ($productItem->productImages)
                                <a href="{{ url('collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                    {{-- Include the Livewire component for product actions --}}
                                    <livewire:frontend.prod-card.action :productId="$productItem->id" :product="$productItem" />
                                </a> 
                                @endif     
                            </div>
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No New Arrivals Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- End of the New Arrival section --}}

{{-- Start of the Featured Products section --}}
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Featured Products
                    <a href="{{ url('featured-products') }}" class="btn more float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            {{-- Check if there are any featured products available --}}
            @if($featuredProducts)
            <div class="col-md-12">
                {{-- Display the featured products in a carousel --}}
                <div class="owl-carousel owl-theme four-carousel">
                    {{-- Loop through the $featuredProducts array to display each product item --}}
                    @foreach ($featuredProducts as $productItem)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-success new">New</label>
                                {{-- Display the product image --}}
                                @if ($productItem->productImages)
                                <a href="{{ url('collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                    <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                    {{-- Include the Livewire component for product actions --}}
                                    <livewire:frontend.prod-card.action :productId="$productItem->id" :product="$productItem" />
                                </a> 
                                @endif
                            </div>
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
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Featured Products Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- End of the Featured Products section --}}

@endsection

{{-- Script to initialize the owl carousel --}}
@section('script')
<script>
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
    })
</script>
@endsection
