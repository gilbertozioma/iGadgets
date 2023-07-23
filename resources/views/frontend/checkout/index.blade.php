@extends('layouts.app')

{{-- This sets the title of the page to 'Checkout'. The title will be displayed in the browser's title bar and tab. --}}
@section('title', 'Checkout')

@section('content')

{{-- This is a Livewire component, 'checkout-show', which will be rendered on this page. It's responsible for displaying the checkout form and handling the checkout process. --}}
    <livewire:frontend.checkout.checkout-show />

@endsection