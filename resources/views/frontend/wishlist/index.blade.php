@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
    {{-- Including the Livewire component for displaying the wishlist --}}
    <livewire:frontend.wishlist-show />
@endsection
