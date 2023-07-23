@extends('layouts.app')

{{-- This sets the title of the page to 'Cart List'. The title will be displayed in the browser's title bar and tab. --}}
@section('title', 'Cart List')

@section('content')

{{-- This is a Livewire component, 'cart-show', which will be rendered on this page. --}}
    <livewire:frontend.cart.cart-show />

@endsection
