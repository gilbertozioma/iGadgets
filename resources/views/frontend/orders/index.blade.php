@extends('layouts.app')
{{-- Extends the 'app' layout file, which usually contains the common HTML structure for the application. --}}

{{-- Sets the content for the 'title' section with the value 'My Orders'. --}}
@section('title','My Orders')
{{-- Defines the 'content' section, where the main content of the page will be placed. --}}
@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4"> My Orders </h4>
                        <hr>

                        <div class="table-responsive">
                        {{-- A table with bordered and striped rows. --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>Username</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- Loop through the $orders collection to display each order. --}}
                                    @forelse ($orders as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->tracking_no }}</td>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->payment_mode }}</td>
                                        {{-- Formats the 'created_at' date property as 'day-month-year'. --}}
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item->status_message }}</td>
                                        {{-- Link to view the details of the specific order using its 'id'. --}}
                                            <td><a href="{{ url('orders/'.$item->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                        </tr>
                                        
                                    {{-- Display this row if no orders are available in the $orders collection. --}}
                                    @empty
                                        <tr>
                                            <td colspan="7">No Orders available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        {{-- Pagination links to navigate through the order list. --}}
                            <div>
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection