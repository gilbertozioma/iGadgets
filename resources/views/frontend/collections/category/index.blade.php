@extends('layouts.app')

@section('title', 'All Categories')

@section('content')

<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h4 class="mb-4">Our Categories</h4>
            </div>

            {{-- This is a loop that iterates over the categories and displays each category item. --}}
            @forelse ($categories as $categoryItem)

            <div class="col-6 col-md-3">
                <div class="category-card">
                    <a href="{{ url('/collections/'.$categoryItem->slug) }}">
                        <div class="category-card-img">
                            <img src="{{ asset("$categoryItem->image") }}" class="w-100" alt="Laptop">
                        </div>
                        <div class="category-card-body">
                            <h5>{{$categoryItem->name}}</h5>
                        </div>
                    </a>
                </div>
            </div>

            {{-- This section handles the case when there are no categories available. --}}
            @empty
            <div class="col-md-12">
                <h5>No Categories Available</h5>
            </div>

            @endforelse
        </div>
    </div>
</div>

@endsection
