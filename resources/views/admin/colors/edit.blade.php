@extends('layouts.admin')

@section('title', 'Edit Color')

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- Blade comment: Display a success message when the color is successfully edited --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Edit Color
                    {{-- Blade comment: Link to navigate back to the list of colors --}}
                    <a href="{{ url('admin/colors') }}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body">
                {{-- Blade comment: Form to edit an existing color --}}
                <form action="{{ url('admin/colors/'.$color->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Color Name</label>
                        {{-- Blade comment: Input field for updating the color name --}}
                        <input type="text" name="name" value="{{ $color->name }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Color Code</label>
                        {{-- Blade comment: Input field for updating the color code --}}
                        <input type="text" name="code" value="{{ $color->code }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Status</label> <br/>
                        {{-- Blade comment: Checkbox for updating the status of the color: Hidden or Visible --}}
                        <input type="checkbox" name="status" {{ $color->status ? 'checked':'' }} style="width:30px;height:30px" /> Checked=Hidden, Unchecked=Visible
                    </div>
                    <div class="mb-3">
                        {{-- Blade comment: Submit button to update the color --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
