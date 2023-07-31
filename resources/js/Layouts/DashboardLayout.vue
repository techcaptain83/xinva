<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { initFlowbite } from "flowbite";

onMounted(() => {
    initFlowbite();
});

const showingNavigationDropdown = ref(false);
const getCreditStats = () => {
    axios.get('/credit-usage').then((response) => {
        console.log(response);
        if (response.data.success) {
            credit_usage.value = response.data.output;
        }
    });
}

const credit_usage = ref("");
setInterval(
    getCreditStats(),10000
);
onMounted(() => {
    setTimeout(appendMainJS, 400);

    function appendMainJS() {
        let mainJS = document.getElementById("main-js");
        if (mainJS != null) {
            mainJS.remove();
        }

        let mainScript = document.createElement("script");
        mainScript.setAttribute("src", "/js/main.js?v=1.0.0");
        mainScript.setAttribute("id", "main-js");
        document.body.appendChild(mainScript);
    }
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-[#111518]">

            <aside
                id="logo-sidebar"
                class="fixed top-0 left-0 z-40 w-64 shadow-sm h-screen -translate-x-full  lg:transition-transform lg:translate-x-0"
                aria-label="sidebar"
            >
                <div class="h-full px-3 py-4 overflow-y-visible overflow-y-auto lg:overflow-y-hidden  bg-[#111518]">
                    <div
                        class="text-black font-bold text-2xl text-center flex justify-center"
                    >
                        <Link href="/login">
                            <img
                                src="/image/logo/Xinva.png"
                                alt=""
                                width="150"
                                height="120"
                                class=""
                            />
                        </Link>
                    </div>

                    <div>
                        <ul class="space-y-6 mt-40 font-medium grid">
                            <li
                                :class="[
                                    route().current('dashboard')
                                        ? 'rounded-lg text-white bg-linear'
                                        : null,
                                ]"
                            >
                                <Link
                                    :href="route('dashboard')"
                                    class="flex items-center p-2 rounded-lg"
                                    data-drawer-hide="logo-sidebar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-white"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                        />
                                    </svg>
                                    <span
                                        class="flex-1 ml-3 whitespace-nowrap text-white"
                                        >Home</span
                                    >
                                </Link>
                            </li>
                            <!-- <li
                                :class="[
                                    route().current('prompt-generator.index')
                                        ? 'rounded-lg text-white bg-linear'
                                        : null,
                                ]"
                            >
                                <Link
                                    :href="route('prompt-generator.index')"
                                    class="flex items-center p-2 rounded-lg"
                                    data-drawer-hide="logo-sidebar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-white"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                        />
                                    </svg>
                                    <span
                                        class="flex-1 ml-3 whitespace-nowrap text-white"
                                        >Prompt Generator</span
                                    >
                                </Link>
                            </li> -->
                            <li
                                :class="[
                                    route().current('profile.edit')
                                        ? 'rounded-lg text-white bg-linear '
                                        : null,
                                ]"
                            >
                                <Link
                                    href="/profile"
                                    class="flex items-center p-2 rounded-lg"
                                    data-drawer-hide="logo-sidebar"
                                >
                                    <svg fill="#fff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.973 45.973" xml:space="preserve" class="h-6 w-6"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M43.454,18.443h-2.437c-0.453-1.766-1.16-3.42-2.082-4.933l1.752-1.756c0.473-0.473,0.733-1.104,0.733-1.774 c0-0.669-0.262-1.301-0.733-1.773l-2.92-2.917c-0.947-0.948-2.602-0.947-3.545-0.001l-1.826,1.815 C30.9,6.232,29.296,5.56,27.529,5.128V2.52c0-1.383-1.105-2.52-2.488-2.52h-4.128c-1.383,0-2.471,1.137-2.471,2.52v2.607 c-1.766,0.431-3.38,1.104-4.878,1.977l-1.825-1.815c-0.946-0.948-2.602-0.947-3.551-0.001L5.27,8.205 C4.802,8.672,4.535,9.318,4.535,9.978c0,0.669,0.259,1.299,0.733,1.772l1.752,1.76c-0.921,1.513-1.629,3.167-2.081,4.933H2.501 C1.117,18.443,0,19.555,0,20.935v4.125c0,1.384,1.117,2.471,2.501,2.471h2.438c0.452,1.766,1.159,3.43,2.079,4.943l-1.752,1.763 c-0.474,0.473-0.734,1.106-0.734,1.776s0.261,1.303,0.734,1.776l2.92,2.919c0.474,0.473,1.103,0.733,1.772,0.733 s1.299-0.261,1.773-0.733l1.833-1.816c1.498,0.873,3.112,1.545,4.878,1.978v2.604c0,1.383,1.088,2.498,2.471,2.498h4.128 c1.383,0,2.488-1.115,2.488-2.498v-2.605c1.767-0.432,3.371-1.104,4.869-1.977l1.817,1.812c0.474,0.475,1.104,0.735,1.775,0.735 c0.67,0,1.301-0.261,1.774-0.733l2.92-2.917c0.473-0.472,0.732-1.103,0.734-1.772c0-0.67-0.262-1.299-0.734-1.773l-1.75-1.77 c0.92-1.514,1.627-3.179,2.08-4.943h2.438c1.383,0,2.52-1.087,2.52-2.471v-4.125C45.973,19.555,44.837,18.443,43.454,18.443z M22.976,30.85c-4.378,0-7.928-3.517-7.928-7.852c0-4.338,3.55-7.85,7.928-7.85c4.379,0,7.931,3.512,7.931,7.85 C30.906,27.334,27.355,30.85,22.976,30.85z"></path> </g> </g> </g></svg>
                                    <span
                                        class="flex-1 ml-3 text-white whitespace-nowrap"
                                        >Settings</span
                                    >
                                </Link>
                            </li>
                            <li
                                :class="[
                                    route().current('history')
                                        ? 'rounded-lg text-white bg-linear'
                                        : null,
                                ]"
                            >
                                <Link
                                    :href="route('history')"
                                    class="flex items-center p-2 rounded-lg dark:text-white"
                                    data-drawer-hide="logo-sidebar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-white"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                        />
                                    </svg>

                                    <span
                                        class="flex-1 text-white ml-3 whitespace-nowrap"
                                        >History</span
                                    >
                                </Link>
                            </li>
                            <li
                                :class="[
                                    route().current('how_it_works')
                                        ? 'rounded-lg text-white bg-linear hover:text-white'
                                        : null,
                                ]"
                            >
                                <Link
                                    :href="route('how_it_works')"
                                    class="flex items-center p-2"
                                    data-drawer-hide="logo-sidebar"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-white"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"
                                        />
                                    </svg>

                                    <span
                                        class="flex-1 text-white ml-3 whitespace-nowrap"
                                        >How its works</span
                                    >
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-indigo-900 mt-10 rounded-lg">
                        <div class="flex flex-col gap-2 items-center justify-center px-2 py-4">
                            <h1 class="flex items-center justify-center text-white">
                                    Credit Usage
                            </h1>
                            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="text-xs font-medium text-blue-100 text-center leading-none rounded-full bg-linear" :style="'width: '+ credit_usage +'%'" v-html="credit_usage == 'Unlimited' ? credit_usage : credit_usage + '%'"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-indigo-900 mt-5 rounded-lg h-40">
                        <div>
                            <h1
                                class="flex items-center justify-center pt-10 text-white"
                            >
                                Need help with their name?
                            </h1>
                            <a href="https://xinva.ai/contact"
                                class="w-40 justify-center h-10 flex ml-6 mt-10 items-center gap-2 rounded-lg border border-indigo-600 bg-white px-1 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-indigo-600 focus:outline-none focus:ring active:text-opacity-75"

                            >
                                Go to support
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="min-h-screen lg:ml-64">
                <nav class="bg-[#111518] fixed flex focus:ring-offset-1 items-center justify-content-end p-6 px-4 py-3.5 relative shadow-pink-950 shadow-sm w-full">
                    <button
                        data-drawer-target="logo-sidebar"
                        data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 mt-2 ml-3 text-md text-gray-500 rounded-lg lg:hidden"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <svg
                            class="w-6 h-6 text-white"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                            ></path>
                        </svg>
                    </button>
                    <div v-if="$page.props.adSenseScript" class="ml-3 relative ml-auto text-white ad-banner">
                        Upgrade to Remove Ads
                    </div>
                    <div
                        class="focus:ring-offset-1 py-3.5 px-4 flex items-center ml-auto justify-end"
                    >
                        <div class="ml-3 relative">
                            <Link :href="route('paddle.pricing-credit')" id="image" name="image"
                                class="block h-8 px-4 flex items-center gap-2 text-sm font-medium text-white focus:outline-none focus:ring active:text-opacity-75 cursor-pointer bg-linear">
                            Get Credits
                            </Link>
                        </div>
                    </div>
                    <div
                        class="focus:ring-offset-1 py-3.5 px-4 flex items-center justify-end"
                    >
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-white leading-4 font-medium rounded-md text-gray-500 bg-[#111518] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink> -->
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink :href="route('paddle.pricing-credit')">
                                        Pricing
                                    </DropdownLink>
                                    <!-- <a href='/subscribe'>About</a> -->
                                    <!-- <DropdownLink :href="route('subscribe')"> Subscribe </DropdownLink> -->
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </nav>



            <!-- Page Content -->
                <main>
                        <slot />
                </main>
            </div>
        </div>
    </div>
</template>
