{{-- Extends the 'app' layout file, which usually contains the common HTML structure for the application. --}}
@extends('layouts.app')

{{-- Sets the content for the 'title' section with the value 'My Order Details'. --}}
@section('title','My Order Details')

{{-- Defines the 'content' section, where the main content of the page will be placed. --}}
@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{ url('orders') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order Id: {{ $order->id }}</h6>
                                <h6>Tracking Id/No.: {{ $order->tracking_no }} </h6>
                                {{-- Display the ordered date in 'day-month-year hour:minute AM/PM' format. --}}
                                <h6>Ordered Date: {{ $order->created_at->format('d-m-Y h:i A') }} </h6>
                                <h6>Payment Mode: {{ $order->payment_mode }} </h6>
                                {{-- Display the order status message with a green background. --}}
                                <h6 class="border p-2 text-success">
                                    Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
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
                            {{-- A table with bordered and striped rows. --}}
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
                                    {{-- Loop through the $order->orderItems collection to display each order item. --}}
                                    @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <td width="10%">{{ $orderItem->id }}</td>
                                        {{-- Display the product image if available, else display a default image. --}}
                                        <td width="10%">
                                            @if ($orderItem->product->productImages->count() > 0)
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="">
                                            @else
                                                <img src="{{ asset('assets/images/no-image.jpg') }}" style="width: 50px; height: 50px" alt="No Image" />
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Display the product name. --}}
                                            {{ $orderItem->product->name }}
                                            {{-- Display the product color if available. --}}
                                            @if ($orderItem->productColor)
                                                @if ($orderItem->productColor->color)
                                                <span>- Color: {{ $orderItem->productColor->color->name }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td width="10%">${{ $orderItem->price }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        {{-- Display the total amount for the order item (quantity * price). --}}
                                        <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                        
                                        {{-- Calculate the total order price by adding each order item's total price. --}}
                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price;
                                        @endphp
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Total Amount:</td>
                                        <td colspan="1" class="fw-bold">${{ $totalPrice }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- Ends the 'content' section. --}}
