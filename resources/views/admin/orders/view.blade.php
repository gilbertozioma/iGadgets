@extends('layouts.admin')

@section('title','My Order Details')

@section('content')

<div class="row">
    <div class="col-md-12">

        {{-- Display a success message if it exists in the session --}}
        @if(session('message'))
            <div class="alert alert-success mb-3">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                {{-- Title for the page --}}
                <h3>My Order Details
                    {{-- Button to go back to the orders list page --}}
                    <a href="{{ url('admin/orders') }}" class="btn btn-danger btn-sm float-end mx-1">
                        <span class="fa fa-arrow-left"></span> Back
                    </a>
                    {{-- Button to download the order invoice as PDF --}}
                    <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1">
                        <span class="fa fa-download"></span> Download Invoice
                    </a>
                    {{-- Button to view the order invoice in a new tab --}}
                    <a href="{{ url('admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">
                        <span class="fa fa-eye"></span> View Invoice
                    </a>
                    {{-- Button to send the order invoice via email --}}
                    <a href="{{ url('admin/invoice/'.$order->id.'/mail') }}" class="btn btn-info btn-sm float-end mx-1">
                        <span class="fa fa-envelope"></span> Send Invoice Via Mail
                    </a>
                </h3>
            </div>
            <div class="card-body">

                {{-- Display the order details in two columns --}}
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        {{-- Display various order details --}}
                        <h6>Order Id: {{ $order->id }}</h6>
                        <h6>Tracking Id/No.: {{ $order->tracking_no }} </h6>
                        <h6>Ordered Date: {{ $order->created_at->format('d-m-Y h:i A') }} </h6>
                        <h6>Payment Mode: {{ $order->payment_mode }} </h6>
                        {{-- Display the order status message with a colored border --}}
                        <h6 class="border p-2 text-success">
                            Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        {{-- Display user-related details --}}
                        <h6>Full Name: {{ $order->fullname }}</h6>
                        <h6>Email Id: {{ $order->email }}</h6>
                        <h6>Phone: {{ $order->phone }}</h6>
                        <h6>Address: {{ $order->address }}</h6>
                        <h6>Pin code: {{ $order->pincode }}</h6>
                    </div>
                </div>

                <br/>
                <h5>Order Items</h5>
                <hr>
                <div class="table-responsive">
                    {{-- Table to display the order items --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalPrice = 0;
                            @endphp
                            {{-- Loop through each order item and display its details --}}
                            @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td width="10%">{{ $orderItem->id }}</td>
                                <td width="10%">
                                    {{-- Display the product image if available, otherwise show a placeholder image --}}
                                    @if ($orderItem->product->productImages)
                                        <img src="{{ asset($orderItem->product->productImages[0]->image) }}"
                                        style="width: 50px; height: 50px" alt="">
                                    @else
                                        <img src="" style="width: 50px; height: 50px" alt="">
                                    @endif
                                </td>
                                <td>
                                    {{ $orderItem->product->name }}
                                    {{-- Display the color name if the product has a color option --}}
                                    @if ($orderItem->productColor)
                                        @if ($orderItem->productColor->color)
                                        <span>- Color: {{ $orderItem->productColor->color->name }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td width="10%">${{ $orderItem->price }}</td>
                                <td width="10%">{{ $orderItem->quantity }}</td>
                                {{-- Calculate and display the total price for each item --}}
                                <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                @php
                                    $totalPrice += $orderItem->quantity * $orderItem->price;
                                @endphp
                            </tr>
                            @endforeach
                            {{-- Display the total order amount --}}
                            <tr>
                                <td colspan="5" class="fw-bold">Total Amount:</td>
                                <td colspan="1" class="fw-bold">${{ $totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        {{-- Section to update the order status --}}
        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        {{-- Form to update the order status --}}
                        <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Update Your Order Status</label>
                            <div class="input-group">
                                {{-- Dropdown to select the new order status --}}
                                <select name="order_status" class="form-select">
                                    <option value="">Select Order Status</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }} >In Progress</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }} >Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }} >Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }} >Cancelled</option>
                                    <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected':'' }} >Out for delivery</option>
                                </select>
                                {{-- Button to submit the form and update the order status --}}
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-7">
                        <br/>
                        {{-- Display the current order status --}}
                        <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $order->status_message }}</span> </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
