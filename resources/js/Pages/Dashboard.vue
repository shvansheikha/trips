<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import TripsTabs from "@/Components/TripsTabs.vue";

const props = defineProps({
    'tasks': Array,
    'trips': Array,
})

</script>

<template>
    <Head title="Dashboard"/>
    <AuthenticatedLayout>
        <div class="m-10">
            <div class="w-full flex justify-end items-start pr-10">
                <Link :href="route('trips.form')"
                      class="border rounded-md px-3 py-1 hover:bg-white hover:text-blue-400">
                    New Trip
                </Link>
            </div>
            <div class="flex m-3 bg-white rounded-md min-h-screen shadow">
                <div
                    class="w-1/3 border-r border-gray-200 px-2 py-3">
                    <div v-for="(task , index) in tasks"
                         class="py-1 px-2 text-sm cursor-pointer w-full hover:bg-gray-100 rounded-md">
                        {{ index + 1 }} - {{ task.title }}
                        <span class="text-xs text-green-400" v-if="task.trip">({{task.trip.title}})</span>
                    </div>
                </div>
                <div class="flex-1 w-2/3 pt-4">
                    <TripsTabs :tabs="trips"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
