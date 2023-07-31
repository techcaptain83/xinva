<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Replicate from "replicate";
import axios from "axios";
import PreviewModal from "@/Pages/PreviewModal.vue";

const props = defineProps({
    bg_prediction_id: String,
    status: String,
});

const form = useForm({
    prompt: "",
    image: "",
});

// background start //
const bg_prediction_id = ref("");
const bg_prediction_loading = ref(true);
const bg_prediction_check_interval = ref(null);
const bg_prediction_output = ref("");

const removeBG = async () => {
    axios.get(route("background-response", props.bg_prediction_id)).then((response) => {
        console.log(response);
        if (response.data.completed_at !== null) {
            clearInterval(bg_prediction_check_interval.value);
            bg_prediction_loading.value = false;
            bg_prediction_output.value = response.data.output;
            bg_prediction_id.value = response.data.bg_prediction_id;
            // window.location.href = '/prediction-results/'+bg_prediction_id.value+'/remove-bg/scale';
        }
    });
};

onMounted(() => {
    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    bg_prediction_check_interval.value = setInterval(removeBG, 3000);
});
</script>
<script>
export default {
    props: {
        form: Object,
    },
    data() {
        return {
            activeTab: 'design-tab',
            showModal: false,
            imageUrl: '',
            prediction_result_id: 0,
            buttonPrompt: '',
        };
    },
    methods: {
        tabClick(val) {
            this.activeTab = val;
        },
    }
};
</script>
<template>
    <Head title="Remove_bg" />

    <DashboardLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
        </div>

        <div
            class="flex flex-col lg:flex-row max-w-[100%] mx-auto justify-center"
        >
            <div class="w-100">
                <div
                    v-if="!bg_prediction_loading && prediction_output != ''"
                    class="flex flex-wrap justify-content-center mt-10 gap-10"
                    rel=""
                >
                    <div
                        class="flex flex-wrap justify-center"
                    >
                        <div class="position-relative">

                            <svg @click="showModal = true; imageUrl = bg_prediction_output;" fill="#ffff" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="-24.21 -24.21 290.55 290.55" xml:space="preserve"
                                class="cursor-pointer h-6 m-2 w-6 right-0 position-absolute">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                    stroke="#CCCCCC" stroke-width="5.326926"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path id="XMLID_15_"
                                        d="M227.133,83.033c8.283,0,15-6.716,15-15V15c0-8.284-6.717-15-15-15H174.1c-8.284,0-15,6.716-15,15 s6.716,15,15,15h16.82l-69.854,69.854L51.213,30h16.82c8.284,0,15-6.716,15-15s-6.716-15-15-15H15C6.717,0,0,6.716,0,15v53.033 c0,8.284,6.717,15,15,15c8.285,0,15-6.716,15-15v-16.82l69.854,69.854L30,190.92V174.1c0-8.284-6.715-15-15-15 c-8.283,0-15,6.716-15,15v53.033c0,8.284,6.717,15,15,15h53.033c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-16.82 l69.854-69.854l69.854,69.854H174.1c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h53.033c8.283,0,15-6.716,15-15V174.1 c0-8.284-6.717-15-15-15c-8.285,0-15,6.716-15,15v16.82l-69.854-69.854l69.854-69.854v16.82 C212.133,76.317,218.848,83.033,227.133,83.033z">
                                    </path>
                                </g>
                            </svg>
                            <img v-bind:src="bg_prediction_output" class="h-w-512 rounded-lg ">
                            <div class="flex gap-4 justify-center my-3">
                                <Link
                                :href="'/prediction-results/'+bg_prediction_id+'/remove-bg/scale'"
                                    class="block h-10 flex items-center gap-2 rounded-lg border border-blue-600 bg-indigo-600 px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
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
                                </Link>
                                <!-- <a
                                    class="block myImg h-10 flex items-center gap-2 rounded-lg border border-indigo-600 bg-white px-3 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"
                                    href="#"
                                    :data-img="bg_prediction_output"
                                >
                                    Preview
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6"
                                        :data-img="img"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                                        />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                                        />
                                    </svg>
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="bg_prediction_loading">
                    <div
                        role="status"
                        class="flex items-center mt-60 justify-center"
                    >
                    <!-- <button
                            disabled
                            type="button"
                            class="text-white bg-[#5145CD] hover:bg-[#5145CD] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                        >
                            <svg
                                aria-hidden="true"
                                role="status"
                                class="inline w-4 h-4 mr-3 text-white animate-spin"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"
                                />
                            </svg>
                            Loading...
                        </button> -->
                        <img v-bind:src="'/image/opener_loading.gif'" class="h-36 w-36" alt="Loading..." />
                    </div>
                </div>



            </div>
            <!-- <div>
                <div class="mt-20">
                    <div class="lg:mt-20 mt-10">
                    <div
                        class="md:space-y-2 p-3 md:p-6 dark:bg-neutral-700 h-[350px] md:h-[700px] w-[260px] md:w-[300px]"
                    >
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            Aspect
                            <img
                                src="image/icon/impot.png"
                                alt=""
                                class="ml-2"
                            />
                            <div class="block ml-auto">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-4 h-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                    />
                                </svg>
                            </div>
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            4:3
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            3:4
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            1:1
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            Details
                            <img
                                src="image/icon/impot.png"
                                alt=""
                                class="ml-2"
                            />
                            <div class="block ml-auto">
                                <label class="switch-1">
                                    <input type="checkbox" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            Styles
                            <img
                                src="image/icon/impot.png"
                                alt=""
                                class="ml-2"
                            />
                            <div class="block ml-auto">
                                <div class="block ml-auto">
                                    <label class="switch-1">
                                        <input type="checkbox" checked />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            Light-effects
                            <img
                                src="image/icon/impot.png"
                                alt=""
                                class="ml-2"
                            />
                            <div class="block ml-auto">
                                <label class="switch-1">
                                    <input type="checkbox" checked />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </h1>
                        <h1
                            class="font-bold flex items-center text-white rounded-lg h-10 p-2 shadow-sm shadow-pink-950 bg-[#111518]"
                        >
                            Composition
                            <img
                                src="image/icon/impot.png"
                                alt=""
                                class="ml-2"
                            />
                            <div class="block ml-auto">
                                <div class="block ml-auto">
                                    <label class="switch-1">
                                        <input type="checkbox" checked />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </h1>
                    </div>
                </div>
                </div>
            </div> -->

            <!-- The Modal -->
            <PreviewModal v-if="showModal" @close="showModal = false" :image-url="imageUrl" :prediction_result_id="prediction_result_id" :show_buttons=false>
            </PreviewModal>
        </div>
    </DashboardLayout>
</template>
