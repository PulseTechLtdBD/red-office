<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    addresses: Object
});

function onEdit(id) {
    const form = useForm({});
    router.get(route('addresses.edit', id));
}

function onDelete(id) {
    console.log(id);
}

function onCreate() {
    const form = useForm({});
    router.get(route('addresses.create'));
}

</script>

<template>
    <AppLayout title="Addresses">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Addresses
                </h2>
                <PrimaryButton @click="onCreate">
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
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Street Address</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Apartment Address</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Area ID</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Zip Code</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Latitude</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Longitude</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Is Primary</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Contact Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Contact Phone</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Address</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Address Type</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in props.addresses">
                                <td class="px-4 py-2 text-center">{{ item.id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.type }}</td>
                                <td class="px-4 py-2 text-center">{{ item.name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.street_address }}</td>
                                <td class="px-4 py-2 text-center">{{ item.apartment_address }}</td>
                                <td class="px-4 py-2 text-center">{{ item.area_id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.zip_code }}</td>
                                <td class="px-4 py-2 text-center">{{ item.latitude }}</td>
                                <td class="px-4 py-2 text-center">{{ item.longitude }}</td>
                                <td class="px-4 py-2 text-center">{{ item.is_primary }}</td>
                                <td class="px-4 py-2 text-center">{{ item.contact_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.contact_phone }}</td>
                                <td class="px-4 py-2 text-center">{{ item.addressable_type }}</td>
                                <td class="px-4 py-2 text-center">{{ item.addressable_id }}</td>
                                <td class="px-4 py-2 space-x-2 flex items-center">
                                    <div class="flex space-x-2 items-center justify-center">
                                        <PrimaryButton @click="onEdit(item.id)">Edit</PrimaryButton>
                                        <PrimaryButton @click="onDelete(item.id)">Delete</PrimaryButton>
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