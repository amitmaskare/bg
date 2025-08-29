@extends('layout.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2>checkout</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">checkout</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section class="section-b-space checkout-section-2">
        <div class="container">
            <div class="checkout-page">

                <div class="checkout-form">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(empty($data['user']->stripe_id))
                    <form  method="post" id="payment-form">
                        @else
                    <form  method="post" action="{{ route('orders') }}">
                        @endif
                        @csrf
                        <div class="row g-sm-4 g-3">
                            <div class="col-lg-7">
                                <div class="left-sidebar-checkout">
                                    <div class="checkout-detail-box">
                                        <ul>
                                            <li>
                                                <div class="checkout-box">
                                                    <div class="checkout-title">
                                                        <h4>Shipping Address</h4>
                                                        <button data-bs-toggle="modal" type="button"
                                                            data-bs-target="#addAddress"
                                                            class="d-flex align-items-center btn"><i
                                                                class="ri-add-line me-1"></i> Add New</button>
                                                    </div>

                                                    <div class="checkout-detail">
                                                        <div class="row g-3">
                                                            @if (!empty($data['addresses']))
                                                                @foreach ($data['addresses'] as $address)
                                                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                        <div class="delivery-address-box">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="shipping_address_id"
                                                                                id="check{{ $address->id }}" checked
                                                                                value="{{ $address->id }}">

                                                                            <label class="form-check-label"
                                                                                for="check{{ $address->id }}">
                                                                                <span
                                                                                    class="name">{{ ucfirst($address->type) }}</span>
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Address :</span>
                                                                                    {{ $address->address_line }}</span><br>{{ $address->city }},&nbsp;{{ $address->state }}
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Pin Code :</span>
                                                                                    {{ $address->postal_code }}</span>
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Phone :</span>
                                                                                    {{ $data['user']->phone_number }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="checkout-box">
                                                    <div class="checkout-title">
                                                        <h4>Billing Address</h4>
                                                        <button data-bs-toggle="modal" data-bs-target="#addAddress"
                                                            class="d-flex align-items-center btn"><i
                                                                class="ri-add-line me-1"></i> Add New</button>
                                                    </div>

                                                    <div class="checkout-detail">
                                                        <div class="row g-3">
                                                            @if (!empty($data['addresses']))
                                                                @foreach ($data['addresses'] as $address)
                                                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                        <div class="delivery-address-box">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="billing_address_id"
                                                                                id="billing{{ $address->id }}" checked
                                                                                value="{{ $address->id }}">
                                                                            <label class="form-check-label"
                                                                                for="billing{{ $address->id }}">
                                                                                <input type="hidden" name="biil_address"
                                                                                    value="{{ $address->id }}">

                                                                                <span
                                                                                    class="name">{{ ucfirst($address->type) }}</span>
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Address :</span>
                                                                                    {{ $address->address_line }}</span><br>{{ $address->city }},&nbsp;{{ $address->state }}
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Pin Code :</span>
                                                                                    {{ $address->postal_code }}</span>
                                                                                <span class="address text-content"><span
                                                                                        class="text-title">Phone :</span>
                                                                                    {{ $data['user']->phone_number }}</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="checkout-box">
                                                    <div class="checkout-title">
                                                        <h4>Delivery Options</h4>
                                                    </div>

                                                    <div class="checkout-detail">
                                                        <div class="row g-3">
                                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                <div class="delivery-address-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="checkbox2" id="check7">
                                                                    <label class="form-check-label" for="check7">Standard
                                                                        Delivery | Approx 5 to 7 Days</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                <div class="delivery-address-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="checkbox2" id="check8" checked>
                                                                    <label class="form-check-label" for="check8">Express
                                                                        Delivery | Schedule </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="checkout-box">
                                                    <div class="checkout-title">
                                                        <h4>Payment Options</h4>
                                                    </div>

                                                    <div class="checkout-detail">
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <div class="delivery-address-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_method" id="check9"
                                                                        value="cash">
                                                                    <label class="form-check-label" for="check9">CASH ON
                                                                        DELIVERY</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="delivery-address-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_method" id="check10"
                                                                        value="online">
                                                                    <label class="form-check-label"
                                                                        for="check10">Online</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="delivery-address-box">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_method" id="check11" checked
                                                                        value="wallet">
                                                                    <label class="form-check-label"
                                                                        for="check11">Wallet</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                             @if(empty($data['user']->stripe_id))
                                         <li>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Stripe Payment Gateway</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    
                                                 <div class="row g-sm-4 g-2">
                       
                                                        <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                <input class='form-control'  name="cardholdername" id="card-holder-name{{$data['user']->stripe_id}}"  type='text' required autocomplete="off" value="" placeholder="Card on Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                 <div id="card-element{{$data['user']->stripe_id}}" class="form-control"></div>
                                                                 <div id="card-errors{{$data['user']->stripe_id}}" role="alert" class="text-danger"></div>
                                                            </div>
                                                        </div>

                    </div>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                          @if(!empty($data['cards']))
                                          <li>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Select Card</h4>
                                                    <button data-bs-toggle="modal" type="button" data-bs-target="#addNewCard"
                                                        class="d-flex align-items-center btn"><i
                                                            class="ri-add-line me-1"></i> Add New Card</button>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="row g-3">
                                                      
                                                        @foreach($data['cards'] as $index=>$card)
   
                                                        <div class="col-sm-6">
                                                            <div class="delivery-address-box">
                                                                <input class="form-check-input" type="radio"
                                                                    name="payment_method_id" id="check{{$index+1}}"  value="{{ $card['id'] }}">
                                                                <label class="form-check-label"
                                                                    for="check{{$index+1}}"> {{ ucfirst($card['brand']) }} •••• {{ $card['last4'] }} ({{ $card['exp'] }})</label>
                                                            </div>
                                                        </div>
                                                     @endforeach
                                                      

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                          @endif


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="checkout-right-box">
                                    <div class="checkout-details">
                                        <div class="order-box">
                                            <div class="title-box">
                                                <h4>Summary Order</h4>
                                                <p>For a better experience, verify your goods and choose your shipping
                                                    option.</p>
                                            </div>

                                            <ul class="qty">
                                                @php
                                                    $subtotal = 0;
                                                    $shipping_charge = 0;
                                                    $tax = 0;
                                                @endphp
                                                @if (!empty($data['cart']))
                                                    @foreach ($data['cart'] as $item)
                                                        @php
                                                            $subtotal =
                                                                $subtotal + $item->product?->price * $item->quantity;
                                                            $shipping_charge =
                                                                $shipping_charge + $item->shipping_charge;
                                                            $tax = $tax + $item->product?->gst;
                                                        @endphp
                                                        <li>
                                                            <div class="cart-image">
                                                                @if (!empty($item->product?->main_image) && file_exists(public_path('uploads/product/' . $item->product?->main_image)))
                                                                    <img src="{{ asset('uploads/product/' . $item->product?->main_image) }}"
                                                                        class="img-fluid"
                                                                        alt="{{ $item->product?->product_name }}"
                                                                        width="80px" height="100px">
                                                                @else
                                                                    <img src="{{ asset('assets/images/product-details/product/17.jpg') }}"
                                                                        class="img-fluid" alt="" width="80px">
                                                                @endif
                                                            </div>
                                                            <div class="cart-content">
                                                                <div>
                                                                    <h4>{{ !empty($item->product?->product_name) ? ucfirst($item->product?->product_name) : 'unknown product' }}
                                                                    </h4>
                                                                    <h6>{{ $item->product?->price ?? '' }} X
                                                                        {{ $item->quantity ?? '' }}</h6>
                                                                    @if ($item->product?->gst)
                                                                        <h6>Tax : {{ $item->product?->gst ?? '' }}</h6>
                                                                    @endif
                                                                    @if ($item->product?->discount)
                                                                        <h6>Discount(%) :
                                                                            {{ $item->product?->discount ?? '' }}</h6>
                                                                    @endif
                                                                    <h6>Shipping : {{ $item->shipping_charge ?? 0 }}</h6>
                                                                </div>
                                                                <span
                                                                    class="text-theme">{{ $item->product?->price * $item->quantity ?? '' }}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="checkout-details">
                                        <div class="order-box">
                                            <div class="title-box">
                                                <h4>Billing Summary</h4>
                                                <div class="promo-code-box">
                                                    <div class="promo-title">
                                                        <h5>Promo code</h5>
                                                        <button class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#couponModal"><i
                                                                class="ri-coupon-line"></i>View
                                                            All</button>
                                                    </div>
                                                    <div class="row g-sm-3 g-2 mb-3">
                                                        <div class="col-md-6">
                                                            <div class="coupon-box">
                                                                <div class="card-name">
                                                                    <h6>Holiday Savings</h6>
                                                                </div>
                                                                <div class="coupon-content">
                                                                    <div class="coupon-apply">
                                                                        <h6 class="coupon-code success-color">#HOLIDAY40
                                                                        </h6>
                                                                        <a class="btn theme-btn border-btn copy-btn mt-0"
                                                                            href="#!">Copy Code</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="coupon-box">
                                                                <div class="card-name">
                                                                    <h6>Holiday Savings</h6>
                                                                </div>
                                                                <div class="coupon-content">
                                                                    <div class="coupon-apply">
                                                                        <h6 class="coupon-code success-color">#HOLIDAY40
                                                                        </h6>
                                                                        <a class="btn theme-btn border-btn copy-btn mt-0"
                                                                            href="#!">Copy Code</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="coupon-input-box">
                                                        <input type="text" id="coupon" class="form-control"
                                                            placeholder="Enter Coupon Code Here...">
                                                        <button class="apply-button btn">Apply now</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-box-loader">

                                                <ul class="sub-total">
                                                    <li>Sub Total <span
                                                            class="count">{{ number_format($subtotal, 2) }}</span></li>
                                                    <li>Shipping <span
                                                            class="count">{{ number_format($shipping_charge, 2) }}</span>
                                                    </li>
                                                    <li>Tax (0%) <span class="count">{{ number_format($tax, 2) }}</span>
                                                    </li>
                                                    <li>
                                                        <h4 class="txt-muted">Points</h4>
                                                        <h4 class="price txt-muted">0</h4>
                                                    </li>
                                                    <li class="border-cls">
                                                        <label for="ponts" class="form-check-label m-0">Would you
                                                            prefer to pay using points?</label>
                                                        <input type="checkbox" id="ponts"
                                                            class="checkbox_animated check-it">
                                                    </li>
                                                    <li>
                                                        <h4>Wallet Balance</h4>
                                                        <h4 class="price">0.00</h4>
                                                    </li>
                                                    <li class="border-cls">
                                                        <label for="wallet" class="form-check-label m-0">Would you
                                                            prefer to pay using wallet?</label>
                                                        <input type="checkbox" id="wallet"
                                                            class="checkbox_animated check-it">
                                                    </li>
                                                </ul>
                                                @php $total=$subtotal+$shipping_charge+$tax;@endphp
                                                <ul class="total">
                                                    <li>Total <span class="count">{{ number_format($total, 2) }}</span>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="subtotal" value="{{ $subtotal ?? '0' }}">
                                                <input type="hidden" name="total_amount" value="{{ $total ?? '0' }}">
                                                <input type="hidden" name="tax" value="{{ $tax ?? '0' }}">

                                                <div class="text-end">
                                                   @if(empty($data['user']->stripe_id))
                                            <button class="btn order-btn" type="submit" id="card-button">Place Order</button>
                                            @else
                                             <button class="btn order-btn" type="submit" name="paySaveCard" value="paySaveCard">Place Order</button>
                                            @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <!-- Add new address modal start -->
    <div class="modal fade theme-modal-2" id="addAddress">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('addresses.storecheckoute') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title fw-semibold">Add Address</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-sm-4 g-2">
                            <div class="col-12">
                                <div class="form-box">
                                    <label for="type" class="form-label">Title (Type)</label>
                                    <select class="form-select" name="type" id="type">
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-box">
                                    <label for="address_line" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address_line" name="address_line"
                                        placeholder="Enter Address" required>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                                                                                                                            <div class="form-box">
                                                                                                                                                <label for="number" class="form-label">Phone Number (Optional)</label>
                                                                                                                                                <input type="number" class="form-control" id="number" placeholder="Phone number (not stored)">
                                                                                                                                            </div>
                                                                                                                                        </div> -->

                            <div class="col-6">
                                <div class="form-box">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" name="country" required>
                                        <option value="Austria">Austria</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="China">China</option>
                                        <option value="India">India</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="France">France</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-box">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" name="state">
                                        <option value="Delhi">Delhi</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-box">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-box">
                                    <label for="postal_code" class="form-label">PinCode</label>
                                    <input type="number" class="form-control" id="postal_code" name="postal_code"
                                        placeholder="Enter PinCode" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-outline fw-bold"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-solid">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add new address modal End -->

     <!-- Add new card modal start -->
    <div class="modal fade theme-modal-2" id="addNewCard">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           <form action="#" method="POST">
              
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
                                                                <input class='form-control'  name="cardholdername" id="card-holder-name"  type='text' required autocomplete="off" value="" placeholder="Card on Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="delivery-address-box">
                                                                 <div id="card-element" class="form-control"></div>
                                                                 <div id="card-errors" role="alert" class="text-danger"></div>
                                                            </div>
                                                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-outline fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-solid" id="saveCard">Submit</button>
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
    
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const paymentForm = document.getElementById('payment-form');
    
    paymentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        cardButton.disabled = true;
        
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
        
        if (error) {
            document.getElementById('card-errors').textContent = error.message;
            cardButton.disabled = false;
        } else {
           
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            
            // Submit form
            form.setAttribute('action', '{{ route("orders") }}');
            form.setAttribute('method', 'POST');
            form.submit();
        }
    });

    
   document.getElementById('saveCard').addEventListener('click', async () => {
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: { name: cardHolderName.value }
        });

        if (error) {
            alert(error.message);
            return;
        }

        fetch("/saveCard", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                name: cardHolderName.value,
                email: "test@example.com", // you should use logged-in user email
                amount: 20,
                payment_method_id: paymentMethod.id
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Card saved successfully!");
                location.reload();
            } else {
                alert("Error: " + data.error);
            }
        });
    });
</script>
@endsection