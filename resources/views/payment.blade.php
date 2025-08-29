<!DOCTYPE html>
<html>

<head>
    <title>Save Card</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <h2>Save Your Card</h2>

    <form id="card-form">
        <div id="card-element"></div>
        <button type="submit">Save Card</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stripe = Stripe("{{ $stripeKey }}");
            const elements = stripe.elements();

            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const form = document.getElementById('card-form');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    "{{ $clientSecret }}", {
                        payment_method: {
                            card: cardElement,
                        }
                    }
                );

                if (error) {
                    alert("Card setup failed: " + error.message);
                    return;
                }

                // Send the payment method to the server
                const response = await fetch("/save-payment-method", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        payment_method: setupIntent.payment_method,
                    }),
                });

                const result = await response.json();

                if (result.success) {
                    alert("Card saved successfully!");
                } else {
                    alert("Something went wrong while saving the card.");
                }
            });
        });
    </script>

</body>

</html>
