<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import PreviewModal from "@/Pages/PreviewModal.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, defineProps } from "vue";
import Replicate from "replicate";
import axios from "axios";
import SnackBar from "@/Components/SnackBar.vue";
import { initFlowbite } from "flowbite";


const props = defineProps({
    detail: Object,
    title: String,
    status: String,
    form: Object,
    paymentSuccessEmail: String
});

const form = useForm({
    prompt: "",
    image: "",
});
const selectOption = (val) => {
    if(val === 'anime_dream style of') {
        anime_model.value = true;
    }
    else {
        anime_model.value = false;
    }
    form.prompt = val + ' ' + form.prompt;
};

const anime_model = ref(false);
const empty_prompt = ref(false);
const api_error = ref(false);
const api_error_msg = ref("");
const prediction_id = ref("");
const prediction_loading = ref("");
const prediction_check_interval = ref(null);
const prediction_output = ref("");
const button1 = ref('Realistic 3d render of a happy, furry, cute, round baby feather duster cat smiling with big eyes looking straight at you, Pixar style, 32k, full body shot with yellow background');
const button2 = ref('Cute wolf cub sticker, Vector color, and line art illustration, crisp and clean vector line, flat colors, smooth gradients, gradient contour outline, vivid colors, HDR, 16K, in the style of die-cut stickers ');
const button3 = ref('Vectorized design of a cartoon monkey driving a motorcycle in the summer, detailed, vintage, playful, vivid color, photoshoot, Unreal Engine 5, Cinematic, Color Grading, portrait Photography, Ultra-Wide Angle, Depth of Field, hyper-detailed, beautifully color-coded');

const loadPrediction = () => {
    axios
        .get(route("prediction-response", prediction_id.value,))
        .then((response) => {
            if (response.data.error == true) {
                clearInterval(prediction_check_interval.value);
                prediction_loading.value = false;
            }
            if (response.data.success && response.data.output != null) {
                clearInterval(prediction_check_interval.value);
                prediction_output.value = response.data.output;
                prediction_loading.value = false;
            }
        });
};

const submit = async (event) => {
    event.target.classList.toggle("button--loading");
    if (form.prompt == "") {
        empty_prompt.value = true;
        event.target.classList.toggle("button--loading");
        setTimeout(() => {
            empty_prompt.value = false;
        }, 2000);
    } else {
        await axios
            .post(route("predict"), {
                prompt: form.prompt,
                anime_model: anime_model.value
            })
            .then((response) => {
                if (response.data.success) {
                    prediction_id.value = response.data.prediction_id;
                    prediction_check_interval.value = setInterval(
                        loadPrediction,
                        3000
                    );
                    prediction_loading.value = true
                } else {
                    if(response.data.error == 'credit_out') {
                        window.location.href = 'paddle/pricing/credit-plans/true';
                    }else {
                        api_error.value = true
                        api_error_msg.value = response.data.error
                        prediction_loading.value = false
                    }
                }
            });
    }
};

// background start //
const background_id = ref("");
const background_loading = ref("");
const background_check_interval = ref(null);
const background_output = ref("");
const loadbackground = () => {
    const url = "/background/" + background_id.value;
    axios.get(url).then((response) => {
        console.log(response);
        if (response.data.completed_at !== null) {
            clearInterval(background_check_interval.value);
            background_output.value = response.data.output;
            background_loading.value = false;
        }
    });
};
const click = async () => {
    await axios
        .post(route("background"), {
            image: form.image,
        })
        .then((response) => {
            console.log(response);
            if (response.data.success) {
                background_id.value = response.data.background_id;
                background_check_interval.value = setInterval(
                    loadbackground,
                    3000
                );
                background_loading.value = true;
            }
        });
};
// background end //

onMounted(() => {
    initFlowbite();

    if (props.paymentSuccessEmail) {
        fpr("referral",{email: props.paymentSuccessEmail});
        console.log(props.paymentSuccessEmail);
    }

    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

const firstTabButtons = [
    { id: 1, label: 'T-Shirt', prompt: 'Make a vector design for print,' },
    { id: 2, label: 'Stickers', prompt: 'Make a sticker design,' },
    { id: 3, label: 'Art', prompt: 'Make an art,' },
    { id: 4, label: 'Pattern', prompt: 'Make a pattern design,' },
    { id: 5, label: 'Illustration', prompt: 'Illustration design,' },
    { id: 6, label: 'Vector', prompt: 'Make a vector design,' },
    { id: 7, label: 'Logo', prompt: 'Make a logo,' },
    { id: 8, label: 'Character', prompt: 'Make a character design,' },
    { id: 9, label: 'Pokemon', prompt: 'Make a Pokemon design,' },
];
const secondTabButtons = [
    { id: 1, label: 'Anime', prompt: 'anime_dream style of' },
    { id: 2, label: 'Realistic', prompt: 'Realistic and highly detailed image,' },
    { id: 3, label: 'Cartoon', prompt: 'Make a cartoon,' },
    { id: 4, label: 'Photography', prompt: 'Looking at the camera lens,' },
    { id: 5, label: '3D', prompt: '3D,' },
];

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
            showTool: false,
        };
    },
    methods: {
        tabClick(val) {
            this.activeTab = val;
        },
        redirectToPage(value) {
            // const selectedPage = event.target.value;
            const selectedPage = value;
            console.log(selectedPage);
            if (selectedPage) {
                window.location.href = 'custom/' + selectedPage;
            }
        },
        toogleTool(value) {
            console.log(value,'asdfsad');
            this.showTool = value;
        }
    }
};
</script>
<template>
    <Head title="Dashboard" />

    <DashboardLayout>
        <div class="flex vh-100 row">
            <SnackBar v-if="empty_prompt" :isSnackbarVisible="true" status="danger">
                Prompt is empty!
            </SnackBar>

            <SnackBar v-if="api_error" :isSnackbarVisible="true" status="danger">
                {{ api_error_msg }}
            </SnackBar>
            <div class="col-md-9 col-sm-12 h-100 image-content">
                <!-- <div v-html="$page.props.adSenseScript"></div> -->
                <div class="flex flex-col justify-center md:max-w-[100%] p-4 text-white xl:flex-row">
                    <div class="flex justify-around rounded-md align-items-center border-1 col-12 h-14 md:mx-auto position-relative">
                        <div class="flex items-center h-full col-12 position-absolute">
                            <input id="prompt" name="prompt" required="required" v-model="form.prompt"
                                class="block p-2 rounded-md shadow-md inputwidth h-14 placeholder-slate-400 focus:outline-none sm:text-xs w-75"
                                placeholder="Describe what you want and seperate them with commas add colors of your choice and text" />
                        </div>
                        <div class="flex justify-end mr-4 col-2 justify-content-center offset-10 position-absolute">
                            <button v-if="!prediction_loading" type="submit" @click.prevent="submit($event)"
                                class="button flex items-center rounded transition ease-in-out delay-150 hover:-translate-y-1 hover:bg-indigo-700 duration-800 h-9 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg bg-linear">
                                <span class="flex button__text">Generate
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
                <div class="flex flex-col gap-4 justify-center md:max-w-[100%] xl:flex-row align-center"
                    v-if="!prediction_loading && prediction_output == ''">
                    <div class="flex justify-center gap-6 item-center">
                        <div>
                            <p class="text-white">Need Inspiration?</p>
                        </div>
                        <div>
                            <p class="text-white">Try these</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 item-center">
                        <div>
                            <button @click="selectOption(button1);" id="button1"  class="p-2 pt-2 text-center text-black bg-gray-200 rounded-sm md:pt-3">
                                Furry Cat
                            </button>
                        </div>
                        <div>
                            <button @click="selectOption(button2);" id="button2" class="p-2 pt-2 text-center text-black bg-gray-200 rounded-sm md:pt-3">
                                Wolf Sticker
                            </button>
                        </div>
                        <div>
                            <button @click="selectOption(button3);" id="button3" class="p-2 pt-2 text-center text-black bg-gray-200 rounded-sm md:pt-3">
                                Monkey Riding
                            </button>
                        </div>
                    </div>
                </div>

                <div v-if="!prediction_loading && prediction_output != ''"
                    class="flex gap-10 p-4 img-list justify-content-center">
                    <div v-for="(img, key) in prediction_output" class="flex flex-wrap justify-center">
                        <div class="position-relative">
                            <svg @click="showModal = true; imageUrl = img; prediction_result_id = key" fill="#ffff" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="-24.21 -24.21 290.55 290.55" xml:space="preserve"
                                class="right-0 w-6 h-6 m-2 cursor-pointer position-absolute">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                    stroke="#CCCCCC" stroke-width="5.326926"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path id="XMLID_15_"
                                        d="M227.133,83.033c8.283,0,15-6.716,15-15V15c0-8.284-6.717-15-15-15H174.1c-8.284,0-15,6.716-15,15 s6.716,15,15,15h16.82l-69.854,69.854L51.213,30h16.82c8.284,0,15-6.716,15-15s-6.716-15-15-15H15C6.717,0,0,6.716,0,15v53.033 c0,8.284,6.717,15,15,15c8.285,0,15-6.716,15-15v-16.82l69.854,69.854L30,190.92V174.1c0-8.284-6.715-15-15-15 c-8.283,0-15,6.716-15,15v53.033c0,8.284,6.717,15,15,15h53.033c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-16.82 l69.854-69.854l69.854,69.854H174.1c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h53.033c8.283,0,15-6.716,15-15V174.1 c0-8.284-6.717-15-15-15c-8.285,0-15,6.716-15,15v16.82l-69.854-69.854l69.854-69.854v16.82 C212.133,76.317,218.848,83.033,227.133,83.033z">
                                    </path>
                                </g>
                            </svg>
                            <img v-bind:src="img" class="rounded-lg h-w-512 ">

                            <div class="flex justify-center gap-4 my-3">
                                <Link :href="
                                    '/prediction-results/' + key + '/scaling_image'
                                "
                                    class="flex items-center block h-10 gap-2 px-3 py-3 text-sm font-medium text-white rounded-lg hover:text-white focus:outline-none focus:ring active:text-opacity-75 bg-linear">
                                Download
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                </Link>

                                <!-- <Link
                                            :href="'/prediction-results/' + key + '/remove-bg'"
                                            id="image"
                                            name="image"
                                            class="block h-10 flex w-32 items-center gap-2 rounded-lg border border-blue-600 bg-[#5145CD] px-3 py-3 text-sm font-medium text-white hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:text-opacity-75"
                                        >
                                            Remove BG
                                        </Link> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="prediction_loading">
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
                <PreviewModal v-if="showModal" @close="showModal = false" :image-url="imageUrl" :prediction_result_id="prediction_result_id" :show_buttons=true>
                </PreviewModal>

            </div>
            <div class="col-md-3 col-sm-12 h-100 p-4 bg-[#111518]">
                <div class="col-md-9 col-sm-12 form-inline">
                    <div class="form-group">
                        <div class="w-full accordion">

                            <input @click="toogleTool(!showTool)" type="checkbox" name="panel" id="panel-1" class="hidden tool-option-input">
                            <label for="panel-1" class="relative block p-2 text-white cursor-pointer border-1 rounded-1 tool-option-label">Tool</label>
                            <div v-if="showTool">
                                <div @click="redirectToPage('variant-maker')" class="relative p-2 mt-2 text-white cursor-pointer border-1 rounded-1">
                                    Variant Maker
                                </div>
                                <div @click="redirectToPage('upscaler')" class="relative p-2 mt-2 text-white cursor-pointer border-1 rounded-1">
                                    Upscaler
                                </div>
                            </div>

                        </div>

                        <!-- <select @change="redirectToPage" class="text-white border-white form-control tools-dropdown focus:border-white">
                            <option value="">Tools</option>
                            <option value="variant-maker">Variant Maker</option>
                            <option value="upscaler">Upscaler</option>
                        </select> -->
                    </div>
                </div>
                <div class="py-4 text-gray-300 col-12">
                    <ul class="nav flex bg-[#252627]">
                        <li @click="tabClick('design-tab')"
                            :class="['col-6 flex justify-center py-3', { 'border-b-2 border-indigo-700': activeTab == 'design-tab' }]">
                            <a data-toggle="tab" href="javascript:void(0)">Design</a>
                        </li>
                        <li @click="tabClick('image-tab')"
                            :class="['col-6 flex justify-center py-3', { 'border-b-2 border-indigo-700': activeTab == 'image-tab' }]">
                            <a data-toggle="tab" href="javascript:void(0)">Image</a>
                        </li>
                    </ul>

                    <div class="border-0 bg-[#111518] py-2">
                        <div v-if="activeTab == 'design-tab'" id="tab-content-1" class="active">
                            <div class="button-group">
                                <button v-for="button in firstTabButtons" :key="button.id"
                                    :class="['m-1 p-2 bg-[#0058bfb3] hover:bg-[#0058BF] rounded-1', { 'bg-[#0058BF]': buttonPrompt==button.prompt }]"
                                    :data-value="button.label" @click="selectOption(button.prompt); buttonPrompt=button.prompt">
                                    {{ button.label }}
                                </button>
                            </div>
                        </div>
                        <div v-if="activeTab == 'image-tab'" id="tab-content-2" class="">
                            <div class="button-group">
                                <button v-for="button in secondTabButtons" :key="button.id"
                                    :class="['m-1 p-2 bg-[#0058bfb3] hover:bg-[#0058BF] rounded-1', { 'bg-[#0058BF]': buttonPrompt==button.prompt }]"
                                    @click="selectOption(button.prompt); buttonPrompt=button.prompt">
                                    {{ button.label }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
