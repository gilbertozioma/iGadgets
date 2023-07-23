@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Category
                    <a href="{{ url('admin/category/create') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
                {{-- The form for adding a new category --}}
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- Input field for category name --}}
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" />
                            @error('name') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Input field for category slug --}}
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" />
                            @error('slug') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Textarea for category description --}}
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                            @error('description') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Input field for category image --}}
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                            @error('image') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Checkbox for category status --}}
                        <div class="col-md-6 mb-3">
                            <label>Status</label><br/>
                            <input type="checkbox" name="status"  />
                            @error('status') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <h4>SEO Tags</h4>
                        </div>

                        {{-- Input field for category meta title --}}
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" />
                            @error('meta_title') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Textarea for category meta keywords --}}
                        <div class="col-md-12 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3"></textarea>
                            @error('meta_keyword') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Textarea for category meta description --}}
                        <div class="col-md-12 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3"></textarea>
                            @error('meta_description') <small class="text-danger">{{$message}}</small> @enderror
                        </div>

                        {{-- Submit button to save the category --}}
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
