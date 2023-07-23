@extends('layouts.admin')

@section('title','Edit Product')

@section('content')

<div class="row">
    <div class="col-md-12">

        {{-- Display success message if any --}}
        @if (session('message'))
            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
        @endif

        <div class="card">
            <div class="card-header">
                {{-- Title for the page --}}
                <h3>Edit Product
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

                {{-- Form to edit the product --}}
                <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

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
                        {{-- Product Colors tab --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors-tab-pane" type="button" role="tab">
                                Product Colors
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
                                    {{-- Set the selected category based on the product's category_id --}}
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected':'' }} >
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Product Name --}}
                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" />
                            </div>
                            {{-- Product Slug --}}
                            <div class="mb-3">
                                <label>Product Slug</label>
                                <input type="text" name="slug" value="{{ $product->slug }}"  class="form-control" />
                            </div>
                            {{-- Select Brand --}}
                            <div class="mb-3">
                                <label>Select Brand</label>
                                <select name="brand" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                    {{-- Set the selected brand based on the product's brand --}}
                                    <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? 'selected':'' }} >
                                        {{ $brand->name }}
                                        @if($brand->category)
                                        - for {{ $brand->category->name }}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Small Description --}}
                            <div class="mb-3">
                                <label>Small Description (500 Words)</label>
                                <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                            </div>
                            {{-- Description --}}
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        {{-- SEO Tags tab content --}}
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">
                            {{-- Meta Title --}}
                            <div class="mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $product->meta_title }}" class="form-control" />
                            </div>
                            {{-- Meta Description --}}
                            <div class="mb-3">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
                            </div>
                            {{-- Meta Keywords --}}
                            <div class="mb-3">
                                <label>Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="4">{{ $product->meta_keyword }}</textarea>
                            </div>
                        </div>

                        {{-- Details tab content --}}
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            {{-- Original Price --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="number" name="original_price" value="{{ $product->original_price }}" class="form-control" />
                                    </div>
                                </div>
                                {{-- Selling Price --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="form-control" />
                                    </div>
                                </div>
                                {{-- Quantity --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" />
                                    </div>
                                </div>
                                {{-- Trending Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Trending</label><br/>
                                        <input type="checkbox" name="trending" {{ $product->trending == '1' ? 'checked':'' }} style="width: 30px; height: 30px;" />
                                    </div>
                                </div>
                                {{-- Featured Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Featured</label><br/>
                                        <input type="checkbox" name="featured" {{ $product->featured == '1' ? 'checked':'' }} style="width: 30px; height: 30px;" />
                                    </div>
                                </div>
                                {{-- Status Checkbox --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label><br/>
                                        <input type="checkbox" name="status" {{ $product->status == '1' ? 'checked':'' }} style="width: 30px; height: 30px;" />
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
                            <div>
                                {{-- Display existing product images --}}
                                @if($product->productImages)
                                <div class="row">
                                    @foreach ($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset($image->image) }}" style="width: 80px;height:80px;" class="me-4 border" alt="Img" />
                                        {{-- Link to remove the image --}}
                                        <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="d-block">Remove</a>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <h5>No Image Added</h5>
                                @endif
                            </div>
                        </div>

                        {{-- Product Color tab content --}}
                        <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel" tabindex="0">
                            <div class="mb-3">
                                <h4>Add Product Color</h4>
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

                            {{-- Display the table of existing product colors --}}
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productColors as $prodColor)
                                        <tr class="prod-color-tr">
                                            <td>
                                                @if($prodColor->color)
                                                {{ $prodColor->color->name }}
                                                @else
                                                No Color Found
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Input group to allow updating the quantity --}}
                                                <div class="input-group mb-3" style="width:150px">
                                                    <input type="text" value="{{ $prodColor->quantity }}" class="productColorQuantity form-control form-control-sm" />
                                                    {{-- Button to update the quantity --}}
                                                    <button type="button" value="{{ $prodColor->id }}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- Button to delete the product color --}}
                                                <button type="button" value="{{ $prodColor->id }}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    {{-- Button to submit the form and update the product --}}
                    <div class="py-2 float-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // JavaScript code for handling AJAX requests
    $(document).ready(function () {
        
        // Set CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Function to update product color quantity
        $(document).on('click', '.updateProductColorBtn', function () {
            // Get the product ID from the Blade template
            var product_id = "{{ $product->id }}";
            // Get the product color ID from the clicked button's value attribute
            var prod_color_id = $(this).val();
            // Get the quantity from the input field within the same row
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
            
            // Validate the quantity
            if (qty <= 0) {
                alert('Quantity is required');
                return false;
            }

            // Prepare data for the AJAX request
            var data = {
                'product_id': product_id,
                'qty': qty
            };

            // Send the AJAX request to update the product color quantity
            $.ajax({
                type: "POST",
                url: "/admin/product-color/" + prod_color_id,
                data: data,
                success: function (response) {
                    alert(response.message)
                }
            });
        });

        // Function to delete product color
        $(document).on('click', '.deleteProductColorBtn', function () {
            // Get the product color ID from the clicked button's value attribute
            var prod_color_id = $(this).val();
            // Store the current scope of 'this' to use inside the AJAX success function
            var thisClick = $(this);

            // Send the AJAX request to delete the product color
            $.ajax({
                type: "GET",
                url: "/admin/product-color/" + prod_color_id + "/delete",
                success: function (response) {
                    // Remove the corresponding row from the table after successful deletion
                    thisClick.closest('.prod-color-tr').remove();
                    alert(response.message);
                }
            });
        });
    });
</script>

@endsection
