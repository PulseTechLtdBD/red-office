<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    areas: Object
});

function onEdit(id) {
    const form = useForm({});
    router.get(route('areas.edit', id));
}

function onDelete(id) {
    console.log(id);
}

function onCreate() {
    const form = useForm({});
    router.get(route('areas.create'));
}

</script>

<template>
    <AppLayout title="Areas">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Areas
                </h2>
                <PrimaryButton @click="onCreate()">
                    Create 
                </PrimaryButton>
            </div>
        </template>
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ParentID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Latitude</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Longitude</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in props.users">
                                <td class="px-4 py-2">{{ item.id }}</td>
                                <td class="px-4 py-2">{{ item.name }}</td>
                                <td class="px-4 py-2">{{ item.parent_id }}</td>
                                <td class="px-4 py-2">{{ item.latitude }}</td>
                                <td class="px-4 py-2">{{ item.longitude }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button @click="onEdit(item.id)" class="text-blue-600 hover:underline">Edit</button>
                                    <button @click="onDelete(item.id)" class="text-red-600 hover:underline">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>