<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import ProfileImage from "./../Pages/Components/ProfileImage.vue"
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from "axios";
import { ref } from "vue";

defineProps({
  payment: Object,
  plan: Object,
  user: Object,
  avatar: String,
  activeSubscription: Boolean
})

const subscriptionCancelled = ref(false);

const cancelSubscription = () => {
  const result = Swal.fire({
    title: 'Are you sure?',
    text: 'You want to cancel this subscription!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
  }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            // User clicked "Yes" button
            axios.get(route('cancel-subscription'))
                .then((response) => {
                    // Handle success response
                    console.log(response.data);
                    if(response.data.success) {
                        subscriptionCancelled.value = true;
                        Swal.fire('Success', response.data.message, 'success');
                    } else {
                        Swal.fire('Error', response.data.message, 'error');
                    }
                })
                .catch((error) => {
                    // Handle error response
                    console.error(error);
                    Swal.fire('Error', 'Failed to cancel subscription', 'error');
                });
        }
    });
}

</script>

<template>
    <Head title="subscription" />
    <DashboardLayout>
        <section
            class="max-w-[100%] md:max-w-[50%] z-40 mx-auto rounded-lg  p-2 shadow-lg dark:bg-neutral-700 items-center min-h-full md:mt-20"
        >
        <!-- <div v-html="$page.props.adSenseScript"></div> -->
        <ProfileImage :avatar="user.avatar"/>


            <div class="p-2 px-1 mr-2 gap-2 md:flex md:flex-wrap grid grid-cols-2">
                <Link
                    href="/profile"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-white h-12 mt-2 ml-4  px-6  pb-2 pt-2.5 text-xs font-medium leading-normal text-black shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Profile Information
                </Link>
                <Link
                    href="/subscription/paddle"
                    type="button"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    class="flex items-center w-40 rounded bg-[#1559ed]  text-white ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
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
                    class="flex items-center w-40 rounded bg-white  text-black ml-4 h-12 mt-2 px-6 pb-2 pt-2.5 text-xs font-medium leading-normal shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                >
                    &nbsp;Payment History
                </Link>
            </div>
            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700" />

            <h1 class="p-4 ml-6 text-xl text-white font-bold">Subscription</h1>

            <div class="p-4 ml-6" v-for="payment in payment">
                <div class="">
                    <!-- <img
                        src="image/Testimonal/Testimonal-1.png"
                        alt=""
                        class="p-1 h-14 w-14 rounded-full"

                    /> -->
                    <!-- <img v-blind:src="'public/'+user.avatar" class="p-1 h-14 w-14 rounded-full" /> -->
                    <!-- <ProfileImage  :avatar="user.avatar"/> -->

                    <div>
                        <!-- <h1 class="text-white  font-bold">
                            Pro Membership Plan
                        </h1> -->
                        <h1 class="text-white  font-bold" >
                            Your Plan
                        </h1>
                        <!-- <h1 class="text-white  font-bold">{{ payment.plan.name }}</h1> -->

                    </div>
                    <div class="flex gap-4 flex-wrap items-center py-4">
                        <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="active:bg-primary-800 active:shadow-lg bg-white block border duration-150 ease-in-out flex focus:bg-primary-700 focus:outline-none focus:ring-0 focus:shadow-lg font-medium h-8 hover:bg-primary-700 hover:shadow-lg items-center leading-normal px-6 rounded shadow-md text-black text-xs transition"
                            >
                                &nbsp;
                                {{ payment.plan.name }}
                            </button>
                        <Link :href="route('paddle.pricing-credit')" class="align-center bg-indigo-600 d-flex h-8 p-2 rounded-md text-white w-28">Upgrade Plan</Link>
                        <button v-if="activeSubscription && !subscriptionCancelled && payment.plan.type == 'recurring'"
                                type="button" @click="cancelSubscription"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="align-center bg-indigo-600 d-flex h-8 p-2 rounded-md text-white"
                            >
                                &nbsp;
                                Cancel Subscription
                            </button>
                    </div>
                </div>
                <!-- <div class="pl-20">
                    <p class="text-white py-2 text-base max-w-md font-bold">
                        Your membership will expire whenever you exhaust your
                        allocation of photos generated
                    </p>
                    <p class="text-white py-2 max-w-md font-bold">
                        75/5000 Photos generated
                    </p>
                    <Link :href="route('paddle.pricing-credit')" class="h-10 w-28 rounded-md flex  bg-indigo-600 p-2 text-white mt-10">Upgrade Plan</Link>
                </div> -->
            </div>
            <hr class="h-px my-1 bg-gray-600 border-0 dark:bg-gray-700" />

            <!-- <h1 class="p-4 ml-6 text-xl text-white font-bold">
                Automatic Membership Repayment
            </h1>
            <div class="flex">
                <p
                    class="text-white py-2 ml-12 text-base max-w-xs font-bold"
                >
                    Lorem ipsum dolor sit amet consectetur. In magnis enim ut
                    cursus.
                </p>
                <div class="block ml-auto mr-3">
                    <label class="switch-1">
                        <input type="checkbox" checked />
                        <span class="slider round"></span>
                    </label>
                </div>
            </div> -->
        </section>
    </DashboardLayout>
</template>
