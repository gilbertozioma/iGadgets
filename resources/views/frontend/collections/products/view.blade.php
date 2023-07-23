@extends('layouts.app')

@section('title')
{{-- Sets the content for the 'title' section with the value of the 'meta_title' property of the $product variable. --}}
{{ $product->meta_title }}
@endsection

@section('meta_keyword')
{{-- Sets the content for the 'meta_keyword' section with the value of the 'meta_keyword' property of the $product variable. --}}
{{ $product->meta_keyword }}
@endsection

@section('meta_description')
{{--  Sets the content for the 'meta_description' section with the value of the 'meta_description' property of the $product variable. --}}
{{ $product->meta_description }}
@endsection

@section('content')

    <div>
        {{-- Includes a Livewire component called 'frontend.product.view', passing the '$category' and '$product' variables to it. The Livewire component will handle the rendering and logic related to displaying the details of the specified product within the specified category. --}}
        <livewire:frontend.product.view :category="$category" :product="$product" />
    </div>

@endsection
