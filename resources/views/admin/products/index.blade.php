@extends('layouts.admin')

@section('title', 'Products')

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- Display success message from session if available --}}
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        {{-- Link to add new products --}}
                        <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-end">
                            Add Products
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop through the products and display them in the table --}}
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            {{-- Display category name if available, otherwise show "No Category" --}}
                                            @if ($product->category)
                                                {{ $product->category->name }}
                                            @else
                                                No Category
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        {{-- Show "Hidden" if product status is '1', otherwise "Visible" --}}
                                        <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                        <td>
                                            {{-- Link to edit the product with its ID --}}
                                            <a href="{{ url('admin/products/' . $product->id . '/edit') }}"
                                                class="text-light btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            {{-- Link to delete the product with confirmation dialog --}}
                                            <a href="{{ url('admin/products/' . $product->id . '/delete') }}"
                                                onclick="return confirm('Are you sure, you want to delete this data?')"
                                                class="text-light btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Products Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{-- Display pagination links for navigating between product pages --}}
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
