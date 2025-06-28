<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    departments: Object
});

function onEdit(id) {
    const form = useForm({});
    router.get(route('departments.edit', id));
}

function onDelete(id) {
    console.log(id);
}

function onCreate() {
    const form = useForm({});
    router.get(route('departments.create'));
}

</script>

<template>
    <AppLayout title="Departments">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Departments
                </h2>
                <PrimaryButton @click="onCreate()">
                    Create 
                </PrimaryButton>
            </div>
        </template>
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-x-auto shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Code</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Head of Department</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Parent Department</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Budget</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Contact Email</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Contact Phone</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in props.departments">
                                <td class="px-4 py-2 text-center">{{ item.id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.code }}</td>
                                <td class="px-4 py-2 text-center">{{ item.description }}</td>
                                <td class="px-4 py-2 text-center">{{ item.head_of_department_id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.parent_department_id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.budget }}</td>
                                <td class="px-4 py-2 text-center">{{ item.contact_email }}</td>
                                <td class="px-4 py-2 text-center">{{ item.contact_phone }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <div class="flex space-x-2 items-center justify-center">
                                        <PrimaryButton @click="onEdit(item.id)" >Edit</PrimaryButton>
                                        <PrimaryButton @click="onDelete(item.id)" >Delete</PrimaryButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>