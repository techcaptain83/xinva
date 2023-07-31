<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { ref, onMounted } from "vue";

onMounted(() => {
    initFlowbite();
});

</script>

<template>
    <Head title="History" />
    <DashboardLayout>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div> -->

        <section
            class="max-w-[100%] md:max-w-[60%] p-4 mx-auto rounded-lg min-h-full md:mt-20"
        >
            <div>
                <h1 class="font-bold text-black my-4 text-white">
                    How it Works
                </h1>
                <div class="max-w-[100%] mx-auto">
                    <img src="image/Rectangle_image.png" alt="" />
                    <div class="flex justify-center mt-4">
                        <a href="https://youtu.be/tW-8_QwgQXM">
                        <img src="image/youtube_button.png" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>
