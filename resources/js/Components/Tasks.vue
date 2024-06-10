<script setup>
const props = defineProps({
    'tasks': Array
})
</script>

<template>
    <div class="mx-2">
        <h1 class="uppercase text-xl cursor-pointer font-bold mb-4">tasks</h1>
        <div v-for="(task , index) in tasks"
             class="py-1 px-2 text-md cursor-pointer w-full hover:bg-gray-100 rounded-md">
            {{ index + 1 }} - {{ task.title }}
            <span class="text-xs text-blue-600" v-if="task.trip">({{ task.trip.title }})</span>
        </div>
    </div>
</template>
