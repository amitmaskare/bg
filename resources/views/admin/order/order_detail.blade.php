@extends('layout.admin')
@section('content')

<div class="page-body">
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Orders List</h3>
                                           
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            <i data-feather="home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Digital</li>
                                    <li class="breadcrumb-item active">Bids Management</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="bg-inner cart-section order-details-table">
                                        <div class="row g-4">
                                            <div class="col-xl-8">
                                                <div class="card-details-title">
                                                    <h3>Order Number <span>#{{$data['order']->orderId}}</span></h3>
                                                </div>
                                                <div class="table-responsive table-details">
                                                    <table class="table cart-table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Items</th>
                                                                <!-- <th class="text-end" colspan="2">
                                                                    <a href="javascript:void(0)"
                                                                        class="theme-color">Edit Items</a>
                                                                </th> -->
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if(!$data['orderDetail']->isEmpty())
                                                            @php $shipping_charge=0; @endphp
                                                            @foreach($data['orderDetail'] as $item)
                                                            @php $shipping_charge=$shipping_charge+$item->shipping_charge; @endphp
                                                            <tr class="table-order">
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="{{asset('assets/images/fashion/1.jpg')}}"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p>Product Name</p>
                                                                    <h5>{{$item->listings?->product_name}}</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Quantity</p>
                                                                    <h5>{{$item->quantity}}</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Price</p>
                                                                    <h5>${{$item->price}}</h5>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>

                                                        <tfoot>
                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Subtotal :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>${{$data['order']->subtotal}}</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Shipping :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>{{$shipping_charge ?? 0}}</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Tax(GST) :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>${{$data['order']->taxes}}</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h4 class="theme-color fw-bold">Total Price :</h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="theme-color fw-bold">${{$data['order']->total_amount}}</h4>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <div class="order-success">
                                                            <h4>summery</h4>
                                                            <ul class="order-details">
                                                                <li>Order ID: {{$data['order']->orderId}}</li>
                                                                <li>Order Date: {{ date('M d,Y',strtotime($data['order']->order_date))}}</li>
                                                                <li>Order Total: {{$data['order']->total_amount}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="order-success">
                                                            <h4>shipping address</h4>
                                                            <ul class="order-details">
                                                                <li>{{$data['order']->shippingAddress?->address_line}}</li>
                                                                <li>{{$data['order']->shippingAddress?->city.' '.$data['order']->shippingAddress?->state}}</li>
                                                                <li>{{$data['order']->shippingAddress?->country.','.$data['order']->shippingAddress?->postal_code}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="order-success">
                                                            <div class="payment-mode">
                                                                <h4>payment method</h4>
                                                                <p>Pay on Delivery {{$data['order']->payment_method}}.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="order-success">
                                                            <div class="delivery-sec">
                                                                <h3>expected date of delivery: <span>october 22,
                                                                        2021</span></h3>
                                                                <a href="#">track order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- section end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>

@endsection
