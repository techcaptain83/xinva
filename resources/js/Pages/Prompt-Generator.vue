<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import Replicate from "replicate";
import axios from "axios";
import SnackBar from "@/Components/SnackBar.vue";
import { initFlowbite } from "flowbite";


const props = defineProps({
    detail: Object,
    title: String,
    status: String,
});

const form = useForm({
    prompt: "",
    image: "",
});

const empty_prompt = ref(false);
const api_error = ref(false);
const api_error_msg = ref("");
const prediction_id = ref("");
const prediction_loading = ref("");
const prediction_check_interval = ref(null);
const prediction_output = ref("");

const loadPrediction = () => {
    axios
        .get(route("prompt-generator.prediction", prediction_id.value,))
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
            .post(route("prompt-generator.store"), {
                prompt: form.prompt,
            })
            .then((response) => {
                if (response.data.success) {
                    prediction_id.value = response.data.prediction_id;
                    prediction_check_interval.value = setInterval(
                        loadPrediction,
                        7000
                    );
                    prediction_loading.value = true
                } else {
                    api_error.value = true
                    api_error_msg.value = response.data.error
                    prediction_loading.value = false
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

    form.csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});
</script>

<template>
    <Head title="Prompt Generator" />

    <DashboardLayout>
        <SnackBar v-if="empty_prompt" :isSnackbarVisible="true" status="danger">
            Prompt is empty!
        </SnackBar>

        <SnackBar
            v-if="api_error"
            :isSnackbarVisible="true"
            status="danger"
        >
            {{ api_error_msg }}
        </SnackBar>
        <div class="col-md-9 col-sm-12 h-100">
            <div
                class="flex flex-col justify-center md:max-w-[100%] p-4 text-white xl:flex-row"
            >
                <div class="align-items-center border-1 col-12 flex h-14 justify-around md:mx-auto position-relative rounded-md">
                    <div class="col-12 flex h-full items-center position-absolute">
                        <input
                            id="prompt"
                            name="prompt"
                            required="required"
                            v-model="form.prompt"
                            class="inputwidth p-2 h-14 shadow-md placeholder-slate-400 focus:outline-none block rounded-md sm:text-xs"
                            placeholder="Describe what you want and seperate them with commas add colors of your choice and text"
                        />
                    </div>
                    <div class="col-3 flex justify-content-center justify-end mr-4 offset-9 position-absolute">
                        <button v-if="!prediction_loading"
                            type="submit"
                            @click.prevent="submit($event)"
                            class="button flex items-center rounded transition bg-[#1559ed] ease-in-out delay-150 bg-indigo-600 hover:-translate-y-1 hover:bg-indigo-700 duration-800 h-9 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg bg-linear"
                            >
                                <span class="button__text flex"
                                    >Generate
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"
                                        />
                                    </svg>
                                </span>
                        </button>
                    </div>
                </div>
            </div>


            <div
                v-if="!prediction_loading && prediction_output != ''"
                class="flex p-4 flex-col xl:flex-row md:max-w-[100%] justify-center text-white"
                rel=""
            >
                <div
                    class="flex flex-wrap justify-center" v-html="prediction_output"
                >
                </div>
            </div>

            <div v-if="prediction_loading">
                <div
                    class="flex p-4 xl:flex-row md:max-w-[100%] justify-center text-white"
                >
                    <!-- <button
                        disabled
                        type="button"
                        class="text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 inline-flex items-center bg-linear"
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
    </DashboardLayout>
</template>
