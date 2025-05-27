<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3';
const props = defineProps({
    users: Object
});

function onEdit(id) {
    const form = useForm({});
    form.get(route('users.edit'));
}

function onDelete(id) {
    console.log(id);
}

</script>

<template>
    <AppLayout title="User">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users
            </h2>
        </template>
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in props.users">
                                <td class="px-4 py-2">{{ item.id }}</td>
                                <td class="px-4 py-2">{{ item.name }}</td>
                                <td class="px-4 py-2">{{ item.email }}</td>
                                <td class="px-4 py-2">{{ item.created_at }}</td>
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