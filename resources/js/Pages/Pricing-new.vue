<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";
import AuthLayout from "@/Layouts/AuthLayout.vue";

defineProps({
    plans: Object,
});
</script>

<template>
    <AuthLayout>
        <section class="md:p-8 text-white background-point">
            <div
                class="py-8 px-4 mx-auto max-w-screen-xl min-h-screen lg:py-16 lg:px-6"
            >
                <div
                    class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12 mt-40"
                >
                    <h2
                        class="mb-4 text-4xl tracking-tight font-extrabold text-white dark:text-white"
                    >
                        Plans and Prices
                    </h2>
                    <p
                        class="mb-5 font-light text-white sm:text-xl dark:text-gray-400"
                    >
                        Lorem ipsum dolor sit amet consectetur. Auctor id nulla
                        pretium nisl eget lobortis et faucibus. Ac tincidunt
                        vitae massa scelerisque cras ridiculus sollicitudin eget
                        nulla
                    </p>
                </div>
                <!---->
                <div class="text-center mb-5">
<div class="inline-flex rounded-md shadow-sm">
  <Link :href="route('pricing')" aria-current="page" class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
    Credit Plans
  </Link>
  <Link :href="route('pricingnew')" id="2" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
    Premium Plan
  </Link>
</div>
</div>
                <!---->

                <div class="max-w-[100%] md:max-w-[80%] mx-auto">

                    <div
                        class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0"
                    >
                        <!-- Pricing Card -->
                        <div
                            v-for="plan in plans"
                            class="flex flex-col p-6 mx-auto w-80 text-center text-white bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white"
                        >
                            <div class="border my-6 p-2 rounded-lg">
                                <h3
                                    class="mb-4 text-2xl text-black font-semibold"
                                >
                                    {{ plan.name }}
                                </h3>
                                <div
                                    class="flex justify-center text-black items-center"
                                >
                                    <span
                                        class="text-4xl text-bold font-extrabold"
                                        >$</span
                                    >
                                    <span
                                        class="mr-2 text-7xl text-black font-extrabold"
                                        >{{ plan.amount }}</span
                                    >
                                </div>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4">
                                <li
                                    class="flex items-center text-black justify-center space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>25 Free Photo</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-center space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>HD Resolution</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-center space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>HD Resolution</span>
                                </li>
                            </ul>
                            <!-- <a
                            href="#"
                            class="text-white bg-indigo-600 h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >Start for free</a
                        > -->
                            <a
                                :href="route('checkout-plan', plan.id)"
                                class="text-white bg-indigo-600 h-14 flex justify-center items-center hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >
                                Start for free
                            </a>
                        </div>
                        <!---->

                        <div
                            class="flex flex-col p-6 mx-auto w-80 text-center text-white bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white"
                        >
                            <div class="border my-6 p-2 rounded-lg">
                                <h3
                                    class="mb-4 text-2xl text-black font-semibold"
                                >
                                    Monthly
                                </h3>
                                <div
                                    class="flex justify-center text-black items-center"
                                >
                                    <span
                                        class="text-4xl text-bold font-extrabold"
                                        >$</span
                                    >
                                    <span
                                        class="mr-2 text-7xl text-black font-extrabold"
                                        >39</span
                                    >
                                    <span
                                        class="mr-2 text-xl text-black font-extrabold"
                                        >/month</span
                                    >
                                </div>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4">
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Billed Monthly</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Unlimited Credits</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Commercial Use</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Auto Background Remover</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span> Prompt Idea Generator</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Weekly Prompt Idea</span>
                                </li>
                            </ul>
                            <!-- <a
                            href="#"
                            class="text-white bg-indigo-600 h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >Start for free</a
                        > -->
                            <Link
                                href="profile"
                                class="text-white bg-indigo-600 h-14 flex justify-center items-center hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >
                                lets chat
                            </Link>
                        </div>
        
                        <div
                            class="flex flex-col p-6 mx-auto w-80 text-center text-white bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white"
                        >
                            <div class="border my-6 p-2 rounded-lg">
                                <h3
                                    class="mb-4 text-2xl text-black font-semibold"
                                >
                                    Yearly
                                </h3>
                                <div
                                    class="flex justify-center text-black items-center"
                                >
                                    <span
                                        class="text-4xl text-bold font-extrabold"
                                        >$</span
                                    >
                                    <span
                                        class="mr-2 text-7xl text-black font-extrabold"
                                        >239</span
                                    >
                                    <span
                                        class="mr-2 text-xl text-black font-extrabold"
                                        >/year</span
                                    >
                                </div>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4">
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Billed Monthly</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Unlimited Credits</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Commercial Use</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Auto Background Remover</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span> Prompt Idea Generator</span>
                                </li>
                                <li
                                    class="flex items-center text-black justify-left space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>Weekly Prompt Idea</span>
                                </li>
                            </ul>
                            <!-- <a
                            href="#"
                            class="text-white bg-indigo-600 h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >Start for free</a
                        > -->
                            <Link
                                href="profile"
                                class="text-white bg-indigo-600 h-14 flex justify-center items-center hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                            >
                                lets chat
                            </Link>
                        </div>
                       
                    </div>
                </div>
            </div>

            <div
                class="max-w-[100%] my-20 md:max-w-[50%] mx-auto rounded-lg bg-[#082c4b] flex items-center justify-center h-60 mt-20"
            >
                <div>
                    <h1
                        class="text-white font-bold text-1xl md:text-3xl mb-4 justify-center flex"
                    >
                        Need a custom credit offer specifically for you?
                    </h1>
                    <p
                        class="font-bold text-white flex justify-center text-1xl md:text-2xl"
                    >
                        Sign up and get free 25 credits
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a
                            class="block w-60 flex items-center justify-center gap-2 rounded bg-[#4A3AFF] px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                            href="/"
                        >
                            lets chat
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>
