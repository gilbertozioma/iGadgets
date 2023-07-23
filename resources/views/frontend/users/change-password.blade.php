@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                {{-- Display success message if present --}}
                @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                {{-- Display validation errors if any --}}
                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                {{-- Card for changing password --}}
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">Change Password
                            {{-- Link to go back to the profile page --}}
                            <a href="{{ url('profile') }}" class="btn-sm btn-danger text-decoration-none float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- Form to change the password --}}
                        <form action="{{ url('change-password') }}" method="POST">
                            @csrf
                            {{-- Input field for current password --}}
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" />
                            </div>
                            {{-- Input field for new password --}}
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            {{-- Input field to confirm new password --}}
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                            {{-- Submit button to update password --}}
                            <div class="mb-3 text-end">
                                <hr>
                                <button type="submit" class="btn btn-primary">Update Password</button>
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
