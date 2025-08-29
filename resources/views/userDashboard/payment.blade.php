@extends('layout.app')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <h2> Stripe Payment</h2>
            <nav class="theme-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('/') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Stripe Payment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--contact section start-->
    <section class="contact-page">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-5">
                    <div class="contact-title">

                    </div>
                </div>
                <div class="col-lg-7">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form id="payment-form">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="form-box">
                                    <label for="name" class="form-label">Name on Card</label>
                                    <input class='form-control' name="cardholdername" id="card-holder-name" type='text'
                                        required autocomplete="off" value="">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-box">
                                    <label for="email">Credit card or Debit</label>

                                    <div id="card-element" class="form-control"></div>
                                    <div id="card-errors" role="alert" class="text-danger"></div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                            <div class="form-box">
                                                <label for="phone">Expiration Month</label>
                                                <input class='form-control' name='card_exp_month' id='card_exp_month' placeholder='MM' size='2' type='text' required autocomplete="off">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-box">
                                                <label for="phone">Expiration Year</label>
                                                <input class='form-control' name='card_exp_year' id='card_exp_year' placeholder='YYYY' size='4' type='text' required autocomplete="off">
                                            </div>
                                        </div> -->
                            <!-- <div class="col-md-6">
                                            <div class="form-box">
                                                <label for="phone">CVC</label>
                                                 <input autocomplete='off' class='form-control' name='card_cvc' id='card_cvc' placeholder='ex. 311'
                                                              size='4' type='text' required>
                                            </div>
                                        </div> -->
                            <input type="hidden" name="amount" id="amount" value="10">
                            <div class="col-12">
                                <div class="form-box">
                                    <button class="btn btn-solid" type="submit" id="card-button" type="submit">$10 Pay
                                        Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!--contact section ends-->


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

            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
                cardButton.disabled = false;
            } else {
                // Add payment method ID to form and submit
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);

                // Submit form
                form.setAttribute('action', '{{ route('payment.checkout') }}');
                form.setAttribute('method', 'POST');
                form.submit();
            }
        });
    </script>
@endsection
