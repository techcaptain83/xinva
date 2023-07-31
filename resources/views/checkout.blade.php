@extends('layouts.app')

    @section('header')

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    @endsection

    @section('content')

    <div class="product">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="16px" viewBox="0 0 14 16" version="1.1">
            <defs/>
            <g id="Flow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="0-Default" transform="translate(-121.000000, -40.000000)" fill="#E184DF">
                    <path d="M127,50 L126,50 C123.238576,50 121,47.7614237 121,45 C121,42.2385763 123.238576,40 126,40 L135,40 L135,56 L133,56 L133,42 L129,42 L129,56 L127,56 L127,50 Z M127,48 L127,42 L126,42 C124.343146,42 123,43.3431458 123,45 C123,46.6568542 124.343146,48 126,48 L127,48 Z" id="Pilcrow"/>
                </g>
            </g>
        </svg>
        <div class="description">
          <h3>Starter plan</h3>
          <h5>$20.00 / month</h5>
        </div>
      </div>
      <form action="createcheckout.php" method="POST">
        <!-- Add a hidden field with the lookup_key of your Price -->
        <input type="hidden" name="lookup_key" value="" />
        <button id="checkout-and-portal-button" type="submit">Checkout</button>
      </form>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            // Create a Stripe client.
            // var stripe = Stripe('pk_test_zmKNlnptONWFeIFjx9V6Ft2s');
            var stripe = Stripe('pk_test_A9rH3To4deleJKipnG5suBEI');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            var cardHolderName = document.getElementById('cardholder-name');
            var clientSecret = form.dataset.secret;



            form.addEventListener('submit', async function(event){
                event.preventDefault();

                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );
            
                if (error) {
                     // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                     // Send the token to your server.
                    stripeTokenHandler(setupIntent);
                }

                // stripe.createToken(card).then(function(result){
                //     if (result.error) {
                //     // Inform the user if there was an error.
                //     var errorElement = document.getElementById('card-errors');
                //     errorElement.textContent = result.error.message;
                // } else {
                //     // Send the token to your server.
                //     stripeTokenHandler(result.token);
                // }
                //     });
            });

            // var cardHolderName = document.getElementById('cardholder-name');
            // var clientSecret = form.dataset.secret;

            // form.addEventListener('submit', async function(event) {
            //     event.preventDefault();

            //     const { setupIntent, error } = await stripe.confirmCardSetup(
            //         clientSecret, {
            //             payment_method: {
            //                 card,
            //                 billing_details: { name: cardHolderName.value }
            //             }
            //         }
            //     );
                // NOW //
               // if (error) {
                //     // Inform the user if there was an error.
                //     var errorElement = document.getElementById('card-errors');
                //     errorElement.textContent = error.message;
                // } else {
                //     // Send the token to your server.
                //     stripeTokenHandler(setupIntent);
                // }

                // stripe.createToken(card).then(function(result) {
                //     if (result.error) {
                //     // Inform the user if there was an error.
                //     var errorElement = document.getElementById('card-errors');
                //     errorElement.textContent = result.error.message;
                //     } else {
                //     // Send the token to your server.
                //     stripeTokenHandler(result.token);
                //     }
                // });
            // });

            // Submit the form with the token ID.
            // function stripeTokenHandler(setupIntent) {
            //     // Insert the token ID into the form so it gets submitted to the server
            //     var form = document.getElementById('payment-form');
            //     var hiddenInput = document.createElement('input');
            //     hiddenInput.setAttribute('type', 'hidden');
            //     hiddenInput.setAttribute('name', 'paymentMethod');
            //     hiddenInput.setAttribute('value', setupIntent.payment_method);
            //     form.appendChild(hiddenInput);

            //     // Submit the form
            //     form.submit();
            // }
           
            function stripeTokenHandler(setupIntent) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethod');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
            
        </script>
    @endpush

    @endsection