<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 bg-gradient-to-r from-indigo-500"
    >
        {{ status }}
    </div>
    <section>
        <div
            class="min-h-full md:min-h-screen bg-gradient-to-tl from-indigo-100 to-indigo-100 w-full py-12 px-1 md:px-4"
        >
            <div
                class="g-6 container md:max-w-[70%] mx-auto flex flex-wrap items-center justify-center lg:justify-evenly"
            >
                <div
                    class="bg-white shadow rounded md:w-6/12 lg:ml-6 lg:w-5/12 p-8 mt-16 drop-shadow-lg"
                >
                    <p
                        tabindex="0"
                        class="focus:outline-none text-2xl text-center font-bold leading-6 text-gray-800"
                    >
                        Welcome Back
                    </p>
                    <!-- <div class="flex items-center justify-end mt-4">
                        <a :href="route('auth.google')">
                            <img
                                src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                                style="
                                    margin-left: 3em;
                                    height: 40px;
                                    border-radius: 12px;
                                "
                            />
                        </a>

                    </div> -->
                    <a
                        :href="route('auth.google')"
                        aria-label="Continue with google"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-4 rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700 flex items-center justify-center w-full mt-10"
                    >
                        <img src="image/icon/google icon.png" alt="google" />
                        <p class="text-base font-medium ml-4 text-gray-700">
                            Continue with Google
                        </p>
                    </a>

                    <a
                        :href="route('auth.facebook')"
                        aria-label="Continue with twitter"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-4 rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700 flex items-center justify-center w-full mt-4"
                    >
                        <img src="image/icon/Facebook icon.png" alt="twitter" />
                        <p class="text-base font-medium ml-4 text-gray-700">
                            Continue with Facebook
                        </p>
                    </a>
                    <div
                        class="w-full flex items-center justify-center py-3 md:my-5"
                    >
                        <p
                            class="text-base font-bold leading-4 px-2.5 text-gray-900"
                        >
                            OR
                        </p>
                    </div>
                    <form @submit.prevent="submit">
                        <div>
                            <TextInput
                                id="email"
                                aria-labelledby="email"
                                type="email"
                                v-model="form.email"
                                placeholder="email address"
                                class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="mt-6 w-full">
                            <div class="relative">
                                <TextInput
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    placeholder="password"
                                    class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-black flex justify-end text-sm pt-2 transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                                >Forgot password?</Link
                            >
                        </div>

                        <div class="mt-8">
                            <button
                                role="button"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                class="focus:ring-2 h-14 focus:ring-offset-2 focus:ring-indigo-700 text-sm font-semibold leading-none text-white focus:outline-none bg-indigo-700 border rounded hover:bg-indigo-600 py-4 w-full"
                            >
                                Login
                            </button>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="mt-2 mb-0 pt-1 text-sm font-semibold">
                                Don't have an account?
                                <Link
                                    :href="route('register')"
                                    class="text-indigo-600 transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                                    >Register</Link
                                >
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
