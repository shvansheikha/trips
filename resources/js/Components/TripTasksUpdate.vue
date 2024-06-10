<script setup lang="ts">
import {onMounted, ref} from "vue";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from 'primevue/checkbox';

interface DataItem {
    id: number;
    title: string;
    trip_id: string;
}

const tasks = ref<DataItem[]>([]);
const selectedTasks = ref([]);
const errors = ref({});

const emit = defineEmits(['close']);

const props = defineProps({
    trip: Number
})

const fetchTasks = async () => {
    axios.get('/tasks?trip=' + props.trip).then(response => {
        tasks.value = response.data
        tasks.value.forEach(function (item) {
            if (item.trip_id == props.trip) {
                selectedTasks.value.push(item.id)
            }
        })
    });
};

const selectTasks = async () => {
    axios.post('trips/' + props.trip + '/tasks', {
        tasks_id: selectedTasks.value,
    }).then(response => {
        closeModal()
    }).catch(error => {
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    })
};

const closeModal = () => {
    const tasksTitles = tasks.value
        .filter(task => selectedTasks.value.includes(task.id))
        .map(task => task.title)

    emit('close', tasksTitles);
};

onMounted(fetchTasks);
</script>

<template>
    <div class="p-4">
        <div class="flex flex-wrap max-h-96 overflow-y-auto scrollbar-hide">
            <form @submit.prevent="selectTasks">
                <div class="flex flex-wrap items-center">
                    <div v-for="task in tasks" :key="task.id"
                         class="my-1 mx-3 flex justify-content-center items-center py-1">
                        <Checkbox :class="'border rounded-md'"
                                  :inputId="`task-${task.id}`"
                                  :value="task.id"
                                  v-model="selectedTasks"/>
                        <label :for="`task-${task.id}`" class="ml-2">{{ task.title }}</label>
                    </div>
                </div>

                <div class="flex justify-end mt-10">
                    <PrimaryButton>Update Tasks</PrimaryButton>
                </div>
            </form>

        </div>
    </div>
</template>

<style scoped>

</style>
