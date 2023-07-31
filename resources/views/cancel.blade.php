@extends('layouts.app')

    @section('header')

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    @endsection

    @section('content')

    <p>Picked the wrong subscription? Shop around then come back to pay!</p>

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