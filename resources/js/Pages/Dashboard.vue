<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import TripsTabs from "@/Components/TripsTabs.vue";
import {ref} from "vue";
import CreateTripModal from "@/Components/CreateTripModal.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Tasks from "@/Components/Tasks.vue";

const props = defineProps({
    'tasks': Array,
    'trips': Array,
    'drivers': Array,
    'trucks': Array
})

const createTripModal = ref(false);

const showCreateTripModal = () => {
    createTripModal.value = true
};

const closeModal = () => {
    createTripModal.value = false
};

</script>

<template>
    <Head title="Dashboard"/>
    <AuthenticatedLayout>
        <div class="m-2">
            <div class="w-full flex justify-end items-start pr-10">
                <PrimaryButton @click="showCreateTripModal">New Trip</PrimaryButton>
            </div>
            <div class="flex m-3 bg-white rounded-md min-h-screen shadow">
                <div
                    class="w-1/3 border-r border-gray-200 px-2 py-3">
                    <Tasks :tasks="tasks"/>
                </div>
                <div class="flex-1 w-2/3 pt-4">
                    <TripsTabs :tabs="trips"/>
                </div>
            </div>
        </div>

        <Modal :show="createTripModal" @close="closeModal">
            <CreateTripModal
                v-if="createTripModal"
                :drivers="drivers"
                :trucks="trucks"
                @close="closeModal"
            />
        </Modal>

    </AuthenticatedLayout>
</template>
