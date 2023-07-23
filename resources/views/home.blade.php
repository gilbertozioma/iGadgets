{{-- Extending the layout named "app" --}}
@extends('layouts.app')

{{-- Defining the content section of the "app" layout --}}
@section('content')

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- Checking if there is a "status" session message --}}
                    @if (session('status'))
                        {{-- Displaying the "status" session message as a success alert --}}
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="text-center p-5">
                        Welcome {{ Auth::user()->name }}! <i class="fa-regular fa-face-smile fa-beat" style="color: #7617b6"></i>
                    </h1>
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="btn text-decoration-none text-light text-center" style="background-color: #7617b6">
                            Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Ending the content section of the "app" layout --}}
@endsection
