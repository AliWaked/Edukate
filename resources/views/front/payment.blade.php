<x-front.layout title='Payment'>
    <x-front.partials.header title="{{ __('Payment') }}" :breadcrumb="[__('Home'), __('Payment')]" :search="false" />
    {{-- <form action="" method="post"> --}}
    {{-- @csrf --}}
    {{-- <div id="payment-message" style="display: none;" class="alert alert-info"></div>
    <form action="" method="post" id="payment-form">
        <div id="payment-element"></div>
        <button type="submit" id="submit"><span id="button-text">Pay now</span><span id="spinner" style="display: none;">Processing...</span></button>
    </form> --}}
    <form id="payment-form" style="width: 50%; margin-left:auto; margin-right:auto;">
        <div id="link-authentication-element">
            <!--Stripe.js injects the Link Authentication Element-->
        </div>
        <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
        </div>
        <button id="submit"
            style="margin-top: 25px; display:block; background-color:transparent;color: #fff;
        padding: 13px 35px;
        border: 1px #2878EB solid;
        background-color: #2878EB;
        border-radius: 3px;">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">{{__('Pay now')}}</span>
        </button>
        <div id="payment-message" class="hidden"></div>
    </form>
    {{-- </form> --}}
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // This is your test publishable API key.
        const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");
        // The items the customer wants to buy
        // const items = [{
        //     id: "xl-tshirt"
        // }];

        let elements;

        initialize();
        checkStatus();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        let emailAddress = '';
        // Fetches a payment intent and captures the client secret
        async function initialize() {
            const {
                clientSecret
            } = await fetch("{{ route('payment.intent', $course->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    // items
                    "_token": "{{ csrf_token() }}",
                }),
            }).then((r) => r.json());

            elements = stripe.elements({
                clientSecret
            });

            const linkAuthenticationElement = elements.create("linkAuthentication");
            linkAuthenticationElement.mount("#link-authentication-element");

            const paymentElementOptions = {
                layout: "tabs",
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    // return_url: "http://localhost:4242/checkout.html",
                    return_url: "{{ route('payment.return', $course->id) }}",
                    receipt_email: emailAddress,
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        // Fetches the payment intent status after payment submission
        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const {
                paymentIntent
            } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            // messageContainer.classList.remove("hidden");
            messageContainer.style.dispaly = 'block';
            messageContainer.textContent = messageText;

            setTimeout(function() {
                // messageContainer.classList.add("hidden");
                messageContainer.style.dispaly = 'none';
                messageContainer.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                // document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#spinner").style.dispaly = 'inline';
                // document.querySelector("#button-text").classList.add("hidden");
                document.querySelector("#button-text").style.dispaly = 'none';
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").style.dispaly = 'none';
                document.querySelector("#button-text").style.dispaly = 'inline';
                // document.querySelector("#spinner").classList.add("hidden");
                // document.querySelector("#button-text").classList.remove("hidden");
            }
        }
    </script>
</x-front.layout>
