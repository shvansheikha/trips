<script setup lang="ts">
import {TabGroup, TabList, Tab, TabPanels, TabPanel, TransitionRoot} from '@headlessui/vue'

interface Task {
    id: number;
    title: string;
}

interface Tab {
    id: Number,
    title: string,
    body: string,
    driver: {
        name: string
    },
    truck: {
        title: string
    },
    tasks: Task[];
}

const props = defineProps<{
    tabs: Tab[]
}>()

const tabs = props.tabs
</script>

<template>
    <div class="w-full">
        <TabGroup v-slot="{ selectedIndex }">

            <!-- Buttons -->
            <div class="flex justify-center">
                <TabList
                    class="inline-flex flex-wrap justify-center bg-slate-200 rounded-3xl p-1 mb-8">
                    <Tab :key="index" v-for="(tab, index) in tabs" as="template">
                        <button
                            class="flex-1 text-sm font-medium h-8 px-4 rounded-2xl whitespace-nowrap focus-visible:outline-none ui-focus-visible:outline-none ui-focus-visible:ring ui-focus-visible:ring-indigo-300 transition-colors duration-150 ease-in-out"
                            :class="selectedIndex === index ? 'bg-white text-slate-900' : 'text-slate-600 hover:text-slate-900'">
                            {{ tab.title }} - {{ tab.id }}
                        </button>
                    </Tab>
                </TabList>
            </div>

            <!-- Tab panels -->
            <TabPanels>
                <div class="relative flex flex-col">

                    <TabPanel :key="index" v-for="(tab, index) in tabs" :static="true"
                              class=""
                              :class="selectedIndex !== index ? 'order-first' : ''">
                        <TransitionRoot as="article"
                                        :show="selectedIndex === index"
                                        class="w-full bg-white min-[480px]:flex items-stretch"
                                        enter="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-700 transform"
                                        enterFrom="opacity-0 -translate-y-8"
                                        enterTo="opacity-100 translate-y-0"
                                        leave="transition ease-[cubic-bezier(0.68,-0.3,0.32,1)] duration-300 transform absolute"
                                        leaveFrom="opacity-100 translate-y-0"
                                        leaveTo="opacity-0 translate-y-12">

                            <div class="flex flex-col justify-center p-5 pl-3">
                                <h1 class="text-xl font-bold text-slate-900 uppercase">{{ tab.title }}</h1>
                                <span class="text-lg text-slate-900">Driver: {{ tab.driver.name }}</span>
                                <span class="text-lg text-slate-900">Truck: {{ tab.truck.title }}</span>
                                <span class="text-sm text-slate-900 mt-4">{{ tab.body }}</span>

                                <div class="mt-4">
                                    Tasks:
                                    <div v-for="task in tab.tasks"
                                    class="px-2">- {{task.title}}</div>
                                </div>
                            </div>

                        </TransitionRoot>
                    </TabPanel>

                </div>
            </TabPanels>

        </TabGroup>
    </div>
</template>
