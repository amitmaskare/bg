@extends('layout.app')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>Dashboard</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
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
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="total-contain wallet-bg">
                                        <div class="wallet-point-box">
                                            <div class="total-image">
                                                <img src="{{asset('assets/images/dashboard/balance.png')}}" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="total-detail d-flex">
                                                <div class="total-box ">
                                                    <h5>Wallet Balance</h5>
                                                    <h3>Rs.{{$data['user']->wallet ?? 0}}</h3>
                                                   
                                                </div>
                                                 <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-bs-toggle="modal" type="button" data-bs-target="#addNewCard">Add Wallet</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card mb-0 dashboard-table mt-0">
                                        <div class="card-body">
                                            <div class="total-box mt-0">
                                                <div class="wallet-table">
                                                    <div class="table-responsive">
                                                        <table class="table cart-table order-table">
                                                            <thead>
                                                                <tr class="table-head">
                                                                    <th>Date</th>
                                                                    <th>Wallet Id</th>
                                                                    <th>Amount</th>
                                                                    <th>Remark</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              @if(!$data['wallet']->isEmpty())
                                                              @foreach($data['wallet'] as $item) 
                                                                <tr>
                                                                  <td>{{ date('d M Y H:i A',strtotime($item->created_at)) }}</td>
                                                                    <td>{{$item->wallet_id}}</td>
                                                                    <td>Rs. {{$item->amount}}</td>
                                                                    <td>{{$item->remark ?? ''}}</td>
                                                                    <td>
                                                                        @if($item->status=='Deposit')
                                                                        <div
                                                                            class="badge bg-credit custom-badge rounded-0">
                                                                            <span>Deposit</span>
                                                                        </div>
                                                                        @else
                                                                         <div
                                                                            class="badge bg-debit custom-badge rounded-0">
                                                                            <span>Purchase</span>
                                                                        </div>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No Data Found</td>
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
                                                                    <a class="page-link" href="#!"
                                                                        aria-label="Previous">
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
        </div>
    </section>
    <!--  dashboard section end -->

     <!-- Add new card modal start -->
    <div class="modal fade theme-modal-2" id="addNewCard">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           <form action="#" method="POST">
              @csrf
                <div class="modal-header">
                    <h3 class="modal-title fw-semibold">Add New Card</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                       
                                                        <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                <input class='form-control'  name="cardholdername" id="card-holder-name"  type='text'  autocomplete="off" value="" placeholder="Card on Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                 <div id="card-element" class="form-control"></div>
                                                                 <div id="card-errors" role="alert" class="text-danger"></div>
                                                            </div>
                                                        </div>
                                                         <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                <input class='form-control'  name="amount" id="amount"  type='text' required autocomplete="off" value="" placeholder="Amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">

                                                        <ul id="saved-cards">
    @if(!empty($data['cards']))
    @foreach($data['cards'] as $card)
        <li>
            {{ ucfirst($card['brand']) }} •••• {{ $card['last4'] }} ({{ $card['exp'] }})
            <button type="button" onclick="payWithSaved('{{ $card['id'] }}')">Pay with this</button>
        </li>
    @endforeach
    @endif
</ul>
</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-outline fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-solid" id="pay-button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Add new card modal End -->


     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    // First-time payment
    document.getElementById('pay-button').addEventListener('click', async () => {
         const amount=document.getElementById('amount').value
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: { name: document.getElementById('card-holder-name').value }
        });

        if (error) {
            alert(error.message);
            return;
        }

        fetch("/pay-first-time", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                name: document.getElementById('card-holder-name').value,
                email: "test@example.com",
                amount:amount,
                payment_method_id: paymentMethod.id
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                alert("Payment successful and card saved!");
                location.reload();
            } else {
                alert("Error: " + data.error);
            }
        });
    });

    // Pay with saved card
    function payWithSaved(paymentMethodId) {
       
        const amount=document.getElementById('amount').value
        fetch("/pay-with-saved", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                customer_id: "{{ auth()->user()->stripe_id ?? '' }}",
                payment_method_id: paymentMethodId,
                amount: amount,
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                alert("Payment successful using saved card!");
                location.reload();
            } else {
                alert("Error: " + data.error);
            }
        });
    }
</script>
   
@endsection