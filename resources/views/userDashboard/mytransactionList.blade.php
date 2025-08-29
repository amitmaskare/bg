@extends('layout.app')
@section('content')

<style>
    .show-on-top {
    position: absolute !important;
    top: 100%;
    left: 0;
    z-index: 9999;
    display: none;
}

/* Show when parent has .show */
.dropdown.show .show-on-top {
    display: block;
}
</style>




    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Dashboard</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space user-dashboard-section">
        <div class="container">
            <div class="row">

            @include('userDashboard.sidebar')


            <div class="col-lg-9">
                <button class="show-btn btn d-lg-none d-block">Show Menu</button>
                <div class="faq-content tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="order-tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="card mb-0 dashboard-table mt-0">
                                    <div class="card-body">
                                        <div class="top-sec">
                                            <h3>My Transaction Log</h3>
                                           
                                        </div>
                                        <div class="total-box mt-0">
                                            <div class="wallet-table mt-0">
                                                <div class="table-responsive">
                                                        <table class="table cart-table order-table">
                                                        <thead>
                                                            <tr class="table-head">
                                                                <th>Order Number</th>
                                                                <th>Date</th>
                                                                <th>Order Type</th>
                                                                <th>Amount</th>
                                                                <th>Payment Status</th>
                                                                <!-- <th>Option</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($data['order'] && count($data['order']) > 0)
                                                                @foreach($data['order'] as $index => $item)
                                                                    <tr class="order-row">
                                                                        <td>
                                                                            <span class="fw-bolder toggle-accordion" data-target="#accordion-{{$index}}" style="cursor:pointer;">
                                                                                <i class="ri-arrow-down-s-line me-1"></i> {{$item->orderId}}
                                                                            </span>
                                                                        </td>
                                                                        <td>{{ date('d-M-Y', strtotime($item->order_date)) }}</td>
                                                                        <td>
                                                                            <div class="badge bg-pending custom-badge rounded-0">
                                                                                {{ ucfirst($item->order_type) }}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $item->total_amount }}</td>
                                                                        <td>
                                                                            <div class="badge bg-pending custom-badge rounded-0">
                                                                                {{ ucfirst($item->status) }}
                                                                            </div>
                                                                        </td>
                                                                          <!-- <td> <a href="{{ route('order_view', ['id' => $item->id]) }}">
                                                                                <i class="ri-eye-line"></i>
                                                                            </a></td> -->
                                                                    </tr>

                                                                    {{-- Accordion Detail Row in Order Number column only --}}
                                                                    <tr id="accordion-{{$index}}" class="accordion-detail" style="display: none;">
                                                                        <td>
                                                                     
                                                                                @php
                                                                                    $products = DB::table('order_billings')
                                                                                        ->leftJoin('listing_products', 'order_billings.listingId', '=', 'listing_products.id')
                                                                                        ->where('order_billings.orderId', $item->id)
                                                                                        ->select(
                                                                                            'listing_products.product_name as product_name',
                                                                                            'order_billings.quantity as quantity',
                                                                                            'order_billings.price as price'
                                                                                        )
                                                                                        ->get();
                                                                                @endphp

                                                                                @if(count($products) > 0)
                                                                                    <table class="table table-bordered mt-2 mb-0">
                                                                                        <thead class="table-light">
                                                                                            <tr>
                                                                                                <th>Product Name</th>
                                                                                                <th>Price</th>
                                                                                                <th>Qty</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach($products as $product)
                                                                                                <tr>
                                                                                                    <td>{{ $product->product_name }}</td>
                                                                                                    <td>{{ $product->price }}</td>
                                                                                                    <td>{{ $product->quantity }}</td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                @else
                                                                                    <p class="mt-2">No product details found.</p>
                                                                                @endif
                                                                         

                                                                        </td>
                                                                        <td colspan="5"></td> {{-- Empty columns to preserve layout --}}
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="6"><center>No Data Found</center></td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="product-pagination">
                                                <div class="theme-paggination-block">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Previous">
                                                                    <span>
                                                                        <i class="ri-arrow-left-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item active">
                                                                <a class="page-link" href="#!">1</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">2</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!">3</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#!" aria-label="Next">
                                                                    <span>
                                                                        <i class="ri-arrow-right-s-line"></i>
                                                                    </span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.toggle-accordion').on('click', function () {
            var target = $(this).data('target');
            $(target).slideToggle();

            // Toggle the arrow icon
            $(this).find('i').toggleClass('ri-arrow-down-s-line ri-arrow-up-s-line');
        });
    });
</script>
    @endsection
  