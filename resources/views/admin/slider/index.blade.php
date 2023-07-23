@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- Display success message if available --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        {{-- Table displaying the list of sliders --}}
        <div class="card">
            <div class="card-header">
                <h3>Slider List
                    <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Slider
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop through sliders to display their details --}}
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td class="w-25">{{ $slider->title }}</td>
                                <td class="w-25">{{ $slider->description }}</td>
                                <td>
                                    {{-- Display slider image with a width and height of 70px --}}
                                    <img src="{{ asset("$slider->image") }}" style="width: 70px; height: 70px" alt="Slider">
                                </td>
                                <td>{{ $slider->status == '0' ? 'Visible':'Hidden' }}</td>
                                <td>
                                    {{-- Edit button linking to the slider's edit page --}}
                                    <a href="{{ url('admin/sliders/'.$slider->id.'/edit') }}" class="text-light btn-sm btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i></a>

                                    {{-- Delete button with confirmation popup --}}
                                    <a href="{{ url('admin/sliders/'.$slider->id.'/delete') }}" 
                                        onclick="return confirm('Are you sure you want to delete this slider?');"
                                         class="text-light btn-sm btn-danger"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
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
