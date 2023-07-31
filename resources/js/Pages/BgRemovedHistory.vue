<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";
import moment from 'moment';

onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    predictions: Object,
    scale_prediction_id: String,

});
</script>

<template>
    <Head title="History" />
    <DashboardLayout>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div> -->


        <section
            class="max-w-[100%] z-40 md:max-w-[72%] p-1 mx-auto rounded-lg min-h-full md:mt-10"
        >

                <!---->
                <div class="flex justify-center">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
  <Link href="/history" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
    Generated Images
  </Link>
  <Link href="/history/bg-removed" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
    Bg-removed Images
  </Link>
  <Link href="/history/scaled" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
    Scaled Images
  </Link>
</div>
</div>

        <!---->


            <div>
                <h1 class="font-bold text-2xl text-white ml-36 md:ml-0">
                    Bg removed images - History
                </h1>
                <div v-for="prediction in props.predictions" >
                    <h1 class="font-bold mt-2 text-base ml-36 md:ml-0">
                        {{ moment(prediction.created_at).format("MMMM DD, YYYY") }}
                    </h1>

                    <div class="flex flex-wrap justify-center gap-10">
                        <div v-for="img in prediction.bg_removed_results">

                            <img
                                v-bind:src="
                                    '/storage/generated_images/bg_removed/' +
                                    img.generated_file_name
                                "
                                class="h-80 w-60 mt-4 rounded-lg"
                            />
                            <!---->
                            <div class="mt-6 flex justify-center gap-4">
                                <a
                                    :href="
                                        '/bgremoved-prediction-result/' +
                                        img.id +
                                        '/download'
                                    "
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
                            </div>
                            <!---->
                        </div>
                    </div>
                </div>

                <!-- <div v-for="prediction in predictions">
                    <h1 class="font-bold mt-2 text-base ml-36 md:ml-0">
                        {{ prediction.created_at }}
                    </h1>

                    <div class="flex flex-wrap justify-center gap-10">
                        <div v-for="image in prediction">

                        <img
                            v-bind:src="
                                '/storage/generated_images/' +
                                prediction.generated_file_name
                            "
                            class="h-80 w-60 mt-4 rounded-lg"
                        />

                        </div>
                    </div>
                </div> -->

            </div>

        </section>
    </DashboardLayout>
</template>
