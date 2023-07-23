@extends('layouts.app')

@section('title', 'Confirm Password')

@section('content')

<div class="py-md-5 py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>{{ __('Confirm Password') }}</h5>
                    </div>

                    <div class="card-body">

                         {{-- Display the confirmation message --}}
                        {{ __('Please confirm your password before continuing.') }}

                         {{-- Password confirmation form --}}
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                             {{-- Password field --}}
                            <div class="mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                             {{-- Confirm Password button --}}
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>

                             {{-- Forgot Password link --}}
                            <div class="mb-3">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
