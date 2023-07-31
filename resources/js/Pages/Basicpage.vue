<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { useForm, router } from "@inertiajs/vue3";

const form = useForm({
    project_name: "",
    sitemap_path: "",
    csrf: "",
});

onMounted(() => {
    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});
</script>

<template>
    <Head title="Plans" />

    <AuthenticatedLayout>
        <!---->

        <!-- Content -->

        <!-- Pricing Plans -->
        <div class="pb-sm-5 pb-2 rounded-top">
            <div class="container py-5">
                <h2 class="text-center mb-2 mt-0 mt-md-4">Basic</h2>
                <p class="text-center">
                    Get started with us - it's perfect for individuals and
                    teams. Choose a subscription plan that meets your needs.
                </p>
                <div
                    class="d-flex align-items-center justify-content-center flex-wrap gap-2 pb-5 pt-3 mb-0 mb-md-4"
                ></div>

                <form method="POST" action="/plans/basic/pay">
                    <input type="hidden" name="_token" :value="form.csrf" />

                    <label for="firstName" class="form-label"
                        >Credit or debit card</label
                    >
                    <input
                        class="form-control rounded w-100"
                        type="number"
                        name="cardno"
                        placeholder="Card number"
                        autofocus=""
                        style="max-width: 600px"
                    />
                    <br /><br />
                    <label for="firstName" class="form-label"
                        >Expiration Date</label
                    >
                    <input
                        class="form-control rounded w-100"
                        type="number"
                        name="date"
                        placeholder="Card number"
                        autofocus=""
                        style="max-width: 600px"
                    />
                    <br /><br />
                    <label for="firstName" class="form-label">year</label>
                    <input
                        class="form-control rounded w-100"
                        type="number"
                        name="year"
                        placeholder="Card number"
                        autofocus=""
                        style="max-width: 600px"
                    />
                    <br /><br />
                    <label for="firstName" class="form-label">CVV</label>
                    <input
                        class="form-control rounded w-100"
                        type="number"
                        name="cvv"
                        placeholder="Card number"
                        autofocus=""
                        style="max-width: 600px"
                    />
                    <br /><br />

                    <a href="">
                        <button
                            type="submit"
                            class="btn btn-primary waves-effect waves-light"
                            id="position-bottom-start"
                            style="background-color: #7367f0"
                        >
                            Submit
                        </button>
                    </a>
                </form>

                <!--/ FAQS -->
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->

        <!-- / Footer -->

        <!---->
    </AuthenticatedLayout>
</template>
