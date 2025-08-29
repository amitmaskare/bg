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
                                            <h3>Messages </h3>
                                           
                                        </div>
                                        <div class="total-box mt-0">
                                            <div class="wallet-table mt-0">
                                                <div class="table-responsive">
                                                        <table class="table cart-table order-table">
                                                        <thead>
                                                            <tr class="table-head">
                                                            
                                                                <th>Product Name</th>
                                                                <th>Messages</th>
                                                                <th>Created Date</th>
                                                                <th>Action</th>
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($messages as $msg)
                                                                <tr>
                                                                
                                                                    <td>{{ $msg->product->product_name ?? 'N/A' }}</td>
                                                                    <td>{{ $msg->message }}</td>
                                                                    <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                                                                    <td>
                                                                        <a href="{{ route('user.messages.thread', $msg->product_id) }}" class="btn btn-sm btn-primary">
                                                                            View Thread
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No messages found.</td>
                                                                </tr>
                                                            @endforelse
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
  