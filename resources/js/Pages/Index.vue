<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <AuthLayout>
        <section class=" text-white background-point">
            <div
                class="mx-auto max-w-screen-xl px-4 py-10 lg:flex lg:h-screen lg:items-center"
            >
                <div class="mx-auto max-w-3xl mt-20 lg:mt-0 text-center">
                    <h1
                        class="bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl"
                    >
                        Text to Image Generator

                        <span class="sm:block">with Optizme AI. </span>
                    </h1>

                    <p
                        class="mx-auto mt-4 max-w-xl sm:text-xl text-white font-bold sm:leading-relaxed"
                    >
                        Lorem ipsum dolor sit amet consectetur. Morbi netus
                        morbi sit ultrices dolor vestibulum. Ut faucibus
                        faucibus mi consequat nisl lectus fusce. Enim ac commodo
                        co
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <Link
                            class="block w-60 flex items-center justify-center gap-2 rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                            href="/register"
                        >
                            Start Free Trail
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 "
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                                />
                            </svg>
                        </Link>
                    </div>
                    <div
                        class="flex items-center flex-wrap justify-center gap-4 mt-10"
                    >
                        <div class="gap-2 flex items-center">
                            <img src="image/icon/Vector.png" />
                            <p class="text-white">No credit required</p>
                        </div>
                        <div class="gap-2 flex items-center">
                            <img src="image/icon/Vector.png" />
                            <p class="text-white">HD Pictures</p>
                        </div>
                        <div class="gap-2 flex items-center">
                            <img src="image/icon/Vector.png" />
                            <p class="text-white">25 days free trial</p>
                        </div>
                        <div class="gap-2 flex items-center">
                            <img src="image/icon/Vector.png" />
                            <p class="text-white">Fast Generator</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="brandbg h-60 flex items-center justify-center lg:gap-60"
        >
            <div class="flex grid items-center justify-center gap-4 p-4">
                <h1
                    class="mx-auto mt-4 max-w-md sm:text-3xl text-2xl text-white font-bold sm:leading-relaxed"
                >
                    Used by designers, freelancers, editors and photographers
                </h1>
            </div>

            <div class="flex items-center flex-wrap justify-center gap-4">
                <div class="gap-2 flex items-center">
                    <img src="image/icon/Adobe-1.png" class="w-10 md:w-20" />
                    <img src="image/icon/Adobe-2.png" class="w-10 md:w-20" />
                </div>
                <div class="gap-2 flex items-center">
                    <img src="image/icon/Up-1.png" class="w-10 md:w-20" />
                    <img src="image/icon/Up-2.png" class="w-10 md:w-20" />
                </div>
                <div class="gap-2 flex items-center">
                    <img
                        src="image/icon/Freelancer-1.png"
                        class="w-10 md:w-20"
                    />
                    <img
                        src="image/icon/Freelancer-2.png"
                        class="w-10 md:w-20"
                    />
                </div>
                <div class="gap-2 flex items-center">
                    <img src="image/icon/fiverr-1.png" class="w-10 md:w-20" />
                    <img src="image/icon/fiverr-2.png" class="w-2 md:w-4" />
                </div>
            </div>
        </section>

        <section class="bg-[#111518]">
            <div>
                <h1 class="text-center  font-bold text-white text-4xl pt-10">
                    Featured Gallery
                </h1>
            </div>
            <div
                class="bottom-0 left-0 w-full border-t md:border-t-0 dark:border-white/20 md:border-transparent md:dark:border-transparent  mt-2"
            >
                <form
                    class="stretch flex flex-wrap gap-6 mt-10 md:mt-6 items-center justify-center last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl"
                >
                    <!-- mx-2 (is removed) -->
                    <div class="flex h-full flex-1 md:flex-col p-2 md:p-0">
                        <div
                            class="flex md:w-full md:m-auto md:mb-2 gap-0 md:gap-2 justify-center"
                        ></div>
                        <input
                            id="prompt"
                            name="prompt"
                            required=""
                            oninvalid="this.setCustomValidity('Please Enter valid Keyword')"
                            class="mt-1 px-3 py-2 bg-white border h-14 shadow-md border-indigo-700 wrapper placeholder-slate-400 focus:outline-none focus:border-indigo-700 focus:ring-indigo-700 block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Describe what you want and seperate them with commas add colors of your choice and text"
                        />
                    </div>

                    <button
                        type="submit"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                        class="flex items-center rounded transition ease-in-out delay-150 bg-indigo-600 hover:-translate-y-1  hover:bg-indigo-700 duration-300 bg-indigo-600 h-14 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                    >
                        Generate
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                            />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="flex flex-wrap justify-center mt-10">
                <div class="flex items-center flex-wrap justify-center gap-4">
                    <div class="gap-2 flex items-center">
                        <p class="text-white">Need Inspiration?</p>
                    </div>
                    <div class="gap-2 flex items-center">
                        <p class="text-white">Try these</p>
                    </div>
                    <div class="gap-2 flex items-center">
                        <div class="text-black bg-gray-200 pt-2 p-2 h-8">
                            Black hawk vintage Picture
                        </div>
                    </div>
                    <div class="gap-2 flex items-center">
                        <div class="text-black bg-gray-200 pt-2 p-2 h-8">
                            Black hawk vintage Picture
                        </div>
                    </div>
                    <div class="gap-2 flex items-center">
                        <div class="text-black bg-gray-200 pt-2 p-2 h-8">
                            Black hawk vintage Picture
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div
                    class="flex items-center max-w-[70%] mx-auto justify-center w-full h-full py-24 sm:py-8 px-4"
                >
                    <div
                        class="w-full relative flex items-center justify-center"
                    >
                        <button
                            aria-label="slide forward"
                            id="prev"
                            class="prev-button absolute z-30 left-0 ml-10 rounded-full border border-pink-600 p-2 text-white hover:bg-indigo-600 hover:text-white"
                        >
                            <span class="sr-only">Previous Slide</span>
                            <svg
                                aria-hidden="true"
                                class="h-5 w-5 -rotate-180 transform"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9 5l7 7-7 7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                />
                            </svg>
                        </button>
                        <div
                            class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden"
                        >
                            <div
                                id="slider"
                                class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700"
                            >
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-1.png"
                                        alt="black chair and white table"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-2.png"
                                        alt="sitting area"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-3.png"
                                        alt="sitting area"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-2.png"
                                        alt="sitting area"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-1.png"
                                        alt="sitting area"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                                <div
                                    class="flex flex-shrink-0 relative w-full sm:w-auto"
                                >
                                    <img
                                        src="image/carosuel/carosuel-3.png"
                                        alt="sitting area"
                                        class="object-cover object-center w-full"
                                    />
                                </div>
                            </div>
                        </div>

                        <button
                            aria-label="slide backward"
                            id="next"
                            class="next-button absolute z-30 right-0 mr-10 rounded-full border border-indigo-600 p-2 text-white hover:bg-indigo-600 hover:text-white"
                        >
                            <span class="sr-only">Next Slide</span>
                            <svg
                                aria-hidden="true"
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9 5l7 7-7 7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <h1
                    class="text-center mt-4 font-bold text-white text-3xl md:text-4xl"
                >
                    How it works in few Steps
                </h1>
            </div>
        </section>

        <section class="bg-[#111518] md:max-h-screen max-h-full">
            <div class=" max-w-[67%] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-20">
                    <div class="mt-4">
                        <h1 class="text-indigo-700 text-2xl font-bold">
                            Step1
                        </h1>
                        <p class="max-w-md text-white pt-2">
                            Lorem ipsum dolor sit amet consectetur. Auctor id
                            nulla pretium nisl eget lobortis et faucibus. Ac
                            tincidunt vitae massa scelerisque cras ridiculus
                            sollicitudin eget nulla
                        </p>
                        <h1 class="text-indigo-700 text-2xl font-bold mt-2">
                            Step2
                        </h1>
                        <p class="max-w-md text-white pt-2">
                            Lorem ipsum dolor sit amet consectetur. Auctor id
                            nulla pretium nisl eget lobortis et faucibus. Ac
                            tincidunt vitae massa scelerisque cras ridiculus
                            sollicitudin eget nulla
                        </p>
                        <h1 class="text-indigo-700 text-2xl font-bold mt-2">
                            Step3
                        </h1>
                        <p class="max-w-md text-white pt-2">
                            Lorem ipsum dolor sit amet consectetur. Auctor id
                            nulla pretium nisl eget lobortis et faucibus. Ac
                            tincidunt vitae massa scelerisque cras ridiculus
                            sollicitudin eget nulla
                        </p>
                        <h1 class="text-indigo-700 text-2xl font-bold mt-2">
                            Step4
                        </h1>
                        <p class="max-w-md text-white pt-2 py-6">
                            Lorem ipsum dolor sit amet consectetur. Auctor id
                            nulla pretium nisl eget lobortis et faucibus. Ac
                            tincidunt vitae massa scelerisque cras ridiculus
                            sollicitudin eget nulla
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img src="image/Rectangle 4289.png" alt="" />
                    </div>
                </div>
            </div>
        </section>

        <section class=" bg-[#111518]">
            <div class=" max-w-[67%] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
                    <div class="flex items-center">
                        <img src="image/brandgirl.png" alt="" class="imgbg" />
                    </div>
                    <div class="mt-10">
                        <h1
                            class="text-black bg-blue-200 text-2xl font-bold w-72 text-center"
                        >
                            T-shirt design generator
                        </h1>
                        <h1
                            class="max-w-md text-white text-3xl font-bold pt-6"
                        >
                            Customize your style with text to image generator
                        </h1>
                        <p
                            class="max-w-md mt-4 text-1xl font-bold text-white pt-2"
                        >
                            Lorem ipsum dolor sit amet consectetur. Auctor id
                            nulla pretium nisl eget lobortis et faucibus. Ac
                            tincidunt vitae massa scelerisque cras ridiculus
                            sollicitudin eget nulla. Viverra consequat habitant
                            mollis lectus sollicitudin nunc lorem nec. Ac cursus
                            fermentum non eu cras platea lectus libero.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a
                                class="block w-60 flex items-center justify-center gap-2 rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                                href="/"
                            >
                                Generate for free
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class=" bg-[#111518] pt-10">
            <div class=" max-w-[100%] mx-auto">
                <div class="flex justify-center">
                    <a href="">
                        <img src="image/effects box.png" alt="" />
                    </a>
                </div>
            </div>
            <h1 class="text-center mt-10 text-white font-bold text-4xl">
                Feedback from Users
            </h1>
        </section>

        <section
            id="default-carousel"
            data-carousel="slide"
            class="px-4 bg-[#111518] relative md:max-h-screen max-h-full p-4"
        >
            <div
                class="grid gap-12 relative overflow-hidden text-center h-96 items-center mx-auto max-w-[70%] md:grid-cols-2"
            >
                <div class="mt-4" data-carousel-item>
                    <div class="mb-6 flex justify-center">
                        <img
                            src="image/Testimonal/Testimonal-1.png"
                            class="w-24 rounded-full shadow-lg dark:shadow-black/30"
                        />
                    </div>
                    <p class="mt-4 text-white md:max-w-[50%] mx-auto">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="white"
                            class="inline-block h-7 w-7 pr-2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z"
                            />
                        </svg>
                        Lorem ipsum dolor sit amet consectetur. Ultricies
                        sodales nunc eget justo donec risus vestibulum. Massa
                        lacus sem neque dignissim pellentesque tellus. Urna
                        neque ipsum arcu placerat vivamus.
                    </p>
                    <p class="italic text-white">Vitalik Olesandyka</p>
                    <div>
                        <div class="flex gap-0.5 text-green-500 justify-center">
                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>

                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>

                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>

                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mt-4" data-carousel-item>
                    <div class="mb-6 flex items-center justify-center">
                        <img
                            src="image/Testimonal/Testimonal-2.png"
                            class="w-24 rounded-full shadow-lg dark:shadow-black/30"
                        />
                    </div>
                    <p class="mt-4 text-white md:max-w-[50%] mx-auto">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="white"
                            class="inline-block h-7 w-7 pr-2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z"
                            />
                        </svg>
                        Lorem ipsum dolor sit amet consectetur. Ultricies
                        sodales nunc eget justo donec risus vestibulum. Massa
                        lacus sem neque dignissim pellentesque tellus. Urna
                        neque ipsum arcu placerat vivamus.
                    </p>
                    <p class="italic text-white">Vitalik Olesandyka</p>
                    <div>
                        <div class="flex gap-0.5 text-green-500 justify-center">
                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>

                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>

                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>
                            <svg
                                class="h-5 w-5"
                                fill="#E9F652"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="hidden lg:mt-8 lg:flex lg:gap-4 items-end max-w-[70%] mx-auto justify-end"
            >
                <button
                    class="prev-button rounded-full border border-pink-600 p-3 text-white hover:bg-indigo-600 hover:text-white"
                    data-carousel-prev
                >
                    <span class="sr-only">Previous Slide</span>
                    <svg
                        aria-hidden="true"
                        class="h-5 w-5 -rotate-180 transform"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M9 5l7 7-7 7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>
                </button>

                <button
                    class="next-button rounded-full border border-indigo-600 p-3 text-white hover:bg-indigo-600 hover:text-white"
                    data-carousel-next
                >
                    <span class="sr-only">Next Slide</span>
                    <svg
                        aria-hidden="true"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M9 5l7 7-7 7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>
                </button>
            </div>
        </section>

        <section
            class="relative bg-[#111518] pt-24 pb-28 bg-blueGray-50 overflow-hidden"
        >
            <div class="relative z-10 container px-4 mx-auto">
                <div class="md:max-w-4xl mx-auto">
                    <h1
                        class="mb-16 text-4xl text-white text-center font-bold font-heading tracking-px-n leading-none"
                    >
                        Frequently Asked Questions
                    </h1>

                    <div
                        id="accordion-color"
                        data-accordion="collapse"
                        data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white"
                        class="space-y-2"
                    >
                        <h2 id="accordion-color-heading-1"></h2>
                        <div
                            id="accordion-color-body-1"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-1"
                        >
                            <div
                                class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900"
                            >
                                <p
                                    class="mb-2 text-gray-500 dark:text-gray-400"
                                >
                                    Flowbite is an open-source library of
                                    interactive components built on top of
                                    Tailwind CSS including buttons, dropdowns,
                                    modals, navbars, and more.
                                </p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    Check out this guide to learn how to
                                    <a
                                        href="/docs/getting-started/introduction/"
                                        class="text-blue-600 dark:text-blue-500 hover:underline"
                                        >get started</a
                                    >
                                    and start developing websites even faster
                                    with components on top of Tailwind CSS.
                                </p>
                            </div>
                        </div>
                        <h2 id="accordion-color-heading-2">
                            <button
                                type="button"
                                class="flex items-center justify-between w-full h-16 px-5 bg-white font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-color-body-2"
                                aria-expanded="false"
                                aria-controls="accordion-color-body-2"
                            >
                                <span class="font-bold text-sm md:text-base"
                                    >Why and how does pricing works ?</span
                                >
                                <svg
                                    data-accordion-icon
                                    class="w-6 h-6 shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-color-body-2"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-2"
                        >
                            <div
                                class="p-5 border border-b-0 border-gray-200 dark:border-gray-700"
                            >
                                <p
                                    class="mb-2 text-white dark:text-gray-400"
                                >
                                    Xinva
                                </p>
                            </div>
                        </div>
                        <h2 id="accordion-color-heading-3">
                            <button
                                type="button"
                                class="flex items-center justify-between w-full h-16 px-5 bg-white font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-color-body-3"
                                aria-expanded="false"
                                aria-controls="accordion-color-body-3"
                            >
                                <span class="font-bold text-sm md:text-base"
                                    >Why and how does pricing works ?</span
                                >
                                <svg
                                    data-accordion-icon
                                    class="w-6 h-6 shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-color-body-3"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-3"
                        >
                            <div
                                class="p-5 border border-t-0 border-gray-200 dark:border-gray-700"
                            ></div>
                        </div>
                        <h2 id="accordion-color-heading-4">
                            <button
                                type="button"
                                class="flex items-center justify-between w-full h-16 px-5 bg-white font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-color-body-4"
                                aria-expanded="false"
                                aria-controls="accordion-color-body-4"
                            >
                                <span class="font-bold text-sm md:text-base"
                                    >Why and how does pricing works ?</span
                                >
                                <svg
                                    data-accordion-icon
                                    class="w-6 h-6 shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-color-body-4"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-4"
                        >
                            <div
                                class="p-5 border border-t-0 border-gray-200 dark:border-gray-700"
                            ></div>
                        </div>
                        <h2 id="accordion-color-heading-5">
                            <button
                                type="button"
                                class="flex items-center justify-between w-full h-16 px-5 bg-white font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-color-body-5"
                                aria-expanded="false"
                                aria-controls="accordion-color-body-5"
                            >
                                <span class="font-bold text-sm md:text-base"
                                    >Why and how does pricing works ?</span
                                >
                                <svg
                                    data-accordion-icon
                                    class="w-6 h-6 shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-color-body-5"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-5"
                        >
                            <div
                                class="p-5 border border-t-0 border-gray-200 dark:border-gray-700"
                            ></div>
                        </div>
                        <h2 id="accordion-color-heading-6">
                            <button
                                type="button"
                                class="flex items-center justify-between w-full h-16 px-5 bg-white font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800"
                                data-accordion-target="#accordion-color-body-6"
                                aria-expanded="false"
                                aria-controls="accordion-color-body-6"
                            >
                                <span class="font-bold text-sm md:text-base"
                                    >Why and how does pricing works ?</span
                                >
                                <svg
                                    data-accordion-icon
                                    class="w-6 h-6 shrink-0"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </h2>
                        <div
                            id="accordion-color-body-6"
                            class="hidden"
                            aria-labelledby="accordion-color-heading-6"
                        >
                            <div
                                class="p-5 border border-t-0 border-gray-200 dark:border-gray-700"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
           class="bg-[#111518]" 
        >
            <div class="max-w-[80%]  mx-auto rounded-lg bg-[#07074D]  items-center justify-center h-60 ">
                <h1
                    class="text-white font-bold text-1xl md:text-3xl mb-4 justify-center flex w-100 pt-10"
                >
                    Need to get Started with Image generator
                </h1>
                <p
                    class="font-bold text-white flex justify-center text-1xl md:text-2xl"
                >
                    Sign up and get free 25 credits
                </p>

                <div class=" flex flex-wrap justify-center gap-4">
                    <a
                        class="block w-60 flex items-center justify-center gap-2 rounded  bg-indigo-600 mt-10 px-12 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                        href="/"
                    >
                        Start Free Trail
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

    </AuthLayout>
</template>