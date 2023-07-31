<script setup>
import { ref } from 'vue';
import { onMounted } from 'vue';

const props = defineProps({
  isSnackbarVisible: Boolean,
  status: String,
});

let isSnackbarVisible = ref(false);

onMounted(() => {
  isSnackbarVisible = props.isSnackbarVisible
});

</script>

<template>


  <!-- SnackBar -->
  <VSnackbar v-model="isSnackbarVisible" location="top end" :color="status" variant="flat" transition="scale-transition" >
     <slot />
  </VSnackbar>
</template>
