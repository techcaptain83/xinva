<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { onMounted } from "vue";
import ProfileImage from "./../Pages/Components/ProfileImage.vue"


onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    hasGoogleProfile: Boolean,
    user: Object,
    hasFacebookProfile: Boolean,
});


</script>

<template>
    <Head title="settings" />
    <DashboardLayout>
        <section
            class="max-w-[100%] md:max-w-[50%] mx-auto rounded-lg z-40 p-2 shadow-lg dark:bg-neutral-700 items-center min-h-full md:mt-20"
        >
        <ProfileImage/>


            <div
                class="p-2 px-1 mr-2 gap-2 md:flex md:flex-wrap grid grid-cols-2"
            >
                <Link
                    href="/settings"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-[#1559ed] ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Profile Information
                </Link>
                <Link
                    href="/subscription/paddle"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Subscription
                </Link>
                <Link
                    href="/credits"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Credits
                </Link>
                <Link
                    href="/payment_history"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Payment History
                </Link>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700" />

            <h1 class="p-3 text-white font-bold">Personal Information</h1>
            <div class="p-3 md:p-10">
                <form
                    @submit.prevent="form.patch(route('profile.update'))"
                >
                    <div class="mb-3">
                        <label
                            for="name"
                            class="block mb-2 font-bold text-white"
                            >Full Name</label
                        >
                        <div class="flex justify-end items-center flex-wrap">
                            <input
                                id="name"
                                type="text"
                                placeholder="Placeholder text"
                                class="border border-indigo-700 shadow p-3 md:w-1/2 rounded"
                                v-model="user.name"
                            />
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;Edit
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label
                            for="name"
                            class="block mb-2 font-bold text-white"
                            >Email Address</label
                        >
                        <div class="flex justify-end items-center flex-wrap">
                            <input
                                id="email"
                                type="text"
                                name="email"
                                placeholder="Placeholder text"
                                v-model="user.email"
                                class="border border-indigo-700 shadow p-3 md:w-1/2 rounded"
                            />
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;Edit
                            </button>
                        </div>
                    </div>
                </form>
                <div>
                    <p class="text-base text-white mt-4 font-bold">Platform</p>
                    <div class="flex items-center">
                        <button
                            aria-label="Continue with google"
                            role="button"
                            class="focus:ring-offset-1 py-3.5 px-2 rounded-md bg-gray-200 border border-gray-400 p-6 dark:bg-neutral-700 flex items-center h-12 justify-center w-40 mt-4"
                        >
                            <img
                                src="image/icon/google icon.png"
                                alt="google"
                            />
                            <p class="text-base font-medium ml-4 text-gray-700">
                                Google
                            </p>
                        </button>
                        <div class="block ml-auto">
                            <label class="switch-1">
                                <input
                                    type="checkbox"
                                    :checked="props.hasGoogleProfile"
                                />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center">
                        <button
                            aria-label="Continue with google"
                            role="button"
                            class="focus:ring-offset-1 py-3.5 px-2 rounded-md bg-gray-200 border border-gray-400 p-6 dark:bg-neutral-700 flex items-center h-12 justify-center w-40 mt-4"
                        >
                            <img
                                src="image/icon/Facebook icon.png"
                                alt="google"
                            />
                            <p class="text-base font-medium ml-6 text-gray-700">
                                Facebook
                            </p>
                        </button>
                        <div class="block ml-auto">
                            <label class="switch-1">
                                <input
                                    type="checkbox"
                                    :checked="props.hasFacebookProfile"
                                />
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-base text-white mt-4 font-bold">Gender</p>

                    <div class="flex flex-wrap mt-4">
                        <div class="flex items-center mr-4">
                            <input
                                id="red-radio"
                                type="radio"
                                value=""
                                name="colored-radio"
                                class="w-4 h-4 text-[#170F49] bg-gray-100 border-gray-300 focus:ring-[#170F49] dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="red-radio"
                                class="ml-2 text-sm font-medium text-white"
                                >Male</label
                            >
                        </div>
                        <div class="flex items-center mr-4">
                            <input
                                id="green-radio"
                                type="radio"
                                value=""
                                name="colored-radio"
                                class="w-4 h-4 text-[#170F49] bg-gray-100 border-gray-300 focus:ring-[#170F49] dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label
                                for="green-radio"
                                class="ml-2 text-white font-medium dark:text-gray-300"
                                >Female</label
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="bg-gray-600 h-14 p-3 ml-10 mt-2 w-14 rounded-full">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="white"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                        />
                    </svg>
                </div>
                <p class="text-white font-bold text-md">
                    Temporary Deactivation
                </p>
            </div>
            <div>
                <p class="max-w-sm ml-28 text-md text-white font-bold">
                    You account is not visble to the public for 30days and you
                    can reactivate the account anytime using your log in
                    credentials
                </p>
            </div>
            <div
                class="h-8 bg-[#1559ed] flex gap-2 rounded-sm ml-28 mt-1 text-white p-3 items-center w-60"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="white"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
                    />
                </svg>

                Temporary Deactivate
            </div>
            <div
                class="h-8 w-28 text-white rounded-sm mt-4 ml-40 md:ml-80 flex items-center p-3 bg-[#1559ed]"
            >
                Save
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 ml-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.5 12.75l6 6 9-13.5"
                    />
                </svg>
            </div>
        </section>
    </DashboardLayout>
</template>
