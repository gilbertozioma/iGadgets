@extends('layouts.app')

@section('title', 'Thank You for Shopping')

@section('content')
{{-- Start of the Thank You page content section --}}
<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                {{-- Display a success message if available --}}
                @if (session('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                {{-- Start of the thank you card --}}
                <div class="p-4 shadow bg-light">
                    {{-- Display the logo if available --}}
                    {{-- @if ($websiteLogo)
                    <img src="{{ asset($websiteLogo) }}" class=" shadow p-2 mb-3" alt="Logo"
                    style="max-height: 60px; background-color: #7617b6">
                    @else
                    <h2>No Logo Yet</h2>
                    @endif --}}
                    
                        <i class="text-center fa-solid fa-handshake" style="font-size: 100px; color: #7617b6"></i>

                    {{-- Display a thank you message --}}
                    <h4 class="mb-5">Thank You for Shopping with iGadgets</h4>

                    {{-- Button to redirect users to the collections page for more shopping --}}
                    <a href="{{ url('collections') }}" class="btn btn-sm text-light"
                    style="background-color: #7617b6;">Continue Shopping</a>
                </div>
                {{-- End of the thank you card --}}
            </div>
        </div>
    </div>
</div>
{{-- End of the Thank You page content section --}}
@endsection
