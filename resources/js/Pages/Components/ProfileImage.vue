<script setup>
const props = defineProps({
    avatar: String
});
</script>
<template>
<form action="/profile/image" method="POST" enctype="multipart/form-data">
    <div class="flex items-center p-6 justify-around md:justify-start">
        
        <img
            :src="props.avatar != '' ? '/avatars/'+props.avatar : '/image/Testimonal/Testimonal-1.png'"
            alt=""
            id="output"
            class="rounded-full w-28 h-28 shadow-sm shadow-white-900"
        />
        <div class="relative">
            <i
                class="fa-solid fa-cloud-arrow-down download_icon"
                style="color: #ffffff"
            ></i>
            <input
                id="file"
                type="file"
                name="avatar"
                onchange="this.form.submit()"
                class="custom-file-input bg-[#1559ed] ml-4 h-12 w-44 rounded-lg mt-2 px-6 pb-2 pt-1.5 text-xs font-medium leading-normal text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
            />
        </div>
    </div>
</form>
</template>