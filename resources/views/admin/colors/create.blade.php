@extends('layouts.admin')

@section('title', 'Add Colors')

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- Blade comment: Display a success message when a color is successfully created --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Add Color
                    {{-- Blade comment: Link to navigate back to the list of colors --}}
                    <a href="{{ url('admin/colors') }}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body">
                {{-- Blade comment: Form to add a new color --}}
                <form action="{{ url('admin/colors/create') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Color Name</label>
                        {{-- Blade comment: Input field for entering the color name --}}
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        {{-- Blade comment: Input field for entering the color code --}}
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        {{-- Blade comment: Checkbox for selecting the status of the color: Hidden or Visible --}}
                        <input type="checkbox" name="status" style="width:30px;height:30px" /> Checked=Hidden, Unchecked=Visible
                    </div>
                    <div class="mb-3">
                        {{-- Blade comment: Submit button to save the new color --}}
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
