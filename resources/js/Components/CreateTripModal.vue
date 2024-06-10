<script setup>
import {ref, watch} from 'vue';
import {useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dropdown from "primevue/dropdown";
import TextArea from "primevue/textarea";

const props = defineProps({
    drivers: Array,
    trucks: Array
});

const emit = defineEmits(['close']);

const form = useForm({
    title: '',
    body: '',
    driver: null,
    truck: null
});

const closeModal = () => {
    emit('close');
};

const selectedDriver = ref(null);
const selectedTruck = ref(null);
const errors = ref({});

watch(selectedDriver, async (newDriver) => {
    form.driver = newDriver.id;
});

watch(selectedTruck, async (newTruck) => {
    form.truck = newTruck.id;
});

function submit() {
    errors.value = {};
    form.post(route('trips.store'), {
        preserveScroll: true,
        onError: (errorMsg) => errors.value = errorMsg,
        onSuccess: () => {
            closeModal();
            errors.value = {};
        }
    });
}
</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create New Trip
        </h2>

        <div class="mt-2">
            <form @submit.prevent="submit" class="bg-white py-5">

                <div class="mb-4">
                    <label for="trip-title" class="text-gray-700">Trip title:</label>
                    <TextInput
                        id="trip-title"
                        type="text"
                        class="mt-1 block w-full outline-none focus:ring-0 rounded-md"
                        v-model="form.title"
                    />
                    <div v-if="errors.title" class="text-red-500">{{ errors.title }}</div>
                </div>

                <div class="mb-4">
                    <label for="trip-body" class="text-gray-700">Trip detail:</label>
                    <TextArea
                        id="trip-body"
                        class="mt-1 block w-full outline-none focus:ring-0 rounded-md"
                        autoResize
                        v-model="form.body"
                        rows="5"
                        cols="30"
                    />
                </div>

                <div class="mb-4">
                    <Dropdown
                        id="drivers"
                        :options="drivers"
                        optionLabel="name"
                        placeholder="Select a Driver"
                        checkmark
                        :highlightOnSelect="false"
                        v-model="selectedDriver"
                        class="w-full md:w-14rem"
                    />
                    <div v-if="errors.driver" class="text-red-500">{{ errors.driver }}</div>
                </div>

                <div class="mb-4">
                    <Dropdown
                        id="trucks"
                        :options="trucks"
                        optionLabel="title"
                        placeholder="Select a Truck"
                        checkmark
                        :highlightOnSelect="false"
                        v-model="selectedTruck"
                        class="w-full md:w-14rem"
                    />
                    <div v-if="errors.truck" class="text-red-500">{{ errors.truck }}</div>
                </div>

                <div class="mt-6 flex">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                    <PrimaryButton type="submit" class="bg-blue-500 text-white mx-4 px-4 py-2 rounded">
                        Create Trip
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
