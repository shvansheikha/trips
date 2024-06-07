<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

const props = defineProps({
    'tasks': Array
})
</script>

<template>
    <Head title="Dashboard"/>
    <AuthenticatedLayout>
        <div class="flex m-10 bg-white rounded-md min-h-screen shadow">
            <div
                class="w-1/3 border-r border-gray-200 px-2">
                <div v-for="(task , index) in tasks"
                     class="my-1 cursor-pointer w-full hover:bg-gray-50">
                    {{ index }} - {{ task.title }}
                </div>
            </div>
            <div class="flex-1">
                trips
            </div>
        </div>
    </AuthenticatedLayout>
</template>
