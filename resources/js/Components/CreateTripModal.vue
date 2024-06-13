<script setup>
import {ref, watch} from 'vue';
import {useForm} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from 'primevue/textarea';
import InputText from 'primevue/inputtext';
import Select from 'primevue/select';
import Button from 'primevue/button';

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
    <div class="p-6 text-sm">
        <h2 class="text-lg font-medium text-gray-900">
            Create New Trip
        </h2>

        <div class="mt-2">
            <form @submit.prevent="submit" class="bg-white py-5">

                <div class="mb-4">
                    <label for="trip-title" class="text-gray-700">Trip title:</label>
                    <InputText
                        id="trip-title"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.title"
                        size="small"
                    />

                    <div v-if="errors.title" class="text-red-500">{{ errors.title }}</div>
                </div>

                <div class="mb-4">
                    <label for="trip-body" class="text-gray-700">Trip detail:</label>
                    <Textarea
                        id="trip-body"
                        class="mt-1 block w-full"
                        autoResize
                        v-model="form.body"
                        rows="5"
                        cols="30"
                    />
                </div>

                <div class="mb-4">
                    <Select
                        id="drivers"
                        :options="drivers"
                        optionLabel="name"
                        placeholder="Select a Driver"
                        :highlightOnSelect="true"
                        v-model="selectedDriver"
                        class="w-full"
                        :virtualScrollerOptions="{itemSize: 28 }"
                    />

                    <div v-if="errors.driver" class="text-red-500">{{ errors.driver }}</div>
                </div>

                <div class="mb-4">
                    <Select
                        id="trucks"
                        class="w-full"
                        :options="trucks"
                        optionLabel="title"
                        placeholder="Select a Truck"
                        :highlightOnSelect="true"
                        v-model="selectedTruck"
                        :virtualScrollerOptions="{itemSize: 28 }"
                    />
                    <div v-if="errors.truck" class="text-red-500">{{ errors.truck }}</div>
                </div>

                <div class="mt-6 flex">
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

                    <Button type="submit" label="Create Trip" class="mx-4"/>
                </div>
            </form>
        </div>
    </div>
</template>
