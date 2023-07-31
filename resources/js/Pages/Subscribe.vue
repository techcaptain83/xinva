<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { StripeCheckout } from "@vue-stripe/vue-stripe";

const form = useForm({
    project_name: "",
    sitemap_path: "",
    csrf: "",   
});

onMounted(() => {
    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

function submit() {
    // You will be redirected to Stripe's secure checkout page
    this.$refs.checkoutRef.redirectToCheckout();
}


function stripeTokenHandler(token) {
    var form = document.getElementById("payment-form");
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("type", "stripeToken");
    hiddenInput.setAttribute("type", token.id);
    form.appendChild(hiddenInput);

    form.submit();
}
// LARACAST //
</script>

<template>
    <Head title="Plans" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subscribe
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p-6>
                        <form
                            action="/subscribe"
                            method="post"
                            id="payment-form"
                            data-secret="{{ $intent->client_secret }}"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                :value="form.csrf"
                            />
                            <div class="w-1/2 form-row">
                                <label for="cardholder-name"
                                    >Cardholder's Name</label
                                >
                                <div>
                                    <input
                                        type="text"
                                        id="cardholder-name"
                                        class="px-2 py-2 border"
                                    />
                                </div>
                                <div class="mt-4">
                                    <input
                                        type="radio"
                                        name="plan"
                                        id="standard"
                                        value="price_1MsdkMEIptUzK9FMdawmtGVK"
                                    />
                                    <label for="standard"
                                        >Standard - $10 / month
                                    </label>
                                    <br />

                                    <input
                                        type="radio"
                                        name="plan"
                                        id="standard"
                                        value="price_1MsdkMEIptUzK9FMdawmtGVK"
                                    />
                                    <label for="premium"
                                        >Premium - $20 / month</label
                                    >
                                </div>
                                <br />
                                <!---->
                                <label for="firstName" class="form-label"
                                    >Credit or debit card</label
                                >
                                <input
                                    class="form-control rounded w-100"
                                    type="number"
                                    name="cardno"
                                    placeholder="Card number"
                                    autofocus=""
                                    style="max-width: 600px"
                                />
                                <br /><br />
                                <label for="firstName" class="form-label"
                                    >Expiration Date</label
                                >
                                <input
                                    class="form-control rounded w-100"
                                    type="number"
                                    name="date"
                                    placeholder="Card number"
                                    autofocus=""
                                    style="max-width: 600px"
                                />
                                <br /><br />
                                <label for="firstName" class="form-label"
                                    >year</label
                                >
                                <input
                                    class="form-control rounded w-100"
                                    type="number"
                                    name="year"
                                    placeholder="Card number"
                                    autofocus=""
                                    style="max-width: 600px"
                                />
                                <br /><br />
                                <label for="firstName" class="form-label"
                                    >CVV</label
                                >
                                <input
                                    class="form-control rounded w-100"
                                    type="number"
                                    name="cvv"
                                    placeholder="Card number"
                                    autofocus=""
                                    style="max-width: 600px"
                                />
                                <br /><br />

                                <!---->
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <PrimaryButton class="mt-4">
                                Subscribe
                            </PrimaryButton>
                        </form>
                    </p-6>
                </div>
            </div>
        </div>

        <stripe-checkout
            ref="checkoutRef"
            mode="subscription"
            :pk="pk_test_A9rH3To4deleJKipnG5suBEI"
            :line-items="lineItems"
            :success-url="successURL"
            :cancel-url="cancelURL"
            @loading="(v) => (loading = v)"
        />
        <button @click="submit">Subscribe!</button>
    </AuthenticatedLayout>
</template>
