@extends('layout.app')
@section('content')

 <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Order Success</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Order Success</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- about section start -->
    <section class="about-page section-b-space">
        <div class="container">
            <div class="row">
               <div class="col-sm-12 d-flex justify-content-center">
                    <h4>Your order has been successfully !
                    </h4>
                  
                </div>
             <div class="table-responsive" style="padding:10px">
                                                 @php
                                                   

                                                    $order = $data['order'];

                                                    $products = DB::table('order_billings')
                                                        ->leftJoin('listing_products', 'order_billings.listingId', '=', 'listing_products.id')
                                                        ->where('order_billings.orderId', $order->id)
                                                        ->select(
                                                            'listing_products.product_name as product_name',
                                                            'order_billings.quantity as quantity',
                                                            'order_billings.price as price',
                                                            'order_billings.shipping_charge'
                                                        )
                                                        ->get();

                                                    $grandTotal = 0;
                                                @endphp

                                                @if($order)
                                                    <div class="mb-4">
                                                        <h5 class="mb-2">Order Summary</h5>
                                                        <p><strong>Order Number:</strong> {{ $order->orderId }}</p>
                                                        <p><strong>Order Date:</strong> {{ date('d-M-Y', strtotime($order->order_date)) }}</p>
                                                        <p><strong>Order Type:</strong> {{ ucfirst($order->order_type) }}</p>
                                                        <p><strong>Payment Status:</strong> {{ ucfirst($order->status) }}</p>
                                                    </div>

                                                    @if(count($products) > 0)
                                                        <table class="table table-bordered">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Product Name</th>
                                                                    <th>Qty</th>
                                                                    <th>Price (each)</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $shipping_charge=0; @endphp
                                                                @foreach($products as $index => $product)
                                                                    @php

                                                                        $subtotal = $product->price * $product->quantity;
                                                                        $shipping_charge = $shipping_charge+$product->shipping_charge;
                                                                       
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $product->product_name }}</td>
                                                                        <td>{{ $product->quantity }}</td>
                                                                        <td>{{ number_format($product->price, 2) }}</td>
                                                                        <td>{{ number_format($subtotal, 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot class="table-light">
                                                                <tr>
                                                                   
                                                                    <th colspan="4" class="text-end">shipping Charge</th>
                                                                    <th>{{ number_format($shipping_charge, 2) }}</th>
                                                                </tr>
                                                                 <tr>
                                                                   
                                                                    <th colspan="4" class="text-end">Tax</th>
                                                                    <th>{{ number_format($order->taxes, 2) }}</th>
                                                                </tr>
                                                                 <tr>
                                                                   
                                                                    <th colspan="4" class="text-end">Total</th>
                                                                    <th>{{ number_format($order->total_amount, 2) }}</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    @else
                                                        <p>No product details found.</p>
                                                    @endif
                                                @else
                                                    <p class="text-danger">No order found.</p>
                                                @endif

                                                </div>
                                                <div class="col-sm-12 text-center">
                 <a href="{{ route('/') }}" class="btn btn-warning">Continue Shopping</a>
                                            </div>    
            </div>
        </div>
    </section>
    <!-- about section end -->


@endsection