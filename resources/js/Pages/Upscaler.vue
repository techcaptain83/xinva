<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Replicate from "replicate";
import axios from "axios";
import PreviewModal from "@/Pages/PreviewModal.vue";

// const props = defineProps({
//     bg_prediction_id: String,
//     status: String,
//     tool: String,
// });

const form = useForm({
    prompt: "",
    image: null,
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
        selectedValue: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            showModal: false,
            image: null,
            scale_prediction_id: '',
            selectedOption: this.selectedValue,
            scale_prediction_output:'',
            scale_prediction_loading: false

        };
    },
    methods: {
        redirectToPage(event) {
            const selectedPage = event.target.value;
            console.log(selectedPage);
            if (selectedPage) {
                window.location.href = selectedPage;
            }
        },
        handleFileChange(event) {
            this.image = event.target.files[0];
        },
        submit() {
        const formData = new FormData();
        formData.append('image', this.image);

        axios.post(route('custom.upscaler.store'), formData)
            .then(response => {
                // Handle the response as needed
                if(response.data.success) {
                    this.scale_prediction_id = response.data.scale_prediction_id
                    const intervalId = setInterval(() => {
                        axios.get(route("scale-image", this.scale_prediction_id)).then((response) => {
                        if (response.data.output) {
                            clearInterval(intervalId);
                            this.scale_prediction_loading = false;
                            this.scale_prediction_output = response.data.output;
                        }
                    });
                    }, 10000);
                }
                console.log(response.data);
            })
            .catch(error => {
                // Handle errors
                console.error(error);
            });
        }
    }
};
</script>
<template>
    <Head title="Tools" />

    <DashboardLayout>
        <div class="flex vh-100 row">
            <SnackBar v-if="empty_prompt" :isSnackbarVisible="true" status="danger">
                Prompt is empty!
            </SnackBar>

            <SnackBar v-if="api_error" :isSnackbarVisible="true" status="danger">
                {{ api_error_msg }}
            </SnackBar>
            <div class="col-md-9 col-sm-12 h-100 image-content">
                <div class="flex flex-col justify-center md:max-w-[100%] p-4 text-white xl:flex-row">
                    <div class="align-items-center col-md-9 flex h-14 justify-around md:mx-auto position-relative rounded-md">
                        <div class="col-12 flex h-full items-center position-absolute">

                            <input @change="handleFileChange" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">

                        </div>
                        <div class="col-3 flex justify-content-center justify-end mr-4 offset-9 position-absolute">
                            <button v-if="!scale_prediction_loading" type="submit" @click.prevent="submit($event); scale_prediction_loading=true;"
                                class="button flex items-center rounded transition ease-in-out delay-150 hover:-translate-y-1 hover:bg-indigo-700 duration-800 h-9 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg bg-linear">
                                <span class="button__text flex">Upload
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div v-if="!scale_prediction_loading && scale_prediction_output != ''"
                    class="flex flex-wrap justify-content-center mt-10 gap-10" rel="">
                    <div class="flex flex-wrap justify-center">
                        <div class="mt-6">
                            <div class="flex justify-end rounded-lg hero h-w-512" v-bind:style="{
                                backgroundImage: 'url(' + scale_prediction_output + ')',
                            }">
                                <svg @click="showModal = true; imageUrl = scale_prediction_output;" fill="#ffff" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="-24.21 -24.21 290.55 290.55" xml:space="preserve"
                                    class="cursor-pointer h-6 m-2 w-6">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                        stroke="#CCCCCC" stroke-width="5.326926"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path id="XMLID_15_"
                                            d="M227.133,83.033c8.283,0,15-6.716,15-15V15c0-8.284-6.717-15-15-15H174.1c-8.284,0-15,6.716-15,15 s6.716,15,15,15h16.82l-69.854,69.854L51.213,30h16.82c8.284,0,15-6.716,15-15s-6.716-15-15-15H15C6.717,0,0,6.716,0,15v53.033 c0,8.284,6.717,15,15,15c8.285,0,15-6.716,15-15v-16.82l69.854,69.854L30,190.92V174.1c0-8.284-6.715-15-15-15 c-8.283,0-15,6.716-15,15v53.033c0,8.284,6.717,15,15,15h53.033c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-16.82 l69.854-69.854l69.854,69.854H174.1c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h53.033c8.283,0,15-6.716,15-15V174.1 c0-8.284-6.717-15-15-15c-8.285,0-15,6.716-15,15v16.82l-69.854-69.854l69.854-69.854v16.82 C212.133,76.317,218.848,83.033,227.133,83.033z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="flex gap-4 justify-center my-3">
                                <a
                                    :href="
                                        '/scale-prediction-result/' +
                                        scale_prediction_id +
                                        '/download'
                                    "
                                    class="block h-10 flex items-center gap-2 rounded-lg px-3 py-3 text-sm font-medium text-white hover:text-white focus:outline-none focus:ring active:text-opacity-75 bg-linear"
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
                        </div>
                    </div>
                </div>

                <div v-if="scale_prediction_loading">
                    <div class="flex p-4 xl:flex-row md:max-w-[100%] justify-center text-white">
                        <!-- <button disabled type="button"
                            class="text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 inline-flex items-center bg-linear">
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor" />
                            </svg>
                            Loading...
                        </button> -->
                        <img v-bind:src="'/image/opener_loading.gif'" class="h-36 w-36" alt="Loading..." />
                    </div>
                </div>

                <!-- The Modal -->
                <PreviewModal v-if="showModal" @close="showModal = false" :image-url="scale_prediction_output" :show_buttons=false>
                </PreviewModal>

            </div>
            <div class="col-md-3 col-sm-12 h-100 p-4 bg-[#111518]">
                <div class="col-sm-6 form-inline">
                    <div class="form-group">
                        <select v-model="selectedOption"  @change="redirectToPage" class="form-control tools-dropdown text-white border-white focus:border-white">
                            <option value="">Tools</option>
                            <option value="variant-maker">Variant Maker</option>
                            <option value="upscaler">Upscaler</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
