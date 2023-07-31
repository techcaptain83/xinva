<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Replicate from "replicate";

defineProps({
    detail: Object,
    title: String,
    status: String,
});

const form = useForm({
    prompt: "",
});

const submit = () => {
    console.log(form.prompt);
    form.get(route("predict"));
};

onMounted(() => {
    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});
</script>

<template>
    <Head title="Dashboard" />

    <DashboardLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                    <!---->

                    <!---->
                </div>
            </div>
        </div>

        <div class="absolute right-60 top-60 aside-1">
            <div
                class="bg-white md:space-y-2 p-3 md:p-6 shadow-lg dark:bg-neutral-700 h-[700px] w-[300px] aside-2"
            >
                <h1 class="font-bold flex items-center bg-[#D9DBE9] h-10 p-2">
                    Aspect
                    <img src="image/icon/impot.png" alt="" class="ml-2" />
                    <div class="block ml-auto">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </div>
                </h1>
                <h1
                    class="font-bold flex items-center text-1xl bg-[#D9DBE9] h-10 p-2"
                >
                    4:3
                </h1>
                <h1
                    class="font-bold flex items-center text-1xl bg-[#D9DBE9] h-10 p-2"
                >
                    3:4
                </h1>
                <h1
                    class="font-bold flex items-center text-1xl bg-[#D9DBE9] h-10 p-2"
                >
                    1:1
                </h1>
                <h1 class="font-bold flex items-center bg-[#D9DBE9] h-10 p-2">
                    Details
                    <img src="image/icon/impot.png" alt="" class="ml-2" />
                    <div class="block ml-auto">
                        <label class="switch-1">
                            <input type="checkbox" />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </h1>
                <h1 class="font-bold flex items-center bg-[#D9DBE9] h-10 p-2">
                    Styles
                    <img src="image/icon/impot.png" alt="" class="ml-2" />
                    <div class="block ml-auto">
                        <div class="block ml-auto">
                            <label class="switch-1">
                                <input type="checkbox" checked />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </h1>
                <h1 class="font-bold flex items-center bg-[#D9DBE9] h-10 p-2">
                    Light-effects
                    <img src="image/icon/impot.png" alt="" class="ml-2" />
                    <div class="block ml-auto">
                        <label class="switch-1">
                            <input type="checkbox" checked />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </h1>
                <h1 class="font-bold flex items-center bg-[#D9DBE9] h-10 p-2">
                    Composition
                    <img src="image/icon/impot.png" alt="" class="ml-2" />
                    <div class="block ml-auto">
                        <div class="block ml-auto">
                            <label class="switch-1">
                                <input type="checkbox" checked />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </h1>
            </div>
        </div>

        <div
            class="left-0 w-full border-t md:border-t-0 dark:border-white/20 md:border-transparent md:dark:border-transparent md:bg-vert-light-gradient bg-white dark:bg-gray-800 md:!bg-transparent dark:md:bg-vert-dark-gradient pt-2"
        >
            <form
                class="stretch flex flex-wrap wrapper gap-6 items-center justify-center last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl"
            >
                <!-- mx-2 (is removed) -->
                <div class="flex h-full flex-1 md:flex-col">
                    <div
                        class="flex ml-6 md:w-full md:m-auto md:mb-2 gap-0 md:gap-2 justify-center"
                    ></div>
                    <input
                        v-model="form.prompt"
                        autofocus
                        name="prompt"
                        v-on:keyup.enter="submit()"
                        type="text"
                        id="twitter"
                        placeholder="Describe what you want and seperate them with commas add colors of your choice and text"
                        class="border border-indigo-700 text-xs md:text-sm wrapper h-20 md:h-14 shadow p-3 w-full rounded"
                    />
                </div>

                <button
                    type="button"
                    @click.prevent="submit()"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center rounded bg-indigo-600 h-14 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
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
                    <p class="text-black">Need Inspiration?</p>
                </div>
                <div class="gap-2 flex items-center">
                    <p class="text-black">Try these</p>
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
                class="flex flex-wrap max-w-[50%] justify-center mx-auto gap-20"
            >
                <div class="mt-6">
                    <div class="flex justify-end rounded-lg hero">
                        <!-- <img
                        src="image/carosuel/carosuel-2.png"
                        alt="black chair and white table"
                        class="object-cover object-center w-5/6"
                    /> -->
                        <h1
                            class="text-black p-3 bg-white mt-2 mr-2 h-2 flex items-center"
                        >
                            Remove BG
                        </h1>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Download
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                />
                            </svg>
                        </a>
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Preview
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-6">
                    <div
                        class="flex flex-shrink-0 rounded-lg justify-end w-full sm:w-auto hero"
                    >
                        <!-- <img
                        src="image/carosuel/carosuel-2.png"
                        alt="black chair and white table"
                        class="object-cover object-center w-5/6"
                    /> -->
                        <h1
                            class="text-black p-3 bg-white mt-2 mr-2 h-2 flex items-center"
                        >
                            Remove BG
                        </h1>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Download
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                />
                            </svg>
                        </a>
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Preview
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- <div class="mt-6">
                <div class="flex flex-shrink-0 relative w-full sm:w-auto">
                    <img
                        src="image/carosuel/carosuel-2.png"
                        alt="black chair and white table"
                        class="object-cover object-center w-5/6"
                    />
                </div>
                <div class="mt-8 flex gap-4">
                    <a
                        class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                        href="/"
                    >
                        Download
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                            />
                        </svg>
                    </a>
                    <a
                        class="block h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                        href="/"
                    >
                        Preview
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                            />
                        </svg>
                    </a>
                </div>
            </div> -->
            </div>
            <div
                class="flex flex-wrap max-w-[50%] justify-center mx-auto gap-20"
            >
                <div class="mt-6">
                    <div class="flex justify-end rounded-lg hero">
                        <!-- <img
                        src="image/carosuel/carosuel-2.png"
                        alt="black chair and white table"
                        class="object-cover object-center w-5/6"
                    /> -->
                        <h1
                            class="text-black p-3 bg-white mt-2 mr-2 h-2 flex items-center"
                        >
                            Remove BG
                        </h1>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Download
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                />
                            </svg>
                        </a>
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Preview
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-6">
                    <div
                        class="flex flex-shrink-0 rounded-lg justify-end w-full sm:w-auto hero"
                    >
                        <!-- <img
                        src="image/carosuel/carosuel-2.png"
                        alt="black chair and white table"
                        class="object-cover object-center w-5/6"
                    /> -->
                        <h1
                            class="text-black p-3 bg-white mt-2 mr-2 h-2 flex items-center"
                        >
                            Remove BG
                        </h1>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Download
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"
                                />
                            </svg>
                        </a>
                        <a
                            class="block h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                            href="/"
                        >
                            Preview
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
