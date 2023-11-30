<script setup lang="ts">
import { VueFinalModal } from 'vue-final-modal'
defineProps<{
    title?: string
}>()
const emit = defineEmits<{
    (e: 'confirm'): void
}>()
</script>
<template>
    <VueFinalModal class="flex justify-center items-center"
        content-class="flex flex-col max-w-xl mx-4 p-4 bg-white dark:bg-gray-900 border dark:border-gray-700 rounded-lg space-y-2">
        <h1 class="text-xl">
            {{ title }} 
        </h1>
        <slot />

        <button  @click="emit('confirm')"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ok 👍</button>

    </VueFinalModal>
</template>