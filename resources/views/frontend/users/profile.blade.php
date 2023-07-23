@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>User Profile
                    {{-- Button to change password, linked to the change-password route --}}
                    <a href="{{ url('change-password') }}" class="btn btn-warning float-end">Change Password ?</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>

            <div class="col-md-10">

                {{-- Display success message if present --}}
                @if (session('message'))
                    <p class="alert alert-success">{{ session('message') }}</p>
                @endif

                {{-- Display validation errors if any --}}
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                {{-- Card for displaying user details --}}
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        {{-- Title for User Details section --}}
                        <h4 class="mb-0 text-white">User Details</h4>
                    </div>
                    <div class="card-body">
                        {{-- Form to update user profile data, linked to the profile route --}}
                        <form action="{{ url('profile') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Username</label>
                                        {{-- Input field for updating the username, pre-filled with the current username --}}
                                        <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Email Address</label>
                                        {{-- Read-only input field for displaying the email address --}}
                                        <input type="text" readonly value="{{ Auth::user()->email }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        {{-- Input field for updating the phone number, pre-filled with the current phone number if available --}}
                                        <input type="text" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Zip/Pin Code</label>
                                        {{-- Input field for updating the zip/pin code, pre-filled with the current zip/pin code if available --}}
                                        <input type="text" name="pin_code" value="{{ Auth::user()->userDetail->pin_code ?? '' }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label>Address</label>
                                        {{-- Textarea for updating the address, pre-filled with the current address if available --}}
                                        <textarea name="address" class="form-control" rows="3">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{-- Button to submit the form and save the updated data --}}
                                    <button type="submit" class="btn btn-primary">Save Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End of the content section --}}
@endsection
