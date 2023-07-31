<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />
    <section>
        <div
            class="h-full bg-gradient-to-tl from-indigo-100 to-indigo-100 w-full py-16 px-4"
        >
            <div
                class="g-6 container flex min-h-screen flex-wrap items-center justify-center lg:justify-evenly"
            >
                <div
                    class="bg-white shadow rounded md:w-6/12 lg:ml-6 lg:w-5/12 p-10 mt-16 drop-shadow-lg"
                >
                    <p
                        tabindex="0"
                        class="focus:outline-none text-2xl text-center font-bold leading-6 text-gray-800"
                    >
                        Create Your Account
                    </p>
                    <button
                        aria-label="Continue with google"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-4 rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700 flex items-center justify-center w-full mt-10"
                    >
                    <a :href="route('login.google')">
                        <img src="image/icon/google icon.png" alt="google" />
                        <p class="text-base font-medium ml-4 text-gray-700">
                            Continue with Google
                        </p>
                        </a>
                    </button>
                    <button
                        aria-label="Continue with twitter"
                        role="button"
                        class="focus:ring-offset-1 py-3.5 px-4 rounded-lg bg-white p-6 shadow-lg dark:bg-neutral-700 flex items-center justify-center w-full mt-4"
                    >
                    <a :href="route('login.google')">
                        <img src="image/icon/Facebook icon.png" alt="twitter" />
                        <p class="text-base font-medium ml-4 text-gray-700">
                            Continue with Facebook
                        </p>
                        </a>
                    </button>
                    <div class="w-full flex items-center justify-center py-5">
                        <p
                            class="text-base font-bold leading-4 px-2.5 text-gray-900"
                        >
                            OR
                        </p>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <TextInput
                                id="name"
                                type="text"
                                class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                                v-model="form.name"
                                required
                                placeholder="name"
                                autofocus
                                autocomplete="name"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div>
                            <TextInput
                                id="email"
                                aria-labelledby="email"
                                type="email"
                                v-model="form.email"
                                placeholder="email address"
                                class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-4"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="mt-6 w-full">
                            <div
                                class="relative flex items-center justify-center"
                            >
                                <TextInput
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    placeholder="password"
                                    autocomplete="new-password"
                                    class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>
                        </div>
                        <div class="mt-6 w-full">
                            <div
                                class="relative flex items-center justify-center"
                            >
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    placeholder="confirm password"
                                    v-model="form.password_confirmation"
                                    autocomplete="new-password"
                                    class="bg-white-200 border rounded text-xs font-medium leading-none text-gray-800 py-3 w-full pl-3 mt-2"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>
                        </div>
                        <div class="mt-8">
                            <button
                                role="button"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                class="focus:ring-2 h-14 focus:ring-offset-2 focus:ring-indigo-700 text-sm font-semibold leading-none text-white focus:outline-none bg-indigo-700 border rounded hover:bg-indigo-600 py-4 w-full"
                            >
                                Sign Up
                            </button>
                        </div>
                        <div class="text-center lg:text-left">
                            <Link
                                :href="route('login')"
                                class="mt-2 mb-0 pt-1 text-sm font-semibold"
                            >
                                Already have an account?
                                <a
                                    href="/try"
                                    class="text-indigo-600 transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                                    >Login</a
                                >
                            </Link>
                        </div>
                    </form>
                </div>
                <div class="mb-12 md:mb-0 md:w-8/12 lg:w-6/12">
                    <img
                        src="image/loginpage/signup-image.png"
                        class="w-[650px] mt-14"
                        alt="Phone image"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
