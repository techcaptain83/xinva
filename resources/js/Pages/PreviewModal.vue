<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

</script >

    <script>
        export default {
            props: {
            imageUrl: String,
        prediction_result_id: Number,
        show_buttons : {
            type: Boolean,
            default: true
        },
        download_button : {
            type: Boolean,
            default: false
        },
        download_url: String
    },
        data() {
        return {
            showModal: false,
            // show_buttons: true
        };
    },
        methods: {

        }
};
</script>
<template>
    <div class="modal in modal-active" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content bg-[#111518]">
                <div class="justify-content-end modal-header p-1">
                    <button type="button" class="text-4xl" @click="$emit('close')"><span>&times;</span></button>
                    <h4 class="modal-title">
                        {{ name }}
                    </h4>
                </div>
                <div class="modal-body flex justify-content-center p-0">
                    <img :src="imageUrl" class="h-w-512" alt="Image" />
                </div>
                <div v-if=(show_buttons) class="modal-footer justify-content-center pb-0">
                    <Link :href="
                        '/prediction-results/' + prediction_result_id + '/scaling_image'
                    " class="btn btn-primary gap-2 bg-[#111518] shadow-none h-10">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    </Link>
                    <button type="button"
                        class="block h-10 flex items-center gap-2 rounded-lg px-3 py-3 text-sm font-medium text-white focus:outline-none focus:ring active:text-opacity-75 bg-linear">Edit</button>
                    <Link :href="'/prediction-results/' + prediction_result_id + '/remove-bg'" id="image" name="image"
                        class="block h-10 flex items-center gap-2 rounded-lg px-3 py-3 text-sm font-medium text-white focus:outline-none focus:ring active:text-opacity-75 cursor-pointer bg-linear">
                    Remove BG
                    </Link>
                    <Link :href="'/variant-maker/store/' + prediction_result_id" id="image" name="image"
                        class="block h-10 flex items-center gap-2 rounded-lg px-3 py-3 text-sm font-medium text-white focus:outline-none focus:ring active:text-opacity-75 cursor-pointer bg-linear">
                    Variants
                    </Link>
                </div>
                <div v-if=(download_button) class="modal-footer justify-content-center pb-0">
                    <a
                        :href="download_url"
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

            </div>
        </div>
    </div>
</template>
