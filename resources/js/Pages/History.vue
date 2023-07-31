<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";
import moment from 'moment';
import PreviewModal from "@/Pages/PreviewModal.vue";

onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    predictions: Object,
    scale_prediction_id: String,

});
</script>
<script>
export default {
    props: {
        form: Object,
    },
    data() {
        return {
            showModal: false,
            imageUrl: '',
            downloadUrl: '',
            prediction_result_id: 0,
        };
    }
};
</script>
<template>
    <Head title="History" />
    <DashboardLayout>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div> -->


        <section
            class="max-w-[100%] min-h-full mx-auto p-1 rounded-lg z-40 p-2"
        >

            <div>
                <!-- <div v-html="$page.props.adSenseScript"></div> -->
                <h1 class="font-bold text-2xl text-white md:ml-36 ml-0 pl-2">
                    History
                </h1>
                <div v-for="(predictions, date) in props.predictions" :key="date">
                    <h1 class="md:ml-36 ml-0 py-4 text-white pl-2">
                        {{ moment(date).format("MMMM DD, YYYY") }}
                    </h1>

                    <div class="flex flex-wrap justify-center gap-2">
                        <div v-for="img in predictions" class="row pb-4">
                            <div class="position-relative">
                                <svg @click="showModal = true; imageUrl = img.src; download_button=true; show_buttons=false; downloadUrl = img.route" fill="#ffff" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="-24.21 -24.21 290.55 290.55" xml:space="preserve"
                                    class="cursor-pointer h-6 m-2 w-6 right-2 position-absolute">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="5.326926"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path id="XMLID_15_"
                                            d="M227.133,83.033c8.283,0,15-6.716,15-15V15c0-8.284-6.717-15-15-15H174.1c-8.284,0-15,6.716-15,15 s6.716,15,15,15h16.82l-69.854,69.854L51.213,30h16.82c8.284,0,15-6.716,15-15s-6.716-15-15-15H15C6.717,0,0,6.716,0,15v53.033 c0,8.284,6.717,15,15,15c8.285,0,15-6.716,15-15v-16.82l69.854,69.854L30,190.92V174.1c0-8.284-6.715-15-15-15 c-8.283,0-15,6.716-15,15v53.033c0,8.284,6.717,15,15,15h53.033c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-16.82 l69.854-69.854l69.854,69.854H174.1c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h53.033c8.283,0,15-6.716,15-15V174.1 c0-8.284-6.717-15-15-15c-8.285,0-15,6.716-15,15v16.82l-69.854-69.854l69.854-69.854v16.82 C212.133,76.317,218.848,83.033,227.133,83.033z">
                                        </path>
                                    </g>
                                </svg>
                                <img v-bind:src="img.src" class="h-w-250 rounded-lg ">
                            </div>
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

        <!-- The Modal -->
        <PreviewModal v-if="showModal" @close="showModal = false" :image-url="imageUrl" :download_url="downloadUrl" :download_button="true" :show_buttons=false>
        </PreviewModal>
    </DashboardLayout>
</template>
