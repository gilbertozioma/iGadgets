@extends('layouts.admin')

@section('title', 'Colors')

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- Blade comment: Display a success message if it exists in the session --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Colors List
                    {{-- Blade comment: Link to navigate to the page for adding a new color --}}
                    <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Color
                    </a>
                </h3>
            </div>
            <div class="card-body">
                {{-- Blade comment: Table to display the list of colors --}}
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            {{-- Blade comment: Table headers for columns --}}
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Blade comment: Loop through the $colors array and display each color as a row in the table --}}
                        @foreach ($colors as $item)
                        <tr>
                            {{-- Blade comment: Display the ID of the color --}}
                            <td>{{ $item->id }}</td>
                            {{-- Blade comment: Display the name of the color --}}
                            <td>{{ $item->name }}</td>
                            {{-- Blade comment: Display the color code --}}
                            <td>{{ $item->code }}</td>
                            {{-- Blade comment: Display the status of the color: Hidden or Visible --}}
                            <td>{{ $item->status ? 'Hidden' : 'Visible' }}</td>
                            <td>
                                {{-- Blade comment: Link to navigate to the page for editing the current color --}}
                                <a href="{{ url('admin/colors/'.$item->id.'/edit') }}" class="text-light btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                {{-- Blade comment: Link to delete the current color. A confirmation dialog will appear before deletion. --}}
                                <a href="{{ url('admin/colors/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="text-light btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
