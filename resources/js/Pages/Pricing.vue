<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import SnackBar from "@/Components/SnackBar.vue";

const props = defineProps({
    plans: Object,
    vendor: Number,
    emptyCredit: Boolean,
    activePlanId: Number
});

onMounted(() => {
    setTimeout(appendPaddleJS, 200);

    function appendPaddleJS() {
        let paddleJS = document.getElementById("paddle-js");
        if (paddleJS != null) {
            paddleJS.remove();
        }

        let paddleScript = document.createElement("script");
        paddleScript.setAttribute("src", "https://cdn.paddle.com/paddle/paddle.js");
        paddleScript.setAttribute("id", "paddle-js");

        paddleScript.onload = () => setTimeout(initPaddle, 2000);
        document.body.appendChild(paddleScript);
    }

    function initPaddle() {
        if (window.env.APP_ENV == "local") {
            Paddle.Environment.set("sandbox");
        }

        Paddle.Setup({ vendor: props.vendor,

            eventCallback: function(data) {
                if (data.event === 'Checkout.PaymentComplete') {
                    // Check to ensure the payment has not been flagged for manual fraud review
                    if (!data.eventData.flagged) {
                        var checkoutId = data.eventData.checkout.id;
                        Paddle.Order.details(checkoutId, function(data) {
                            if (!!data) {
                                // Order data, downloads, receipts etc... available within 'data' variable
                                // trackConversion(data);
                                console.log(data, 'payment data');
                                fpr("referral",{email:"ahmadakmal685@gmail.com"});
                            } else {
                                // Order processing delay - order details cannot be retrieved at the moment
                                console.log('Order is being processed')
                            }
                        });
                    } else {
                        // Payment has not been fully processed at the moment, so order details cannot be retrieved
                        console.log('Transaction pending review');
                    }
                }
            }

	    });
    }
});
</script>

<template>
    <AuthLayout>
    <SnackBar v-if="emptyCredit" :isSnackbarVisible="true" status="danger">
            You are Run Out of credit. Please select plan for further use.
        </SnackBar>
        <section class="text-white md:p-8 background-point">
            <div
                class="max-w-screen-xl min-h-screen px-4 py-8 mx-auto lg:py-16 lg:px-6"
            >
                <div
                    class="mx-auto max-w-screen-md text-center mb-8 lg:mb-8 mt-[80px]"
                >
                    <h2
                        class="mb-4 text-6xl font-extrabold tracking-tight text-white dark:text-white"
                    >
                        Plans and Pricing
                    </h2>
                </div>
                <!---->
                <div class="mb-6 text-center">
                    <div class="inline-flex mx-auto rounded-md shadow-sm">
                        <Link

                            :href="route('paddle.pricing-credit')"
                            aria-current="page"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-4 h-4 mr-2 fill-current"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            Credit plans
                        </Link>
                        <Link

                            :href="route('paddle.pricing-premium')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-4 h-4 mr-2 fill-current"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            Premium plans
                        </Link>
                    </div>
                </div>

                <div class="max-w-[100%] md:max-w-[80%] mx-auto">
                    <div
                        class="space-y-8 lg:grid lg:grid-cols-2 sm:gap-6 lg:space-y-0"
                    >
                        <!-- Pricing Card -->
                        <div
                            v-for="plan in props.plans"
                            class="flex flex-col p-6 mx-auto text-center text-white bg-white border border-gray-100 rounded-lg shadow w-80 dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white"
                        >
                            <div class="p-2 my-6 border rounded-lg">
                                <h3
                                    class="mb-4 text-2xl font-semibold text-black"
                                >
                                    {{ plan.name }}
                                </h3>
                                <div
                                    class="flex items-center justify-center text-black"
                                >
                                    <span
                                        class="text-4xl font-extrabold text-bold"
                                        >$</span
                                    >
                                    <span
                                        class="mr-2 font-extrabold text-black text-7xl"
                                        >{{ plan.amount }}</span
                                    >
                                </div>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4">
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span class="text-base text-black">{{
                                        plan.description
                                    }}</span>
                                </li>
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span>Commercial Use</span>
                                </li>
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span>Auto Background Remover</span>
                                </li>
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span>Extra Credits</span>
                                </li>
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span>Prompt Idea Generator</span>
                                </li>
                                <li
                                    class="flex items-center space-x-3 text-black justify-left"
                                >
                                    <!-- Icon -->
                                    <img src="/image/thick.png" alt="" />

                                    <span>Weekly Prompt Idea</span>
                                </li>
                            </ul>


                            <a
                                v-if="plan.type == 'onetime'"
                                :data-override="plan.payLink"
                                href="#!"
                                data-theme="none"
                                class="flex items-center justify-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg paddle_button h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:text-white dark:focus:ring-primary-900"
                            >
                                Choose Plan
                            </a>

                            <a
                                v-else-if="plan.paddle_subscription_plan_id != activePlanId && plan.type == 'recurring'"
                                :data-override="plan.payLink"
                                href="#!"
                                data-theme="none"
                                class="flex items-center justify-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg paddle_button h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:text-white dark:focus:ring-primary-900"
                            >
                                Choose Plan
                            </a>
                            <button v-else class="flex items-center justify-center px-5 py-3 text-sm font-medium text-center text-white bg-indigo-600 rounded-lg h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:text-white dark:focus:ring-primary-900"> Activated</button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="max-w-[100%] my-20 md:max-w-[50%] mx-auto rounded-lg bg-[#082c4b] flex items-center justify-center h-60 mt-20"
            >
                <div>
                    <h1
                        class="flex justify-center mb-4 font-bold text-white text-1xl md:text-3xl"
                    >
                        Need a custom credit offer specifically for you?
                    </h1>

                    <div class="flex flex-wrap justify-center gap-4 mt-8">
                        <a
                            href="https://xinva.ai/contact"
                            class="block w-60 flex items-center justify-center gap-2 rounded bg-[#4A3AFF] px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                        >
                            lets chat
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>
