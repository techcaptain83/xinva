<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head, Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { ref, onMounted } from "vue";
import ProfileImage from "./../Components/ProfileImage.vue"

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },

    hasGoogleProfile: Boolean,
    user: Object,
    hasFacebookProfile: Boolean,
});

onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <Head title="Profile" />

    <DashboardLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>
        <section
            class="max-w-[100%] md:max-w-[50%] mx-auto rounded-lg z-40  p-2 shadow-lg dark:bg-neutral-700 items-center min-h-full md:mt-20"
        >
        <!-- <div v-html="$page.props.adSenseScript"></div> -->
        <ProfileImage :avatar="user.avatar"/>

            <div
                class="p-2 px-1 mr-2 gap-2 md:flex md:flex-wrap grid grid-cols-2  sm:grid-cols-3  lg:grid-cols-2"
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
            <div class="p-3 md:p-10">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
                <!-- <div>
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
                </div> -->
                <!-- <div>
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
                </div> -->
                <!-- <div>
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
                </div> -->
            </div>

            <!-- <div class="p-4 sm:p-8 bg-['#111518'] shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div> -->

            <div class="p-4 sm:p-8 ">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </section>
    </DashboardLayout>
</template>
