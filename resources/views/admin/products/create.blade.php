@extends('layouts.admin')

@section('title','Add Product')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- Title for the page --}}
                <h3>Add Product
                    {{-- Button to go back to the products list page --}}
                    <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm text-white float-end">
                        BACK
                    </a>
                </h3>
            </div>
            <div class="card-body">

                {{-- Display validation errors if any --}}
                @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                @endif

                {{-- Form to add a new product --}}
                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Navigation tabs for different sections of the product form --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        {{-- Home tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                Home
                            </button>
                        </li>
                        {{-- SEO Tags tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">
                                SEO Tags
                            </button>
                        </li>
                        {{-- Details tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                                Details
                            </button>
                        </li>
                        {{-- Product Image tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                Product Image
                            </button>
                        </li>
                        {{-- Product Color tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                Product Color
                            </button>
                        </li>
                    </ul>

                    {{-- Tab content for each section --}}
                    <div class="tab-content" id="myTabContent">
                        {{-- Home tab content --}}
                        <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            {{-- Category selection --}}
                            <div class="mb-3">
                                <label>Select Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Brand selection --}}
                            <div class="mb-3">
                                <label>Select Brand</label>
                                <select name="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->name }}">
                                        {{ $brand->name }} 
                                        @if($brand->category)
                                        - for {{ $brand->category->name }}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Product Name --}}
                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control" />
                            </div>
                            {{-- Product Slug --}}
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" class="form-control" />
                            </div>
                            {{-- Small Description --}}
                            <div class="mb-3">
                                <label>Small Description (500 Words)</label>
                                <textarea name="small_description" class="form-control" rows="4"></textarea>
                            </div>
                            {{-- Description --}}
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        {{-- SEO Tags tab content --}}
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            {{-- Meta Title --}}
                            <div class="mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" />
                            </div>
                            {{-- Meta Description --}}
                            <div class="mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="4"></textarea>
                            </div>
                            {{-- Meta Keyword --}}
                            <div class="mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        {{-- Details tab content --}}
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="row">
                                {{-- Original Price --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="number" name="original_price" class="form-control" />
                                    </div>
                                </div>
                                {{-- Selling Price --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" class="form-control" />
                                    </div>
                                </div>
                                {{-- Quantity --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control" />
                                    </div>
                                </div>
                                {{-- Trending Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label><br/>
                                        <input type="checkbox" name="trending" style="width: 30px; height: 30px;" />
                                    </div>
                                </div>
                                {{-- Featured Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Featured</label><br/>
                                        <input type="checkbox" name="featured" style="width: 30px; height: 30px;" />
                                    </div>
                                </div>
                                {{-- Status Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label><br/>
                                        <input type="checkbox" name="status" style="width: 30px; height: 30px;" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Product Image tab content --}}
                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            {{-- Upload Product Images --}}
                            <div class="mb-3">
                                <label>Upload Product Images</label>
                                <input type="file" name="image[]" multiple class="form-control" />
                            </div>
                        </div>

                        {{-- Product Color tab content --}}
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                            {{-- Select Color --}}
                            <div class="mb-3">
                                <label>Select Color</label>
                                <hr/>
                                <div class="row">
                                    {{-- Loop through available colors to create checkboxes --}}
                                    @forelse ($colors as $coloritem)
                                    <div class="col-md-3">
                                        <div class="p-2 border mb-3">
                                            {{-- Color checkbox --}}
                                            Color: <input type="checkbox" name="colors[{{ $coloritem->id }}]" value="{{ $coloritem->id }}" />
                                            {{ $coloritem->name }}
                                            <br/>
                                            {{-- Quantity input for the color --}}
                                            Quantity: <input type="number" name="colorquantity[{{ $coloritem->id }}]" style="width:70px; border:1px solid" />
                                        </div>
                                    </div>
                                    @empty
                                    {{-- If no colors are available --}}
                                    <div class="col-md-12">
                                        <h1>No colors found</h1>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit button for the form --}}
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
