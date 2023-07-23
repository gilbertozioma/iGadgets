<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    {{-- Order Details Table --}}
<table class="order-details">
    <thead>
        {{-- Company Information and Invoice Details Row --}}
        <tr>
            {{-- Left column with website name --}}
            <th width="50%" colspan="2">
                <h2 class="text-start">{{ $appSetting->website_name }}</h2>
            </th>
            {{-- Right column with invoice details --}}
            <th width="50%" colspan="2" class="text-end company-data">
                <span>Invoice Id: #{{ $order->id }}</span> <br>
                <span>Date: {{ date('d / m / Y') }}</span> <br>
                <span>Email Id: {{ $appSetting->email1 }}</span> <br>
                <span>Address: {{ $appSetting->address }}</span> <br>
            </th>
        </tr>
        {{-- Row with headings for order details and user details --}}
        <tr class="bg-blue">
            <th width="50%" colspan="2">Order Details</th>
            <th width="50%" colspan="2">User Details</th>
        </tr>
    </thead>
    <tbody>
        {{-- Row with Order ID and Full Name --}}
        <tr>
            <td>Order Id:</td>
            <td>{{ $order->id }}</td>

            <td>Full Name:</td>
            <td>{{ $order->fullname }}</td>
        </tr>
        {{-- Row with Tracking ID/No. and Email --}}
        <tr>
            <td>Tracking Id/No.:</td>
            <td>{{ $order->tracking_no }}</td>

            <td>Email Id:</td>
            <td>{{ $order->email }}</td>
        </tr>
        {{-- Row with Ordered Date and Phone --}}
        <tr>
            <td>Ordered Date:</td>
            <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>

            <td>Phone:</td>
            <td>{{ $order->phone }}</td>
        </tr>
        {{-- Row with Payment Mode and Address --}}
        <tr>
            <td>Payment Mode:</td>
            <td>{{ $order->payment_mode }}</td>

            <td>Address:</td>
            <td>{{ $order->address }}</td>
        </tr>
        {{-- Row with Order Status and Pin code --}}
        <tr>
            <td>Order Status:</td>
            <td>{{ $order->status_message }}</td>

            <td>Pin code:</td>
            <td>{{ $order->pincode }}</td>
        </tr>
    </tbody>
</table>

{{-- Order Items Table --}}
<table>
    <thead>
        {{-- Heading Row for Order Items Table --}}
        <tr>
            <th class="no-border text-start heading" colspan="5">
                Order Items
            </th>
        </tr>
        {{-- Heading Row for Order Item details --}}
        <tr class="bg-blue">
            <th>ID</th>
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
        {{-- Loop through each Order Item and display the details --}}
        @foreach ($order->orderItems as $orderItem)
        <tr>
            <td width="10%">{{ $orderItem->id }}</td>
            <td>
                {{ $orderItem->product->name }}
                @if ($orderItem->productColor)
                    @if ($orderItem->productColor->color)
                    {{-- Display the color name if available for the product --}}
                    <span>- Color: {{ $orderItem->productColor->color->name }}</span>
                    @endif
                @endif
            </td>
            <td width="10%">${{ $orderItem->price }}</td>
            <td width="10%">{{ $orderItem->quantity }}</td>
            {{-- Calculate and display the total price for each Order Item --}}
            <td width="15%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
            @php
                // Calculate the total price of all Order Items
                $totalPrice += $orderItem->quantity * $orderItem->price;
            @endphp
        </tr>
        @endforeach
        {{-- Row to display the total amount --}}
        <tr>
            <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small>: </td>
            <td colspan="1" class="total-heading">${{ $totalPrice }}</td>
        </tr>
    </tbody>
</table>

<br>
{{-- Thank you message for shopping --}}
<p class="text-center">
    Thank you for shopping with {{ $appSetting->website_name }}
</p>


</body>
</html>
