<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { ref, onMounted } from "vue";
import ProfileImage from "./../Pages/Components/ProfileImage.vue"


onMounted(() => {
    initFlowbite();
});

defineProps({
  users: Object,
  user: Object,
  subscription: Boolean
})


</script>

<template>
    <Head title="Account_settings" />
    <DashboardLayout>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div> -->

        <section
            class="max-w-[100%] md:max-w-[50%] p-1 mx-auto rounded-lg p-2 shadow-lg items-center min-h-full md:mt-20"
        >
        <!-- <div v-html="$page.props.adSenseScript"></div> -->
        <ProfileImage  :avatar="user.avatar"/>

            <div class="p-2 px-1 mr-2 gap-2 md:flex md:flex-wrap grid grid-cols-2">
                <Link
                    href="/profile"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal text-black shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Profile Information
                </Link>
                <Link
                    href="/subscription/paddle"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white  text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Subscription
                </Link>
                <Link
                    href="/credits"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-[#1559ed]  text-white ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Credits
                </Link>
                <Link
                    href="/payment_history"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white  text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Payment History
                </Link>
            </div>

            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700" />

            <h1 class="p-4 ml-6 text-white font-bold">Credits</h1>
            <div class="p-3 ml-6">
                <form action="">
                    <div v-if="!subscription" class="mb-3">
                        <div class="flex justify-end items-center flex-wrap" v-if="user">
                            <h2
                                for="name"
                                class="block mb-2 font-bold text-white"
                            >
                                Total Credits
                            </h2>
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;
                                <!-- $10 -->
                                {{ user.total_credits }}
                            </button>
                        </div>
                        <div class="flex justify-end items-center flex-wrap" v-if="user">
                            <h2
                                for="name"
                                class="block mb-2 font-bold text-white"
                            >
                                Credits Used
                            </h2>
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;
                                <!-- $10 -->
                                {{ user.credits_used }}
                            </button>
                        </div>
                        <div class="flex justify-end items-center flex-wrap" v-if="user">
                            <h2
                                for="name"
                                class="block mb-2 font-bold text-white"
                            >
                                Remaining Credits
                            </h2>
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;
                                <!-- $10 -->
                                {{ user.total_credits - user.credits_used }}
                            </button>
                        </div>
                    </div>
                    <div v-if="subscription" class="mb-3">
                        <div class="flex justify-end items-center flex-wrap" v-if="user">
                            <h2
                                for="name"
                                class="block mb-2 font-bold text-white"
                            >
                                Total Credits
                            </h2>
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="flex items-center block ml-auto rounded bg-white border text-black h-8 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                            >
                                &nbsp;
                                <!-- $10 -->
                                Unlimited
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="h-px my-1 bg-gray-600 border-0 dark:bg-gray-700" />
        </section>
    </DashboardLayout>
</template>
