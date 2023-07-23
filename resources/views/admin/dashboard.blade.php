@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">

        {{-- Display success message if available --}}
        @if(session('message'))
            <h6 class="alert alert-success">{{ session('message') }},</h6>
        @endif

        <div class="me-md-3 me-xl-5">
            <h2>Dashboard,</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
            <hr>
        </div>

        <div class="row">
            {{-- Card: Total Orders --}}
            <a href="{{ url('admin/orders') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Orders</label>
                    <h1>{{ $totalOrder }}</h1>
                </div>
            </a>

            {{-- Card: Today Orders --}}
            <a href="{{ url('admin/orders') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Today Orders</label>
                    <h1>{{ $todayOrder }}</h1>
                </div>
            </a>

            {{-- Card: This Month Orders --}}
            <a href="{{ url('admin/orders') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>This Month Orders</label>
                    <h1>{{ $thisMonthOrder }}</h1>
                </div>
            </a>
                
            {{-- Card: Year Orders --}}
            <a href="{{ url('admin/orders') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <label>Year Orders</label>
                    <h1>{{ $thisYearOrder }}</h1>
                </div>
            </a>
        </div>

        <hr>

        <div class="row">
            {{-- Card: Total Products --}}
            <a href="{{ url('admin/products') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Products</label>
                    <h1>{{ $totalProducts }}</h1>
                </div>
            </a>
                
            {{-- Card: Total Categories --}}
            <a href="{{ url('admin/category') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Total Categories</label>
                    <h1>{{ $totalCategories }}</h1>
                </div>
            </a>
                
            {{-- Card: Total Brands --}}
            <a href="{{ url('admin/brands') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Total Brands</label>
                    <h1>{{ $totalBrands }}</h1>
                </div>
            </a> 
        </div>

        <hr>

        <div class="row">
            {{-- Card: All Users --}}
            <a href="{{ url('admin/users') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>All Users</label>
                    <h1>{{ $totalAllUsers }}</h1>
                </div>
            </a>
                
            {{-- Card: Total Users --}}
            <a href="{{ url('admin/users') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Total Users</label>
                    <h1>{{ $totalUser }}</h1>
                </div>
            </a>
                
            {{-- Card: Total Admins --}}
            <a href="{{ url('admin/users') }}" class="text-white text-decoration-none col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Total Admins</label>
                    <h1>{{ $totalAdmin }}</h1>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
