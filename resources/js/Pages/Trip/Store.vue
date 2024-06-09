<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import {reactive, ref, watch} from "vue";
import MultiSelect from 'primevue/multiSelect';
import Dropdown from 'primevue/dropdown';
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Textarea from 'primevue/textarea';

const selectedTasks = ref()
const selectedDriver = ref()
const selectedTruck = ref()

watch(selectedDriver, async (newDriver, oldDriver) => {
    form.driver_id = newDriver.id
})

watch(selectedTruck, async (newTruck, oldTruck) => {
    form.truck_id = newTruck.id
})

watch(selectedTasks, async (newTask, oldTask) => {
    form.tasks_id = newTask.map(x => x.id)
})

const props = defineProps({
    'drivers': Array,
    'trucks': Array,
    'tasks': Array,
})

const form = reactive({
    title: '',
    body: '',
    driver_id: null,
    truck_id: null,
    tasks_id: null,
})

function submit() {
    router.post('/trips/store', form)
}
</script>

<template>
    <Head title="Dashboard"/>
    <AuthenticatedLayout>
        <div class="m-10">
            <div class="">
                <h1 class="text-2xl font-bold mb-4">Create a New Trip</h1>
                <form @submit.prevent="submit"
                      class="bg-white px-10 py-5 w-1/2">

                    <div class="mb-4">
                        <label for="trip-title" class="text-gray-700">Trip title:</label>
                        <TextInput
                            id="trip-title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label for="trip-body" class="text-gray-700">Trip detail:</label>
                        <Textarea id="trip-body"
                                  class="mt-1 block w-full"
                                  autoResize
                                  v-model="form.body"
                                  rows="5"
                                  cols="30"/>
                    </div>

                    <div class="mb-4">
                        <Dropdown id="trucks"
                                  :options="drivers"
                                  optionLabel="name"
                                  placeholder="Select a Driver"
                                  checkmark
                                  :highlightOnSelect="false"
                                  v-model="selectedDriver"
                                  class="w-full md:w-14rem"/>
                    </div>

                    <div class="mb-4">
                        <Dropdown id="trucks"
                                  :options="trucks"
                                  optionLabel="title"
                                  placeholder="Select a Truck"
                                  checkmark
                                  :highlightOnSelect="false"
                                  v-model="selectedTruck"
                                  class="w-full md:w-14rem"/>
                    </div>

                    <MultiSelect v-model="selectedTasks"
                                 :options="tasks"
                                 filter
                                 optionLabel="title"
                                 placeholder="Select Tasks"
                                 :maxSelectedLabels="3"
                                 class="w-full bg-white"/>

                    <div class="my-10">
                        <PrimaryButton type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Trip
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


