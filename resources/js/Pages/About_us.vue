<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";

defineProps({
    plans: Object,
});

onMounted(() => {
    initFlowbite();
    setTimeout(appendFlowbiteJS, 200);
    setTimeout(appendMainJS, 400);

    function appendMainJS() {
        let mainJS = document.getElementById("main-js");
        if (mainJS != null) {
            mainJS.remove();
        }

        let mainScript = document.createElement("script");
        mainScript.setAttribute("src", "/js/main.js?v=1.0.0");
        mainScript.setAttribute("id", "main-js");
        document.body.appendChild(mainScript);
    }

    function appendFlowbiteJS() {
        let flowbiteJS = document.getElementById("flowbite-js");
        if (flowbiteJS != null) {
            flowbiteJS.remove();
        }

        let flowbiteScript = document.createElement("script");
        flowbiteScript.setAttribute("src", "/js/flowbite.js");
        flowbiteScript.setAttribute("id", "flowbite-js");
        // document.body.appendChild(flowbiteScript);
    }
});
</script>

<template>
    <AuthLayout>
        <section class="bg-indigo-100 md:p-8 text-white">
            <div
                class="py-8 px-4 mx-auto max-w-screen-xl min-h-screen lg:py-16 lg:px-6"
            >
                <div
                    class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12 mt-40"
                >
                    <h2
                        class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
                    >
                        Plans and Prices
                    </h2>
                    <p
                        class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400"
                    >
                        Lorem ipsum dolor sit amet consectetur. Auctor id nulla
                        pretium nisl eget lobortis et faucibus. Ac tincidunt
                        vitae massa scelerisque cras ridiculus sollicitudin eget
                        nulla
                    </p>
                </div>

                <div class="max-w-[100%] md:max-w-[80%] mx-auto">
                    <div
                        class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0"
                    >
                        <!-- Pricing Card -->
                        <div
                            v-for="plan in plans"
                            class="flex flex-col p-6 mx-auto w-80 text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white"
                        >
                            <div class="border my-6 p-2 rounded-lg">
                                <h3 class="mb-4 text-2xl font-semibold">
                                    {{ plan.name }}
                                </h3>
                                <div class="flex justify-center items-center">
                                    <span
                                        class="text-4xl text-bold font-extrabold"
                                        >$</span
                                    >
                                    <span
                                        class="mr-2 text-7xl font-extrabold"
                                        >{{ plan.amount }}</span
                                    >
                                </div>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4">
                                <li
                                    class="flex items-center justify-center space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>25 Free Photo</span>
                                </li>
                                <li
                                    class="flex items-center justify-center space-x-3"
                                >
                                    <!-- Icon -->
                                    <img src="image/thick.png" alt="" />

                                    <span>HD Resolution</span>
                                </li>
                                <li
                                    class="flex items-center justify-center space-x-3"
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
                                class="text-white bg-indigo-600 h-14 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-3 text-center dark:text-white dark:focus:ring-primary-900"
                                >Start for free</a
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="max-w-[100%] my-20 md:max-w-[50%] mx-auto rounded-lg bg-indigo-200 flex items-center justify-center h-60 mt-20"
            >
                <div>
                    <h1
                        class="text-black font-bold text-1xl md:text-3xl mb-4 justify-center flex"
                    >
                        Need a custom credit offer specifically for you?
                    </h1>
                    <p
                        class="font-bold text-black flex justify-center text-1xl md:text-2xl"
                    >
                        Sign up and get free 25 credits
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a
                            class="block w-60 flex items-center justify-center gap-2 rounded border border-blue-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                            href="/"
                        >
                            lets chat
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div
                class="md:h-96 bg-[#4A3AFF] min-h-full"
                style="background: rgba(0, 88, 191, 0.7)"
            >
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-20 max-w-[65%] mx-auto p-2"
                >
                    <div class="grid-item mt-10">
                        <div>
                            <h1 class="text-3xl text-white">Brand Name</h1>
                        </div>
                        <div class="flex flex-wrap gap-3 mt-32 text-[#D4C6C6]">
                            <i class="fa-brands fa-twitter fa-xl"></i>
                            <i class="fa-brands fa-instagram fa-xl"></i>
                            <i class="fa-brands fa-linkedin fa-xl"></i>
                            <i class="fa-brands fa-google-plus-g fa-xl"></i>

                            <i class="fa-brands fa-square-facebook fa-xl"></i>
                        </div>
                    </div>
                    <div class="grid-item mt-10">
                        <div>
                            <h1 class="text-2xl font-semibold text-white">
                                Subscribe to our Newsletters
                            </h1>
                            <p class="max-w-sm text-white mt-2 text-base">
                                Lorem ipsum dolor sit amet consectetur. Morbi
                                netus morbi sit ultrices dolor vestibulum. Ut
                                faucibus fauc.
                            </p>
                        </div>
                        <form
                            class="stretch flex flex-wrap gap-6 mt-10 md:mt-6 items-center justify-center last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl"
                        >
                            <!-- mx-2 (is removed) -->
                            <div class="flex h-full flex-1 md:flex-col">
                                <div
                                    class="flex md:w-full md:m-auto md:mb-2 gap-0 md:gap-2 justify-center"
                                ></div>
                                <input
                                    id="prompt"
                                    name="prompt"
                                    class="mt-1 px-3 py-2 bg-white border h-14 shadow-md border-indigo-700 wrapper placeholder-slate-400 focus:outline-none focus:border-indigo-700 focus:ring-indigo-700 block w-full rounded-md sm:text-sm focus:ring-1"
                                    placeholder="enter your email here"
                                />
                            </div>

                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center rounded transition ease-in-out delay-150 bg-[#00FFFF] hover:-translate-y-1 hover:scale-110 hover:bg-[#00FFFF] duration-300 bg-[#00FFFF] h-14 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-black shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                Suscribe
                            </button>
                        </form>
                    </div>
                </div>
                <hr
                    class="w-full h-1 mx-auto my-10 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700"
                />
                <div>
                    <div class="flex flex-wrap space-x-8 justify-center">
                        <h1 class="text-white">Terms and Condition</h1>
                        <h1 class="text-white">Privacy Policies</h1>
                        <h1 class="text-white">Cookies Settings</h1>
                    </div>
                </div>
            </div>
        </footer>
    </AuthLayout>
</template>
