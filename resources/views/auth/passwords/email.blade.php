@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="py-md-5 py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>{{ __('Reset Password') }}</h5>
                    </div>

                    <div class="card-body">

                        {{-- Display success message if password reset link has been sent --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Password reset email form --}}
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            {{-- Email input field --}}
                            <div class="mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- "Send Password Reset Link" button --}}
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
