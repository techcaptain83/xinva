<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    plans: Object,
});
</script>

<template>
    <Head title="Plans" />

    <AuthenticatedLayout>
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <!-- Pricing Plans -->
                <div class="pb-sm-5 pb-2 rounded-top">
                    <div class="container py-5">
                        <h1
                            class="text-center font-bold mb-2 mt-0 mt-md-4 text-3xl"
                        >
                            Plans
                        </h1>
                        <p class="text-center">
                            Get started with us - it's perfect for individuals
                            and teams. Choose a subscription plan that meets
                            your needs.
                        </p>
                        <div
                            class="d-flex align-items-center justify-content-center flex-wrap gap-2 pb-5 pt-3 mb-0 mb-md-4"
                        ></div>

                        <div class="row mx-0 gy-3 px-lg-5">
                            <!-- Basic -->
                            <div
                                class="col-lg mb-md-0 mb-4"
                                v-for="plan in plans"
                            >
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img
                                                src=""
                                                alt="Basic Image"
                                                height="140"
                                            />
                                        </div>
                                        <h3
                                            class="card-title fw-semibold text-center text-capitalize mb-1"
                                        >
                                            {{ plan.name }}
                                        </h3>
                                        <p class="text-center">
                                            A simple start for everyone
                                        </p>
                                        <div class="text-center">
                                            <div
                                                class="d-flex justify-content-center"
                                            >
                                                <sup
                                                    class="h6 pricing-currency mt-3 mb-0 me-1 text-primary"
                                                    >$</sup
                                                >
                                                <h1
                                                    class="fw-semibold display-4 mb-0 text-primary"
                                                >
                                                    {{ plan.price }}
                                                </h1>
                                                <sub
                                                    class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal"
                                                    >/month</sub
                                                >
                                            </div>
                                        </div>

                                        <ul class="ps-3 my-4 pt-2">
                                            <li class="mb-2">
                                                100 responses a month
                                            </li>
                                            <li class="mb-2">
                                                Unlimited forms and surveys
                                            </li>
                                            <li class="mb-2">
                                                Unlimited fields
                                            </li>
                                            <li class="mb-2">
                                                Basic form creation tools
                                            </li>
                                            <li class="mb-0">
                                                Up to 2 subdomains
                                            </li>
                                        </ul>

                                        <a
                                            :href="
                                                route('checkout-plan', plan.id)
                                            "
                                            class="btn btn-label-success d-grid w-100 waves-effect"
                                            >Your Current Plan</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!---->
    </AuthenticatedLayout>
</template>
