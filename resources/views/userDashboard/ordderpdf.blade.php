<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order PDF - #{{ $order->orderId }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 20px;
        }

        h2, h5 {
            margin: 0 0 10px 0;
            padding: 0;
        }

        .invoice-box {
            width: 100%;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
        }

        .section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .section .column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 10px;
            box-sizing: border-box;
        }

        .column p {
            margin: 4px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #888;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f0f0f0;
        }

        .text-end {
            text-align: right;
        }

        .footer-total {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <h2 style="text-align:center;">Order Invoice</h2>

    <div class="section">
        <!-- Order Summary -->
        <div class="column">
            <h5>Order Summary</h5>
            <p><strong>Customer Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Order Number:</strong> {{ $order->orderId }}</p>
            <p><strong>Order Date:</strong> {{ date('d-M-Y', strtotime($order->order_date)) }}</p>
            <p><strong>Order Type:</strong> {{ ucfirst($order->order_type) }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>

        <!-- Delivery Address -->
        <div class="column">
            <h5>Delivery Address</h5>
            <p><strong>Address:</strong> {{ $order->shippingAddress->address_line }}</p> 
            <p><strong>City/State:</strong> {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}</p>
            <p><strong>Postal Code:</strong> {{ $order->shippingAddress->postal_code }}</p>
            <p><strong>Country:</strong> {{ $order->shippingAddress->country }}</p>
        </div>
    </div>

    @if(count($products) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                    <th>Price (each)</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $shipping_charge = 0; @endphp
                @foreach($products as $index => $product)
                    @php
                        $subtotal = $product->price * $product->quantity;
                        $shipping_charge += $product->shipping_charge;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>₹{{ number_format($product->price, 2) }}</td>
                        <td>₹{{ number_format($subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="footer-total">
                    <td colspan="4" class="text-end">Shipping Charge</td>
                    <td>₹{{ number_format($shipping_charge, 2) }}</td>
                </tr>
                <tr class="footer-total">
                    <td colspan="4" class="text-end">Tax</td>
                    <td>₹{{ number_format($order->taxes, 2) }}</td>
                </tr>
                <tr class="footer-total">
                    <td colspan="4" class="text-end">Total</td>
                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>No product details found.</p>
    @endif
</div>
</body>
</html>
