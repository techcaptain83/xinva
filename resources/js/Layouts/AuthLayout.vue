<script setup>
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);

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
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="border-gray-200 dark:bg-gray-900">
            <div
                class="flex flex-wrap items-center justify-between md:justify-around mx-auto p-2 md:p-6"
            >
                <Link href="/" class="flex items-center p-6">
                    <img
                        src="/image/logo/Xinva.png"
                        alt=""
                        class="w-24 md:w-40"
                    />
                </Link>

                <button
                    data-collapse-toggle="navbar-default"
                    type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default"
                    aria-expanded="false"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg
                        class="w-6 h-6 text-white"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
                <div
                    class="hidden w-full md:block md:w-auto"
                    id="navbar-default"
                >
                    <ul
                        class="font-medium space-y-8 md:space-y-0 flex flex-col p-4 md:p-0 mt-4 rounded-lg bg-[#1A1A1A] md:bg-transparent md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
                    >
                        <li>
                            <Link
                                href="/index"
                                class="text-md font-semibold leading-6 text-white"
                                aria-current="page"
                                >Product</Link
                            >
                        </li>
                        <li>
                            <Link
                                href="/pricing/credit-plans"
                                class="text-md font-semibold leading-6 text-white"
                                >Pricing</Link
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-md font-semibold leading-6 text-white"
                                >FAQ</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-md font-semibold leading-6 text-white"
                                >Contact</a
                            >
                        </li>
                        <li>
                            <Link :href="route('profile.edit')"
                                href="#"
                                class=" w-full rounded bg-indigo-600 px-12 py-3 text-md font-semibold leading-6 text-white"
                                >Profile</Link
                            >
                        </li>
                    </ul>
                </div>

                <!--
                <div class="hidden lg:flex w-full gap-2 md:block md:w-auto">
                    <Link
                        class="block w-full rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                        href="/login"
                    >
                        Login
                    </Link>
                    <Link
                        class="block w-full rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                        href="/register"
                    >
                        Start for Free
                    </Link>
                </div> -->
            </div>
        </nav>
    </header>

    <slot />

    <!-- <footer>
        <div class="md:h-96 bg-[#111518] min-h-full">
            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-20 max-w-[65%] mx-auto p-2"
            >
                <div class="grid-item mt-10">
                    <div>
                        <img
                            src="/image/logo/Xinva.png"
                            alt=""
                            width="150"
                            height="150"
                            class="ml-6"
                        />
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
                            Lorem ipsum dolor sit amet consectetur. Morbi netus
                            morbi sit ultrices dolor vestibulum. Ut faucibus
                            fauc.
                        </p>
                    </div>
                    <form
                        class="stretch flex flex-wrap gap-6 mt-10 md:mt-6 items-center justify-center last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl"
                    >

                        <div class="flex h-full flex-1 md:flex-col">
                            <div
                                class="flex md:w-full md:m-auto md:mb-2 gap-0 md:gap-2 justify-center"
                            ></div>
                            <input
                                id="prompt"
                                v-on:keyup.enter="submit()"
                                name="prompt"
                                class="mt-1 px-3 py-2 bg-white border h-14 shadow-md border-indigo-700 wrapper placeholder-slate-400 focus:outline-none focus:border-indigo-700 focus:ring-indigo-700 block w-full rounded-md sm:text-sm focus:ring-1"
                                placeholder="enter your email here"
                            />
                        </div>

                        <button
                            type="button"
                            @click.prevent="submit()"
                            data-te-ripple-init
                            data-te-ripple-color="light"
                            class="flex items-center rounded transition ease-in-out delay-150 bg-[#00FFFF] hover:-translate-y-1 hover:bg-[#00FFFF] duration-300 bg-[#00FFFF] h-14 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        >
                            Suscribe
                        </button>
                    </form>
                </div>
            </div>
            <hr
                class="w-full h-1 mx-auto my-6 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700"
            />
            <div>
                <div class="flex flex-wrap space-x-8 justify-center">
                    <Link href="#" class="text-white text-lg"
                        >Terms of service</Link
                    >
                    <Link href="/privacy-policy" class="text-white text-lg"
                        >Privacy Policies</Link
                    >
                    <Link href="#" class="text-white text-lg"
                        >Cookies Settings</Link
                    >
                </div>
            </div>
        </div>
    </footer> -->
</template>
