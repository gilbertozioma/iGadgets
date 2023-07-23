@extends('layouts.app')

@section('title')
{{-- Sets the content for the 'title' section with the value of the 'meta_title' property of the $category variable. --}}
{{ $category->meta_title }}
@endsection

@section('meta_keyword')
{{-- Sets the content for the 'meta_keyword' section with the value of the 'meta_keyword' property of the $category variable. --}}
{{ $category->meta_keyword }}
@endsection

@section('meta_description')
{{-- Sets the content for the 'meta_description' section with the value of the 'meta_description' property of the $category variable. --}}
{{ $category->meta_description }}
@endsection

@section('content')

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>

            {{-- Includes a Livewire component called 'frontend.product.index' passing the '$category' variable to it. The Livewire component will handle the rendering and logic related to displaying products associated with the specified category. --}}
            <livewire:frontend.product.index :category="$category" />

        </div>
    </div>
</div>

@endsection
