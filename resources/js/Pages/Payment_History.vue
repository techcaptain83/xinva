<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { ref, onMounted } from "vue";
import ProfileImage from "./../Pages/Components/ProfileImage.vue"
import moment from 'moment';


onMounted(() => {
    initFlowbite();
});

defineProps({
  payment: Object,
  plan: Object,
  user: Object
})

const parseDate = (date) => {
    const parsedDate = moment(date).format('YYYY-MM-DD HH:mm:ss');
    return parsedDate;
};

</script>

<template>
    <Head title="Notification" />
    <DashboardLayout>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div> -->

        <section
            class="max-w-[100%] md:max-w-[50%] mx-auto rounded-lg shadow-lg p-2 items-center min-h-full md:mt-20"
        >
        <!-- <div v-html="$page.props.adSenseScript"></div> -->
        <ProfileImage :avatar="user.avatar"/>


            <div class="p-2 px-1 mr-2 gap-2 md:flex md:flex-wrap grid grid-cols-2" >
                <Link
                    href="/profile"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white h-12 mt-2 ml-4 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal text-black shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
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
                    class="flex items-center w-40 rounded bg-white  text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Credits
                </Link>
                <Link
                    href="/payment_history"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-[#1559ed]  text-white ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Payment History
                </Link>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700" />

            <h1 class="p-4 ml-6 text-white font-bold">Payment History</h1>

            <div
                class="p-2 ml-10 my-8 items-center grid grid-cols-2 md:grid-cols-4  gap-2" v-for="payment in payment"
            >
                <div class="w-100 gap-5 grid-item">
                    <h1 class="text-black-700 text-white font-bold">
                        Date/Time
                    </h1>
                    <h1 class="text-black-700 text-white mt-2 font-bold">
                        <!-- 21/04/23,7.13pm -->
                        {{ parseDate(payment.created_at) }}
                    </h1>
                </div>
                <div class="w-100 gap-5 grid-item">
                    <h1 class="text-black-700 text-white font-bold">
                        Plan Name
                    </h1>
                    <h1 class="text-black-700 text-white mt-2 font-bold">
                        <!-- Car -->
                         {{ payment.plan.name }}
                    </h1>
                </div>
                <div class="w-100 gap-5 grid-item">
                    <h1 class="text-black-700 text-white font-bold">Amount</h1>
                    <h1 class="text-black-700 text-white mt-2 font-bold">
                        <!-- $0.10 -->
                        ${{ payment.amount_total }}

                    </h1>
                </div>
                <div class="w-100 gap-5 grid-item">
                    <h1 class="text-black-700 text-white font-bold">Status</h1>
                    <h1 class="text-black-700 text-white mt-2 font-bold">
                        {{ payment.payment_status }}

                    </h1>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>
