<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },

    hasGoogleProfile: Boolean,
    user: Object,
    hasFacebookProfile: Boolean,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    gender: user.gender,
});
</script>

<template>
    <section class="m-auto">
        <header>
            <h1 class="text-lg font-medium text-white">Profile Information</h1>

            <!-- <p class="mt-1 text-sm text-white">
                Update your account's profile information and email address.
            </p> -->
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="name" value="Name" class="text-white" />

                <TextInput
                    type="text"
                    class="mt-1 border border-indigo-700 shadow p-3 w-full rounded"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" class="text-white" />

                <TextInput
                    type="email"
                    class="mt-1 border border-indigo-700 shadow p-3 w-full rounded"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div>
                <p class="text-base text-white mt-4 font-bold">Platform</p>
                <div class="flex items-center">
                    <button
                        aria-label="Continue with google"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-2 rounded-md bg-gray-200 border border-gray-400 p-6 dark:bg-neutral-700 flex items-center h-12 justify-center w-40 mt-4"
                    >
                        <img src="image/icon/google icon.png" alt="google" />
                        <p class="text-base font-medium ml-4 text-gray-700">
                            Google
                        </p>
                    </button>
                    <div class="block ml-auto">
                        <label class="switch-1">
                            <input
                                type="checkbox"
                                :checked="props.hasGoogleProfile" disabled
                            />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex items-center">
                    <button
                        aria-label="Continue with google"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-2 rounded-md bg-gray-200 border border-gray-400 p-6 dark:bg-neutral-700 flex items-center h-12 justify-center w-40 mt-4"
                    >
                        <img src="image/icon/Facebook icon.png" alt="google" />
                        <p class="text-base font-medium ml-6 text-gray-700">
                            Facebook
                        </p>
                    </button>
                    <div class="block ml-auto">
                        <label class="switch-1">
                            <input
                                type="checkbox"
                                :checked="props.hasFacebookProfile" disabled
                            />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-base text-white mt-4 font-bold">Gender</p>

                <div class="flex flex-wrap mt-4"  
                >
                    <div class="flex items-center mr-4">
                        <input
                            id="red-radio"
                            type="radio"
                            v-model="form.gender"
                            value="male" for="male"
                            name="colored-radio"
                            class="w-4 h-4 text-[#170F49] bg-gray-100 border-gray-300 focus:ring-[#170F49] dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label
                            for="red-radio"
                            class="ml-2 text-sm font-medium text-white"
                            >Male</label
                        >
                    </div>
                    <div class="flex items-center mr-4">
                        <input
                            id="green-radio"
                            type="radio"
                            v-model="form.gender"
                            value="female" for="female"
                            name="colored-radio"  
                            class="w-4 h-4 text-[#170F49] bg-gray-100 border-gray-300 focus:ring-[#170F49] dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label
                            for="green-radio"
                            class="ml-2 text-white font-medium dark:text-gray-300" 
                            >Female</label
                        >
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton
                    class="h-8 w-28 text-white rounded-sm mt-4 flex items-center p-3 bg-[#1559ed]"
                    :disabled="form.processing"
                >
                    Save
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 ml-4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.5 12.75l6 6 9-13.5"
                        />
                    </svg>
                </PrimaryButton>

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-white mt-2"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
