<script setup>
import { Link } from "@inertiajs/vue3";
import AuthLayout from "@/Layouts/AuthLayout.vue";
defineProps({ page: Object });
</script>

<template>
    <AuthLayout
        :title="page?.title ? page.title : 'Privacy Policy'"
        :seo_meta_description="page?.meta_description"
    >
        <section class="md:p-8 text-white background-point">
            <div
                class="py-8 px-4 mx-auto max-w-screen-xl min-h-screen lg:py-16 lg:px-6"
            >
                <div
                    class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12 mt-40"
                >
                    <h2
                        class="mb-4 text-4xl tracking-tight font-extrabold text-white dark:text-white"
                    >
                        Privacy Policy
                    </h2>
                    <p
                        class="mb-5 font-light text-white sm:text-xl dark:text-gray-400"
                    >
                        Lorem ipsum dolor sit amet consectetur. Auctor id nulla
                        pretium nisl eget lobortis et faucibus. Ac tincidunt
                        vitae massa scelerisque cras ridiculus sollicitudin eget
                        nulla
                    </p>
                </div>
                <div class="max-w-[100%] md:max-w-[60%] my-2 mx-auto">
                    <div v-html="page?.content" class="text-lg"></div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>
